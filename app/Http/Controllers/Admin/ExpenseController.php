<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Expense;

class ExpenseController extends Controller
{

    public function index()
    {
        $expenses = Expense::with('user')->orderBy('date', 'desc')->paginate(10);
        $payments = $expenses->map(fn($expense) => $this->formatExpenseData($expense));

        return view('admin.expense.index', compact('payments', 'expenses'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->select('id', 'name')->get();
        return view('admin.expense.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);
        Expense::create($validatedData);

        return redirect()->route('expense.index')->with('success', 'Expense recorded successfully!');
    }

    public function edit(Expense $expense)
    {
        $users = User::where('role', 'user')->select('id', 'name')->get();
        return view('admin.expense.edit', compact('expense', 'users'));
    }

    public function update(Request $request, Expense $expense)
    {
        $validatedData = $this->validateRequest($request);
        $expense->update($validatedData);

        return redirect()->route('expense.index')->with('success', 'Expense updated successfully!');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expense.index')->with('success', 'Expense deleted successfully!');
    }

    private function formatExpenseData($expense)
    {
        return [
            'id' => $expense->id,
            'action' => 'expense',
            'sender_name' => optional($expense->user)->name ?? 'Unknown',
            'sender_type' => optional($expense->user)->role ?? 'Unknown',
            'recipient_name' => 'N/A',
            'recipient_type' => 'N/A',
            'payment_type' => $expense->itemname,
            'location' => $expense->location,
            'amount' => $expense->amount,
            'transaction_date' => $expense->date,
        ];
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'itemname' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'userid' => 'nullable|exists:users,id',
            'amount' => 'required|numeric|min:0',
        ]) + ['userid' => $request->userid ?? Auth::id()];
    }
}
