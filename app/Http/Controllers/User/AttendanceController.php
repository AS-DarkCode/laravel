<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Site;
use App\Models\Payment;
use App\Models\Expense;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    public function overview(Request $request)
    {
        // Ensure authenticated user can access this page
        $this->middleware('auth');

        // Fetch all users
        $users = User::all();

        // Default selected date (e.g., today)
        $selectedDate = now()->toDateString();

        // Fetch attendance summaries for each user
        $userAttendanceSummaries = [];
        foreach ($users as $user) {
            $attendanceRecords = Attendance::where('user_id', $user->id)->get();
            $totalPresent = $attendanceRecords->where('status', '!=', 'A')->count();
            $totalAbsent = $attendanceRecords->where('status', 'A')->count();
            $userAttendanceSummaries[$user->id] = [
                'total_present' => $totalPresent,
                'total_absent' => $totalAbsent,
            ];
        }

        return view('Admin.attendance.overview', compact('users', 'userAttendanceSummaries', 'selectedDate'));
    }

    public function index(Request $request)
    {
        // Ensure authenticated user can access this page
        $this->middleware('auth');

        // Get the selected date or default to today
        $selectedDate = $request->input('attendance_date', now()->toDateString());

        // Validate that the selected date is not in the future
        $today = now()->toDateString();
        if (Carbon::parse($selectedDate)->gt($today)) {
            $selectedDate = $today; // Reset to today if future date is selected
            return redirect()->route('attendance.index', ['attendance_date' => $selectedDate])
                ->with('error', 'Cannot mark attendance for future dates.');
        }

        // Fetch all users
        $users = User::all();

        // Fetch all sites
        $sites = Site::all();

        // Fetch existing attendance records for the selected date
        $attendanceRecords = Attendance::with('user', 'site')
            ->where('attendance_date', $selectedDate)
            ->get();

        // Check if all users have attendance marked for the selected date
        // $allMarked is true only if every user has a record
        $allMarked = $users->count() > 0 && $attendanceRecords->count() === $users->count();

        return view('Admin.attendance.index', compact('users', 'sites', 'attendanceRecords', 'selectedDate', 'allMarked'));
    }

    public function create()
    {
        $users = User::all();
        $sites = Site::all();
        return view('Admin.attendance.create', compact('users', 'sites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'attendance_date' => 'required|date|before_or_equal:today',
            'attendance.*.user_id' => 'required|exists:users,id',
            'attendance.*.status' => 'required|in:0.5,1,1.5,2,A',
            'attendance.*.site_id' => 'nullable|exists:sites,id',
        ]);

        $attendanceDate = $request->input('attendance_date');

        foreach ($request->input('attendance') as $data) {
            // Skip if status is not provided
            if (!isset($data['status'])) {
                continue;
            }

            // Check if an existing record exists for this user and date
            $existingRecord = Attendance::where('user_id', $data['user_id'])
                ->where('attendance_date', $attendanceDate)
                ->first();

            if ($existingRecord) {
                // Update existing record
                $existingRecord->update([
                    'status' => $data['status'],
                    'site_id' => $data['status'] !== 'A' && isset($data['site_id']) && !empty($data['site_id']) ? $data['site_id'] : null,
                ]);
            } else {
                // Create new attendance record
                Attendance::create([
                    'user_id' => $data['user_id'],
                    'attendance_date' => $attendanceDate,
                    'status' => $data['status'],
                    'site_id' => $data['status'] !== 'A' && isset($data['site_id']) && !empty($data['site_id']) ? $data['site_id'] : null,
                ]);
            }
        }

        return redirect()->route('attendance.index', ['attendance_date' => $attendanceDate])
            ->with('success', 'Attendance updated successfully.');
    }

    public function edit($id)
    {
        $attendance = Attendance::with('user', 'site')->findOrFail($id);
        $users = User::all();
        $sites = Site::all();
        return view('Admin.attendance.edit', compact('attendance', 'users', 'sites'));
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'attendance_date' => 'required|date|before_or_equal:today',
            'status' => 'required|in:0.5,1,1.5,2,A',
            'site_id' => 'nullable|exists:sites,id',
        ]);

        $attendance->update([
            'user_id' => $validated['user_id'],
            'attendance_date' => $validated['attendance_date'],
            'status' => $validated['status'],
            'site_id' => $validated['status'] !== 'A' && isset($validated['site_id']) && !empty($validated['site_id']) ? $validated['site_id'] : null,
        ]);

        // Redirect back to the user's attendance history view
        return redirect()->route('attendance.view', ['userId' => $validated['user_id'], 'selectedDate' => $validated['attendance_date']])
            ->with('success', 'Attendance updated successfully.');
    }

    public function view($userId, $selectedDate)
    {
        // Fetch the user
        $user = User::findOrFail($userId);

        // Fetch all attendance records for this user
        $attendanceRecords = Attendance::with('site')
            ->where('user_id', $userId)
            ->orderBy('attendance_date', 'desc')
            ->get();

        // Calculate total present and absent days
        $totalPresent = $attendanceRecords->where('status', '!=', 'A')->count();
        $totalAbsent = $attendanceRecords->where('status', 'A')->count();

        return view('Admin.attendance.view', compact('user', 'attendanceRecords', 'totalPresent', 'totalAbsent', 'selectedDate'));
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $userId = $attendance->user_id;
        $attendanceDate = $attendance->attendance_date;
        $attendance->delete();

        return redirect()->route('attendance.view', ['userId' => $userId, 'selectedDate' => $attendanceDate])
            ->with('success', 'Attendance record deleted successfully.');
    }
}