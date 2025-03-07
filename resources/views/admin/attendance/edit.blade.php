@extends('layouts.app')

@section('content')
    <div class="appHeader bg-gradient-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px; background: linear-gradient(135deg, #007bff, #0056b3);">
        <div class="left">
            <a href="{{ route('attendance.index', ['attendance_date' => $attendance->date]) }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: background 0.3s ease;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Edit Attendance</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
        </div>
    </div>

    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            @include('Admin.overview.messages')

            <div class="card border-0 shadow-lg rounded-4 bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb);">
                <div class="card-body">
                    <form method="POST" action="{{ route('attendance.update', $attendance->id) }}">
                        @csrf
                        @method('POST')

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="userid">User</label>
                            <select class="form-control shadow-sm rounded-3 custom-select @error('userid') is-invalid @enderror" id="userid" name="userid" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('userid', $attendance->userid) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ ucfirst($user->role) }})</option>
                                @endforeach
                            </select>
                            @error('userid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="date">Date</label>
                            <input type="date" class="form-control shadow-sm rounded-3 @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $attendance->date->format('Y-m-d')) }}" max="{{ now()->toDateString() }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2">Status</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="status_05" name="status" value="0.5" {{ old('status', $attendance->status) == 0.5 ? 'checked' : '' }} onchange="toggleSiteField()" required>
                                    <label class="form-check-label" for="status_05">0.5</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="status_1" name="status" value="1" {{ old('status', $attendance->status) == 1 ? 'checked' : '' }} onchange="toggleSiteField()">
                                    <label class="form-check-label" for="status_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="status_15" name="status" value="1.5" {{ old('status', $attendance->status) == 1.5 ? 'checked' : '' }} onchange="toggleSiteField()">
                                    <label class="form-check-label" for="status_15">1.5</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="status_2" name="status" value="2" {{ old('status', $attendance->status) == 2 ? 'checked' : '' }} onchange="toggleSiteField()">
                                    <label class="form-check-label" for="status_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="status_A" name="status" value="A" {{ old('status', $attendance->status) == 'A' ? 'checked' : '' }} onchange="toggleSiteField()">
                                    <label class="form-check-label" for="status_A">A</label>
                                </div>
                            </div>
                            @error('status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group basic mb-3" id="site_field">
                            <label class="label fw-semibold text-dark mb-2" for="siteid">Site</label>
                            <select class="form-control shadow-sm rounded-3 custom-select @error('siteid') is-invalid @enderror" id="siteid" name="siteid">
                                <option value="">Select Site</option>
                                @foreach ($sites as $site)
                                    <option value="{{ $site->id }}" {{ old('siteid', $attendance->siteid) == $site->id ? 'selected' : '' }}>{{ $site->sitelocation }}</option>
                                @endforeach
                            </select>
                            @error('siteid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group basic mt-4">
                            <button type="submit" class="btn btn-primary btn-block rounded-pill py-3 fw-semibold shadow-sm" style="transition: transform 0.3s ease;">Update Attendance</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSiteField() {
            const statusInputs = document.getElementsByName('status');
            const siteField = document.getElementById('site_field');
            let isAbsent = false;

            for (let input of statusInputs) {
                if (input.checked && input.value === 'A') {
                    isAbsent = true;
                    break;
                }
            }

            siteField.style.display = isAbsent ? 'none' : 'block';
            document.getElementById('siteid').required = !isAbsent;
            if (isAbsent) {
                document.getElementById('siteid').value = '';
            }
        }

        document.addEventListener('DOMContentLoaded', toggleSiteField);
    </script>

    <style>
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important; }
        .headerButton:hover { background: rgba(255, 255, 255, 0.3) !important; }
        .btn-primary:hover { transform: scale(1.05); }
    </style>
@endsection