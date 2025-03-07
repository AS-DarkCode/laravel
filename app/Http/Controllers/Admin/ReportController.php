<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Expense;
use App\Models\Attendance;
use App\Models\Sendpayment;
use App\Models\Receivepayment;
use App\Models\Site;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{

    public function index()
    {
        $users = User::with(['sendpayments', 'expenses', 'attendance'])
        ->where('role', 'user') 
        ->get();
        return view('admin.reports.index', compact('users'));
    
    }

    public function show(Request $request, $id)
    {
        // Fetch user
        $user = User::with(['attendance', 'sendpayments', 'expenses'])
                    ->where('id', $id)
                    ->where('role', 'user')
                    ->firstOrFail();

        // Date range from request
        $startDate = $request->input('start_date', now()->subDays(30)->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        // Fetch records with date range
        $attendanceRecords = Attendance::where('userid', $id)
                                      ->whereBetween('date', [$startDate, $endDate])
                                      ->orderBy('date', 'asc')
                                      ->get();

        $sendPaymentRecords = Sendpayment::where('userid', $id)
                                        ->whereBetween('transationdate', [$startDate, $endDate])
                                        ->orderBy('transationdate', 'asc')
                                        ->get();

        $expenseRecords = Expense::where('userid', $id)
                                ->whereBetween('date', [$startDate, $endDate])
                                ->orderBy('date', 'asc')
                                ->get();

        // Calculate summary based on new status logic
        $presentDays = $attendanceRecords->where('status', '!=', 'A')->sum('status'); // Sum of numeric status values (excluding 'A')
        $totalEarnings = $presentDays * ($user->setamount ?? 0); // Earnings = Sum of status * Set Amount
        $totalSend = $sendPaymentRecords->sum('amount'); // Total sent by admin
        $totalExpense = $expenseRecords->sum('amount'); // Total expenses
        $totalProfit = $totalEarnings - $totalExpense; // Profit = Earnings - Expenses
        $totalRemaining = $totalEarnings - $totalSend - $totalExpense; // Remaining = Earnings - Sent - Expenses

        $summary = [
            'present_days' => $presentDays, // Total effective days (e.g., 0.5 + 1 + 1.5 = 3)
            'total_earnings' => $totalEarnings,
            'total_send' => $totalSend,
            'total_expense' => $totalExpense,
            'total_profit' => $totalProfit,
            'total_remaining' => $totalRemaining,
        ];

        $formattedStartDate = \Carbon\Carbon::parse($startDate)->format('d M, Y');
        $formattedEndDate = \Carbon\Carbon::parse($endDate)->format('d M, Y');

        // Return view with data
        return view('admin.reports.show', compact(
            'user',
            'startDate',
            'endDate',
            'attendanceRecords',
            'sendPaymentRecords',
            'expenseRecords',
            'summary',
            'formattedStartDate',
            'formattedEndDate'
        ));
    }

    public function download(Request $request, $id)
    {
        $user = User::where('id', $id)
                    ->where('role', 'user')
                    ->firstOrFail();

        $startDate = $request->input('start_date', now()->subDays(30)->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        // Fetch records with date range
        $attendanceRecords = Attendance::where('userid', $id)
                                      ->whereBetween('date', [$startDate, $endDate])
                                      ->orderBy('date', 'asc')
                                      ->get()
                                      ->map(function ($record) {
                                          $record->attendance_date = $record->date;
                                          return $record;
                                      });

        $paymentRecords = Sendpayment::where('userid', $id)
                                    ->whereBetween('transationdate', [$startDate, $endDate])
                                    ->orderBy('transationdate', 'asc')
                                    ->get()
                                    ->map(function ($record) use ($user) {
                                        $record->transaction_date = $record->transationdate;
                                        $record->action = 'sent';
                                        $record->sender_name = 'Admin';
                                        $record->sender_type = 'admin';
                                        $record->recipient_name = $user->name;
                                        $record->recipient_type = 'user';
                                        $record->payment_type = $record->paymenttype;
                                        $record->details = $record->breif;
                                        $record->method = $record->paymenttype;
                                        return $record;
                                    });

        $expenseRecords = Expense::where('userid', $id)
                                ->whereBetween('date', [$startDate, $endDate])
                                ->orderBy('date', 'asc')
                                ->get()
                                ->map(function ($record) {
                                    $record->created_at = $record->date; // Map date to created_at
                                    $record->details = $record->itemname . ' at ' . $record->location;
                                    return $record;
                                });

        $siteVisits = Attendance::where('userid', $id)
                               ->whereBetween('date', [$startDate, $endDate])
                               ->whereNotNull('siteid')
                               ->with('site')
                               ->get()
                               ->map(function ($record) {
                                   return [
                                       'date' => $record->date,
                                       'site_name' => $record->site ? $record->site->sitelocation : 'N/A',
                                   ];
                               })->toArray();

        // Summary Calculations
        $totalAttendance = $attendanceRecords->where('status', 'present')->count();
        $totalEarnings = $user->setamount * $totalAttendance;
        $totalPaymentsSent = $paymentRecords->sum('amount');
        $totalPaymentsReceived = 0; // No receivepayments
        $totalExpenses = $expenseRecords->sum('amount');
        $totalProfit = $totalEarnings;
        $totalRemaining = $totalEarnings - $totalPaymentsSent - $totalExpenses;

        $summary = [
            'total_attendance' => $totalAttendance,
            'total_earnings' => $totalEarnings,
            'total_payments_sent' => $totalPaymentsSent,
            'total_payments_received' => $totalPaymentsReceived,
            'total_expenses' => $totalExpenses,
            'total_profit' => $totalProfit,
            'total_remaining' => $totalRemaining,
        ];

        $formattedStartDate = \Carbon\Carbon::parse($startDate)->format('d-M-Y');
        $formattedEndDate = \Carbon\Carbon::parse($endDate)->format('d-M-Y');
        $user->formatted_joining_date = $user->joiningdate ? $user->joiningdate->format('d-M-Y') : 'N/A';
        $user->amount = $user->setamount;

        // Configure PDF with UTF-8 support
        $pdf = Pdf::loadView('admin.reports.pdf', compact(
            'user',
            'attendanceRecords',
            'paymentRecords',
            'expenseRecords',
            'siteVisits',
            'summary',
            'formattedStartDate',
            'formattedEndDate'
        ))->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true, // For images if needed later
        ]);

        return $pdf->download('report_' . $user->name . '_' . $startDate . '_to_' . $endDate . '.pdf');
    }
}