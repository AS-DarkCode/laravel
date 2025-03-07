@extends('layouts.app')

@section('content')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px;">
        <div class="left">
            <a href="{{ route('attendance.index') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Mark Attendance</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
        </div>
    </div>
    <!-- * App Header -->

    <!-- Extra space -->
    <div class="extraHeader"></div>

    <!-- App Capsule for Content -->
    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            <!-- Include Success/Error Messages -->
            @include('Admin.overview.messages')

            <!-- Form -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('attendance.store') }}">
                        @csrf

                        <!-- User Selection -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="user_id">User</label>
                            <select class="form-control shadow-sm rounded-3 @error('attendance.0.user_id') is-invalid @enderror" id="user_id" name="attendance[0][user_id]" required>
                                <option value="">Select user</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('attendance.0.user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Attendance Date -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="attendance_date">Date</label>
                            <input type="date" class="form-control shadow-sm rounded-3 @error('attendance_date') is-invalid @enderror" id="attendance_date" name="attendance_date" value="{{ old('attendance_date', now()->toDateString()) }}" max="{{ now()->toDateString() }}" required>
                            @error('attendance_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2">Status</label>
                            <div class="d-flex gap-3">
                                @foreach (['0.5', '1', '1.5', '2', 'A'] as $status)
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="attendance[0][status]" id="status_{{ $status }}" value="{{ $status }}" onchange="toggleSiteSelection(0)" {{ old('attendance.0.status') == $status ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_{{ $status }}">{{ $status }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('attendance.0.status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Site Selection -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="site_select_0">Site (If Present)</label>
                            <select name="attendance[0][site_id]" id="site_select_0" class="form-control shadow-sm rounded-3" disabled>
                                <option value="">Select Site</option>
                                @foreach ($sites as $site)
                                    <option value="{{ $site->id }}">{{ $site->site_name }}</option>
                                @endforeach
                            </select>
                            @error('attendance.0.site_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group basic mt-4">
                            <button type="submit" class="btn btn-primary btn-block rounded-pill py-3 fw-semibold">Mark Attendance</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to Enable/Disable Site Selection -->
    <script>
        function toggleSiteSelection(index) {
            const statusInputs = document.getElementsByName(`attendance[${index}][status]`);
            const siteSelect = document.getElementById(`site_select_${index}`);
            let isAbsent = false;

            for (let input of statusInputs) {
                if (input.checked && input.value === 'A') {
                    isAbsent = true;
                    break;
                }
            }

            siteSelect.disabled = isAbsent;
            if (isAbsent) {
                siteSelect.value = '';
            }
        }
    </script>
@endsection