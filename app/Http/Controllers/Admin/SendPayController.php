<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sendpayment;
use Illuminate\Support\Facades\Validator;

class SendPayController extends Controller
{
    public function index()
    {
        return response()->json(Sendpayment::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'receiver' => 'required|string|max:255',
            'status' => 'required|in:pending,completed,failed',
        ]);
        
        return response()->json(Sendpayment::create($validated), 201);
    }

    public function show(Sendpayment $sendPay)
    {
        return response()->json($sendPay);
    }

    public function update(Request $request, Sendpayment $sendPay)
    {
        $validated = $request->validate([
            'amount' => 'sometimes|numeric|min:1',
            'receiver' => 'sometimes|string|max:255',
            'status' => 'sometimes|in:pending,completed,failed',
        ]);
        
        $sendPay->update($validated);
        return response()->json($sendPay);
    }

    public function destroy(Sendpayment $sendPay)
    {
        $sendPay->delete();
        return response()->json(['message' => 'Payment record deleted successfully']);
    }
}
