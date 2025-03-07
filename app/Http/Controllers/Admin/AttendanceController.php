<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Site;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    // Overview: Shows summary of all users' attendance
    public function overview()
    {
        $users = User::with('attendance')->get();
        $userAttendanceSummaries = $users->mapWithKeys(function ($user) {
            return [
                $user->id => [
                    'total_present' => $user->attendance->where('status', '!=', 'A')->sum('status'),
                    'total_absent' => $user->attendance->where('status', 'A')->count(),
                ]
            ];
        });
        return view('admin.attendance.overview', compact('users', 'userAttendanceSummaries'));
    }

    // Index: Main attendance marking page
    public function index(Request $request)
    {
        $selectedDate = Carbon::parse($request->input('attendance_date', now()->toDateString()));
        if ($selectedDate->gt(now())) {
            return redirect()->route('attendance.index', ['attendance_date' => now()->toDateString()])
                ->with('error', 'Cannot mark attendance for future dates.');
        }

        $users = User::all();
        $sites = Site::all();
        $attendanceRecords = Attendance::where('date', $selectedDate)->get()->keyBy('userid');
        $allMarked = $users->count() === $attendanceRecords->count();

        return view('admin.attendance.index', compact('users', 'sites', 'attendanceRecords', 'selectedDate', 'allMarked'));
    }

    // Store: Save or update attendance records
    public function store(Request $request)
    {
        $request->validate([
            'attendance_date' => 'required|date|before_or_equal:today',
            'attendance' => 'required|array',
            'attendance.*.user_id' => 'required|exists:users,id',
            'attendance.*.status' => 'required|in:0.5,1,1.5,2,A',
            'attendance.*.site_id' => 'nullable|exists:sites,id',
        ]);

        $selectedDate = $request->attendance_date;

        foreach ($request->attendance as $userId => $data) {
            Attendance::updateOrCreate(
                ['userid' => $userId, 'date' => $selectedDate],
                ['siteid' => $data['status'] === 'A' ? null : $data['site_id'], 'status' => $data['status']]
            );
        }

        return redirect()->route('attendance.index', ['attendance_date' => $selectedDate])
            ->with('success', 'Attendance recorded successfully!');
    }

    // Edit: Edit a single attendance record
    public function edit(Attendance $attendance)
    {
        return view('admin.attendance.edit', [
            'attendance' => $attendance,
            'users' => User::all(),
            'sites' => Site::all()
        ]);
    }

    // Update: Update a single attendance record
    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'userid' => 'required|exists:users,id',
            'date' => 'required|date|before_or_equal:today',
            'status' => 'required|in:0.5,1,1.5,2,A',
            'siteid' => 'nullable|exists:sites,id',
        ]);

        $attendance->update([
            'userid' => $request->userid,
            'date' => $request->date,
            'status' => $request->status,
            'siteid' => $request->status === 'A' ? null : $request->siteid,
        ]);

        return redirect()->route('attendance.index', ['attendance_date' => $request->date])
            ->with('success', 'Attendance updated successfully!');
    }

    // View: Show attendance history for a specific user
    public function view(Request $request, User $user)
    {
        $filter = $request->input('filter', 'all');
        $query = $user->attendance()->with('site')->orderByDesc('date');

        if ($filter === 'week') {
            $query->where('date', '>=', now()->subDays(7));
        } elseif ($filter === 'month') {
            $query->where('date', '>=', now()->startOfMonth());
        } elseif ($filter === 'year') {
            $query->where('date', '>=', now()->startOfYear());
        }

        $attendanceRecords = $query->paginate(10);
        return view('admin.attendance.view', compact('user', 'attendanceRecords'));
    }

    // Destroy: Delete a single attendance record
    public function destroy(Attendance $attendance)
    {
        $date = $attendance->date;
        $attendance->delete();
        return redirect()->route('attendance.index', ['attendance_date' => $date])
            ->with('success', 'Attendance record deleted successfully!');
    }

    // Bulk Delete: Delete all attendance records for a specific date
    public function bulkDelete(Request $request)
    {
        $request->validate(['attendance_date' => 'required|date|before_or_equal:today']);
        Attendance::where('date', $request->attendance_date)->delete();
        return redirect()->route('attendance.index', ['attendance_date' => $request->attendance_date])
            ->with('success', 'All attendance records deleted successfully!');
    }

    // Search/Filter: Filter attendance by date range or user
    public function search(Request $request)
    {
        $query = Attendance::with('user', 'site');

        if ($request->filled('start_date')) {
            $query->where('date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('date', '<=', $request->end_date);
        }
        if ($request->filled('user_id')) {
            $query->where('userid', $request->user_id);
        }

        return view('admin.attendance.search', [
            'attendanceRecords' => $query->orderByDesc('date')->get(),
            'users' => User::all()
        ]);
    }
}
