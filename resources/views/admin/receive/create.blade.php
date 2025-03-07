@extends('layouts.app')

@section('content')
    <div class="appHeader bg-gradient-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px; background: linear-gradient(135deg, #007bff, #0056b3);">
        <div class="left">
            <a href="{{ route('receive.index') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: background 0.3s ease;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Receive Payment</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
        </div>
    </div>

    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            @include('Admin.overview.messages')

            <div class="card border-0 shadow-lg rounded-4 bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb);">
                <div class="card-body">
                    <form method="POST" action="{{ route('receive.store') }}">
                        @csrf

                        <select class="form-control shadow-sm rounded-3 custom-select @error('source_type') is-invalid @enderror" id="source_type" name="source_type" required onchange="toggleSourceFields()">
                            <option value="" disabled selected>Select source</option>
                            <optgroup label="Users">
                                @foreach ($users as $user)
                                    <option value="user|{{ $user->id }}" {{ old('source_type') == "user|{$user->id}" ? 'selected' : '' }}>{{ $user->name }} ({{ ucfirst($user->role) }})</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="Contractors">
                                @foreach ($sites->groupBy('contactorname') as $contractorName => $contractorSites)
                                    <option value="contractor|{{ $contractorName }}" {{ old('source_type') == "contractor|{$contractorName}" ? 'selected' : '' }}>{{ $contractorName }}</option>
                                @endforeach
                            </optgroup>
                        </select>

                        <!-- Hidden User ID -->
                        <input type="hidden" id="userid" name="userid" value="{{ old('userid') }}">

                        <!-- Site Dropdown (Shown only for Contractors) -->
                        <div class="form-group basic mb-3" id="site_field" style="display: none;">
                            <label class="label fw-semibold text-dark mb-2" for="siteid">Site</label>
                            <select class="form-control shadow-sm rounded-3 custom-select @error('siteid') is-invalid @enderror" id="siteid" name="siteid">
                                <option value="" disabled selected>Select a site</option>
                                @foreach ($sites as $site)
                                    <option value="{{ $site->id }}" data-contractor="{{ $site->contactorname }}" {{ old('siteid') == $site->id ? 'selected' : '' }}>{{ $site->sitelocation }}</option>
                                @endforeach
                            </select>
                            @error('siteid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="purpose">Purpose</label>
                            <textarea class="form-control shadow-sm rounded-3 @error('purpose') is-invalid @enderror" id="purpose" name="purpose" placeholder="Enter payment purpose" rows="3" required>{{ old('purpose') }}</textarea>
                            @error('purpose')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="amount">Amount (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3">₹</span>
                                <input type="number" step="0.01" class="form-control shadow-sm rounded-end-3 @error('amount') is-invalid @enderror" id="amount" name="amount" placeholder="Enter payment amount" value="{{ old('amount') }}" required>
                            </div>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="date">Date</label>
                            <input type="date" class="form-control shadow-sm rounded-3 @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group basic mt-4">
                            <button type="submit" class="btn btn-primary btn-block rounded-pill py-3 fw-semibold shadow-sm" style="transition: transform 0.3s ease;">Receive Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSourceFields() {
            const sourceTypeSelect = document.getElementById('source_type');
            const siteField = document.getElementById('site_field');
            const siteSelect = document.getElementById('siteid');
            const userIdInput = document.getElementById('userid');

            const selectedValue = sourceTypeSelect.value;
            const [type, value] = selectedValue.split('|');

            // Reset fields
            userIdInput.value = '';
            siteSelect.value = '';
            siteField.style.display = 'none';

            if (type === 'user') {
                userIdInput.value = value; // Set user ID
            } else if (type === 'contractor') {
                siteField.style.display = 'block';
                siteSelect.required = true;

                // Filter sites by contractor name
                const options = siteSelect.querySelectorAll('option');
                options.forEach(option => {
                    const contractor = option.getAttribute('data-contractor');
                    if (contractor === value || option.value === '') {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });
            }
        }

        // Trigger on page load to handle old input
        document.addEventListener('DOMContentLoaded', toggleSourceFields);
    </script>

    <style>
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important; }
        .headerButton:hover { background: rgba(255, 255, 255, 0.3) !important; }
        .btn-primary:hover { transform: scale(1.05); }
    </style>
@endsection