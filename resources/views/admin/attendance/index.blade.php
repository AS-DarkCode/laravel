@extends('layouts.app')

@section('content')
    <div class="appHeader bg-gradient-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px; background: linear-gradient(135deg, #007bff, #0056b3);">
        <div class="left">
            <a href="{{ route('dashboard.manage') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: background 0.3s ease;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Manage Attendance</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
            <a href="{{ route('attendance.overview') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: background 0.3s ease;" title="Attendance Overview">
                <ion-icon name="stats-chart-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
    </div>

    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            @include('Admin.overview.messages')

            <div class="card border-0 shadow-lg rounded-4 bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb);">
                <div class="card-body">
                    <!-- Bulk Delete Form -->
                    @if (!empty($attendanceRecords) && $attendanceRecords->isNotEmpty())
                        <div class="mb-3">
                            <form method="POST" action="{{ route('attendance.bulkDelete') }}" onsubmit="return confirm('Are you sure you want to delete all attendance records for {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}?');">
                                @csrf
                                <input type="hidden" name="attendance_date" value="{{ $selectedDate }}">
                                <button type="submit" class="btn btn-outline-danger rounded-pill px-3 py-2">
                                    Delete All Records for {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}
                                </button>
                            </form>
                        </div>
                    @endif

                    <!-- Main Attendance Form -->
                    <form method="POST" action="{{ route('attendance.store') }}">
                        @csrf

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="attendance_date">Select Date</label>
                            <input type="date" class="form-control shadow-sm rounded-3 @error('attendance_date') is-invalid @enderror" id="attendance_date" name="attendance_date" value="{{ old('attendance_date', $selectedDate ?? now()->toDateString()) }}" max="{{ now()->toDateString() }}" required onchange="updateDate(this.value)">
                            @error('attendance_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if (empty($users) || $users->isEmpty())
                            <div class="card border-0 shadow-sm rounded-4 text-center">
                                <div class="card-body py-5">
                                    <ion-icon name="sad-outline" style="font-size: 48px; color: #6c757d;"></ion-icon>
                                    <h5 class="mt-3 text-muted fw-semibold">No Users Found</h5>
                                    <p class="text-muted mb-0 small">Add some users to mark attendance.</p>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover border-0 rounded-3">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col" class="py-3 ps-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">User Name</th>
                                            <th scope="col" class="py-3 text-muted small fw-semibold text-center" style="font-size: 0.85rem;">0.5</th>
                                            <th scope="col" class="py-3 text-muted small fw-semibold text-center" style="font-size: 0.85rem;">1</th>
                                            <th scope="col" class="py-3 text-muted small fw-semibold text-center" style="font-size: 0.85rem;">1.5</th>
                                            <th scope="col" class="py-3 text-muted small fw-semibold text-center" style="font-size: 0.85rem;">2</th>
                                            <th scope="col" class="py-3 text-muted small fw-semibold text-center" style="font-size: 0.85rem;">A</th>
                                            <th scope="col" class="py-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">Site (If Present)</th>
                                            <th scope="col" class="py-3 pe-3 text-muted small fw-semibold text-end" style="font-size: 0.85rem;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            @php
                                                $existingAttendance = $attendanceRecords->get($user->id);
                                            @endphp
                                            <tr class="align-middle">
                                                <td class="py-3 ps-3 text-start">
                                                    <span class="text-dark fw-semibold small" style="font-size: 0.85rem;">{{ $user->name }}</span>
                                                    <input type="hidden" name="attendance[{{ $user->id }}][user_id]" value="{{ $user->id }}">
                                                </td>
                                                <td class="py-3 text-center">
                                                    <input type="radio" name="attendance[{{ $user->id }}][status]" value="0.5" class="form-check-input" onchange="toggleSiteSelection({{ $user->id }})" {{ $existingAttendance && $existingAttendance->status == '0.5' ? 'checked' : '' }} {{ $allMarked ? 'disabled' : '' }}>
                                                </td>
                                                <td class="py-3 text-center">
                                                    <input type="radio" name="attendance[{{ $user->id }}][status]" value="1" class="form-check-input" onchange="toggleSiteSelection({{ $user->id }})" {{ $existingAttendance && $existingAttendance->status == '1' ? 'checked' : '' }} {{ $allMarked ? 'disabled' : '' }}>
                                                </td>
                                                <td class="py-3 text-center">
                                                    <input type="radio" name="attendance[{{ $user->id }}][status]" value="1.5" class="form-check-input" onchange="toggleSiteSelection({{ $user->id }})" {{ $existingAttendance && $existingAttendance->status == '1.5' ? 'checked' : '' }} {{ $allMarked ? 'disabled' : '' }}>
                                                </td>
                                                <td class="py-3 text-center">
                                                    <input type="radio" name="attendance[{{ $user->id }}][status]" value="2" class="form-check-input" onchange="toggleSiteSelection({{ $user->id }})" {{ $existingAttendance && $existingAttendance->status == '2' ? 'checked' : '' }} {{ $allMarked ? 'disabled' : '' }}>
                                                </td>
                                                <td class="py-3 text-center">
                                                    <input type="radio" name="attendance[{{ $user->id }}][status]" value="A" class="form-check-input" onchange="toggleSiteSelection({{ $user->id }})" {{ $existingAttendance && $existingAttendance->status == 'A' ? 'checked' : '' }} {{ $allMarked ? 'disabled' : '' }}>
                                                </td>
                                                <td class="py-3 text-start">
                                                    <select name="attendance[{{ $user->id }}][site_id]" id="site_select_{{ $user->id }}" class="form-control shadow-sm rounded-3 @error("attendance.$user->id.site_id") is-invalid @enderror" {{ ($existingAttendance && $existingAttendance->status == 'A') || $allMarked ? 'disabled' : '' }}>
                                                        <option value="">Select Site</option>
                                                        @foreach ($sites as $site)
                                                            <option value="{{ $site->id }}" {{ $existingAttendance && $existingAttendance->siteid == $site->id ? 'selected' : '' }}>{{ $site->sitelocation }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error("attendance.$user->id.site_id")
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                                <td class="py-3 pe-3 text-end">
                                                    <div class="d-flex justify-content-end gap-2">
                                                        <a href="{{ route('attendance.edit', $existingAttendance->id ?? '') }}" class="btn btn-sm btn-outline-warning rounded-pill px-2 py-1" style="font-size: 0.75rem;" {{ !$existingAttendance ? 'disabled' : '' }}>
                                                            <ion-icon name="pencil-outline" style="font-size: 14px; vertical-align: middle;"></ion-icon>
                                                        </a>
                                                        <a href="{{ route('attendance.view', [$user->id, $selectedDate]) }}" class="btn btn-sm btn-outline-primary rounded-pill px-2 py-1" style="font-size: 0.85rem;">
                                                            <ion-icon name="eye-outline" style="font-size: 14px; vertical-align: middle;"></ion-icon>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group basic mt-4">
                                <button type="submit" class="btn btn-primary btn-block rounded-pill py-3 fw-semibold shadow-sm" {{ $allMarked ? 'disabled' : '' }}>
                                    {{ $allMarked ? 'All Attendance Marked' : 'Submit Attendance' }}
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSiteSelection(userId) {
            const statusInputs = document.getElementsByName(`attendance[${userId}][status]`);
            const siteSelect = document.getElementById(`site_select_${userId}`);
            let isAbsent = false;

            for (let input of statusInputs) {
                if (input.checked && input.value === 'A') {
                    isAbsent = true;
                    break;
                }
            }

            siteSelect.disabled = isAbsent || {{ $allMarked ? 'true' : 'false' }};
            if (isAbsent) {
                siteSelect.value = '';
            }
            siteSelect.required = !isAbsent && !{{ $allMarked ? 'true' : 'false' }};
        }

        document.addEventListener('DOMContentLoaded', function () {
            @foreach ($users as $user)
                toggleSiteSelection({{ $user->id }});
            @endforeach
        });

        function updateDate(selectedDate) {
            window.location.href = "{{ route('attendance.index') }}?attendance_date=" + selectedDate;
        }
    </script>

    <style>
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important; }
        .headerButton:hover { background: rgba(255, 255, 255, 0.3) !important; }
        .btn-primary:hover { transform: scale(1.05); }
        .btn-outline-primary:hover { background-color: #007bff; color: white; transform: scale(1.05); }
        .btn-outline-warning:hover { background-color: #ffc107; color: white; transform: scale(1.05); }
        .table tbody tr:hover { background-color: rgba(0, 123, 255, 0.05); transition: background-color 0.3s ease; }
    </style>
@endsection