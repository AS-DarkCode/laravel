@extends('layouts.app')

@section('content')
    <!-- App Header -->
    <div class="appHeader bg-gradient-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px; background: linear-gradient(135deg, #007bff, #0056b3);">
        <div class="left">
            <a href="{{ route('send.index') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: background 0.3s ease;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Send Payment</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule for Content -->
    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            <!-- Include Success/Error Messages -->
            @include('Admin.overview.messages')

            <!-- Form -->
            <div class="card border-0 shadow-lg rounded-4 bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb);">
                <div class="card-body">
                    <form method="POST" action="{{ route('send.store') }}" id="sendPaymentForm">
                        @csrf

                        <!-- Recipient (User) -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="userid">Send To (User)</label>
                            <select class="form-control shadow-sm rounded-3 custom-select @error('userid') is-invalid @enderror" id="userid" name="userid" required>
                                <option value="" disabled selected>Select recipient user</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('userid') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ ucfirst($user->role) }})</option>
                                @endforeach
                            </select>
                            @error('userid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Brief -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="breif">Brief</label>
                            <textarea class=" Wform-control shadow-sm rounded-3 @error('breif') is-invalid @enderror" id="breif" name="breif" placeholder="Enter payment brief" rows="3" required>{{ old('breif') }}</textarea>
                            @error('breif')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Payment Type -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="paymenttype">Payment Method</label>
                            <select class="form-control shadow-sm rounded-3 custom-select @error('paymenttype') is-invalid @enderror" id="paymenttype" name="paymenttype" required>
                                <option value="" disabled selected>Select payment method</option>
                                <option value="cash" {{ old('paymenttype') == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="online" {{ old('paymenttype') == 'online' ? 'selected' : '' }}>Online</option>
                            </select>
                            @error('paymenttype')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Transaction Date -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="transationdate">Transaction Date</label>
                            <input type="date" class="form-control shadow-sm rounded-3 @error('transationdate') is-invalid @enderror" id="transationdate" name="transationdate" value="{{ old('transationdate', now()->format('Y-m-d')) }}" required>
                            @error('transationdate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Amount -->
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

                        <!-- Submit Button -->
                        <div class="form-group basic mt-4">
                            <button type="submit" class="btn btn-primary btn-block rounded-pill py-3 fw-semibold shadow-sm" style="transition: transform 0.3s ease;">Send Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS for Hover Effects and Enhanced Styling -->
    <style>
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
        }
        .headerButton:hover {
            background: rgba(255, 255, 255, 0.3) !important;
        }
        .btn-primary:hover {
            transform: scale(1.05);
        }
        .form-group {
            position: relative;
        }
        .form-text {
            font-size: 0.85rem;
        }
        .custom-select:focus,
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }
    </style>
@endsection