@extends('layouts.app')

@section('content')
    <div class="appHeader bg-gradient-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px; background: linear-gradient(135deg, #007bff, #0056b3);">
        <div class="left">
            <a href="{{ route('attendance.index', ['attendance_date' => $selectedDate]) }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: background 0.3s ease;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Attendance History: {{ $user->name }}</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
        </div>
    </div>

    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            @include('Admin.overview.messages')

            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body">
                    <h5 class="fw-semibold">Summary</h5>
                    <p class="text-muted small">Total Present Days: {{ $totalPresent }}</p>
                    <p class="text-muted small">Total Absent Days: {{ $totalAbsent }}</p>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="mb-3 d-flex gap-2 flex-wrap">
                <a href="{{ route('attendance.view', [$user->id, $selectedDate]) }}?filter=all" class="btn btn-outline-primary rounded-pill px-3 py-2 {{ $filter == 'all' ? 'active' : '' }}">All Records</a>
                <a href="{{ route('attendance.view', [$user->id, $selectedDate]) }}?filter=week" class="btn btn-outline-primary rounded-pill px-3 py-2 {{ $filter == 'week' ? 'active' : '' }}">Last 7 Days</a>
                <a href="{{ route('attendance.view', [$user->id, $selectedDate]) }}?filter=month" class="btn btn-outline-primary rounded-pill px-3 py-2 {{ $filter == 'month' ? 'active' : '' }}">This Month</a>
                <a href="{{ route('attendance.view', [$user->id, $selectedDate]) }}?filter=year" class="btn btn-outline-primary rounded-pill px-3 py-2 {{ $filter == 'year' ? 'active' : '' }}">This Year</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover border-0 rounded-3">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="py-3 ps-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">Date</th>
                            <th scope="col" class="py-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">Status</th>
                            <th scope="col" class="py-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">Site</th>
                            <th scope="col" class="py-3 pe-3 text-muted small fw-semibold text-end" style="font-size: 0.85rem;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendanceRecords as $record)
                            <tr class="align-middle">
                                <td class="py-3 ps-3 text-start">
                                    <span class="text-dark fw-semibold small" style="font-size: 0.85rem;">{{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}</span>
                                </td>
                                <td class="py-3 text-start">
                                    <span class="text-muted small" style="font-size: 0.85rem;">{{ $record->status }}</span>
                                </td>
                                <td class="py-3 text-start">
                                    <span class="text-muted small" style="font-size: 0.85rem;">{{ $record->site ? $record->site->sitelocation : 'N/A' }}</span>
                                </td>
                                <td class="py-3 pe-3 text-end">
                                    <a href="{{ route('attendance.edit', $record->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-2 py-1" style="font-size: 0.75rem;">
                                        <ion-icon name="pencil-outline" style="font-size: 14px; vertical-align: middle;"></ion-icon>
                                    </a>
                                    <form action="{{ route('attendance.destroy', $record->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2 py-1" style="font-size: 0.75rem;">
                                            <ion-icon name="trash-outline" style="font-size: 14px; vertical-align: middle;"></ion-icon>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-3 text-center text-muted">No attendance records found for this filter.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="mt-3">
                {{ $attendanceRecords->appends(['filter' => $filter])->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <style>
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important; }
        .headerButton:hover { background: rgba(255, 255, 255, 0.3) !important; }
        .btn-outline-primary:hover { background-color: #007bff; color: white; transform: scale(1.05); }
        .btn-outline-primary.active { background-color: #007bff; color: white; }
        .btn-outline-warning:hover { background-color: #ffc107; color: white; transform: scale(1.05); }
        .btn-outline-danger:hover { background-color: #dc3545; color: white; transform: scale(1.05); }
        .table tbody tr:hover { background-color: rgba(0, 123, 255, 0.05); transition: background-color 0.3s ease; }
    </style>
@endsection