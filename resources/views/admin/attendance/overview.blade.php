@extends('layouts.app')

@section('content')
    <div class="appHeader bg-gradient-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px; background: linear-gradient(135deg, #007bff, #0056b3);">
        <div class="left">
            <a href="{{ route('dashboard.manage') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: background 0.3s ease;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Attendance Overview</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
            <a href="{{ route('attendance.index') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: background 0.3s ease;" title="Mark Attendance">
                <ion-icon name="calendar-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
    </div>

    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            @include('Admin.overview.messages')

            @if ($users->isEmpty())
                <div class="card border-0 shadow-sm rounded-4 text-center">
                    <div class="card-body py-5">
                        <ion-icon name="sad-outline" style="font-size: 48px; color: #6c757d;"></ion-icon>
                        <h5 class="mt-3 text-muted fw-semibold">No Users Found</h5>
                        <p class="text-muted mb-0 small">Add some users to view attendance summaries.</p>
                    </div>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover border-0 rounded-3">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="py-3 ps-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">User Name</th>
                                <th scope="col" class="py-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">Total Present (Days)</th>
                                <th scope="col" class="py-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">Total Absent</th>
                                <th scope="col" class="py-3 pe-3 text-muted small fw-semibold text-end" style="font-size: 0.85rem;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="align-middle">
                                    <td class="py-3 ps-3 text-start">
                                        <span class="text-dark fw-semibold small" style="font-size: 0.85rem;">{{ $user->name }} ({{ ucfirst($user->role) }})</span>
                                    </td>
                                    <td class="py-3 text-start">
                                        <span class="text-muted small" style="font-size: 0.85rem;">{{ $userAttendanceSummaries[$user->id]['total_present'] }}</span>
                                    </td>
                                    <td class="py-3 text-start">
                                        <span class="text-muted small" style="font-size: 0.85rem;">{{ $userAttendanceSummaries[$user->id]['total_absent'] }}</span>
                                    </td>
                                    <td class="py-3 pe-3 text-end">
                                        <a href="{{ route('attendance.view', [$user->id]) }}" class="btn btn-sm btn-outline-primary rounded-pill px-2 py-1" style="font-size: 0.75rem;">
                                            <ion-icon name="eye-outline" style="font-size: 14px; vertical-align: middle;"></ion-icon>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <style>
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important; }
        .headerButton:hover { background: rgba(255, 255, 255, 0.3) !important; }
        .btn-outline-primary:hover { background-color: #007bff; color: white; transform: scale(1.05); }
        .table tbody tr:hover { background-color: rgba(0, 123, 255, 0.05); transition: background-color 0.3s ease; }
    </style>
@endsection