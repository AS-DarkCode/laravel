<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', $this->getDashboardData());
    }

    public function manage()
    {
        return view('admin.manage', $this->getDashboardData());
    }

    private function getDashboardData()
    {
        $startDate = Carbon::now()->subDays(30)->toDateString();
        $endDate = Carbon::now()->toDateString();

        // Fetch total users count
        $totalUsers = User::where('role', 'user')->count();

        // Fetch aggregated stats
        $userStats = User::where('role', 'user')
            ->with(['attendance' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate])->where('status', '!=', 'A');
            }, 'expenses' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            }, 'sendpayments' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('transationdate', [$startDate, $endDate]);
            }])->get();

        // Calculate total earnings, payments sent, and expenses
        $totalEarnings = $userStats->sum(fn($user) => ($user->attendance->count() ?? 0) * ($user->setamount ?? 0));
        $totalPaymentsSent = $userStats->sum(fn($user) => $user->sendpayments->sum('amount'));
        $totalExpenses = $userStats->sum(fn($user) => $user->expenses->sum('amount'));
        $totalProfit = $totalEarnings - $totalExpenses;

        // Fetch latest 5 users with stats
        $users = User::where('role', 'user')
            ->select('id', 'setamount', 'created_at')
            ->withCount(['attendance as present_days' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate])->where('status', '!=', 'A');
            }, 'sendpayments as total_send' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('transationdate', [$startDate, $endDate])->selectRaw('SUM(amount)');
            }, 'expenses as total_expense' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate])->selectRaw('SUM(amount)');
            }])
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        // Calculate per-user profit
        $users->each(function ($user) {
            $earnings = ($user->present_days ?? 0) * ($user->setamount ?? 0);
            $user->total_profit = $earnings - ($user->total_expense ?? 0);
        });

        return compact('users', 'totalUsers', 'totalProfit', 'totalPaymentsSent', 'totalExpenses');
    }
}
