@extends('layouts.app')

@section('content')
    <div class="appHeader bg-gradient-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px; background: linear-gradient(135deg, #007bff, #0056b3);">
        <div class="left">
            <a href="{{ route('attendance.index') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: background 0.3s ease;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Search Attendance</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
        </div>
    </div>

    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            @include('Admin.overview.messages')

            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body">
                    <form method="GET" action="{{ route('attendance.search') }}">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="label fw-semibold text-dark mb-2" for="start_date">Start Date</label>
                                <input type="date" class="form-control shadow-sm rounded-3" id="start_date" name="start_date" value="{{ $startDate }}" max="{{ now()->toDateString() }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="label fw-semibold text-dark mb-2" for="end_date">End Date</label>
                                <input type="date" class="form-control shadow-sm rounded-3" id="end_date" name="end_date" value="{{ $endDate }}" max="{{ now()->toDateString() }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="label fw-semibold text-dark mb-2" for="user_id">User</label>
                                <select class="form-control shadow-sm rounded-3" id="user_id" name="user_id">
                                    <option value="">All Users</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $userId == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ ucfirst($user->role) }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">Search</button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover border-0 rounded-3">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="py-3 ps-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">User</th>
                            <th scope="col" class="py-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">Date</th>
                            <th scope="col" class="py-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">Status</th>
                            <th scope="col" class="py-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">Site</th>
                            <th scope="col" class="py-3 pe-3 text-muted small fw-semibold text-end" style="font-size: 0.85rem;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendanceRecords as $record)
                            <tr class="align-middle">
                                <td class="py-3 ps-3 text-start">
                                    <span class="text-dark fw-semibold small" style="font-size: 0.85rem;">{{ $record->user->name }}</span>
                                </td>
                                <td class="py-3 text-start">
                                    <span class="text-muted small" style="font-size: 0.85rem;">{{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}</span>
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important; }
        .headerButton:hover { background: rgba(255, 255, 255, 0.3) !important; }
        .btn-primary:hover { transform: scale(1.05); }
        .table tbody tr:hover { background-color: rgba(0, 123, 255, 0.05); transition: background-color 0.3s ease; }
    </style>
@endsection