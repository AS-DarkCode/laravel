<!-- resources/views/Admin/payments/create.blade.php -->

@extends('layouts.app')

@section('content')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px;">
        <div class="left">
            <a href="{{ route('send.index') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Add New Payment</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
            <!-- Optional: Add a button or icon here if needed -->
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule for Content -->
    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            <!-- Include Success/Error Messages -->
            @include('Admin.overview.messages')

            <!-- Form -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('send  .store') }}">
                        @csrf

                        <!-- Action -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="action">Action</label>
                            <select class="form-control shadow-sm rounded-3 custom-select @error('action') is-invalid @enderror" id="action" name="action" required>
                                <option value="" disabled selected>Select Send or Receive</option>
                                <option value="send" {{ old('action') == 'send' ? 'selected' : '' }}>Send</option>
                                <option value="receive" {{ old('action') == 'receive' ? 'selected' : '' }}>Receive</option>
                            </select>
                            @error('action')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- To Whom (Recipient) -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="recipient_id">To Whom</label>
                            <select class="form-control shadow-sm rounded-3 custom-select @error('recipient_id') is-invalid @enderror" id="recipient_id" name="recipient_id" required>
                                <option value="" disabled selected>Select recipient user or admin</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('recipient_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('recipient_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Details -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="details">Details</label>
                            <textarea class="form-control shadow-sm rounded-3 @error('details') is-invalid @enderror" id="details" name="details" placeholder="Enter payment details" rows="3" required>{{ old('details') }}</textarea>
                            @error('details')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Method -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="method">Payment Method</label>
                            <select class="form-control shadow-sm rounded-3 custom-select @error('method') is-invalid @enderror" id="method" name="method" required>
                                <option value="" disabled selected>Select payment method</option>
                                <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="online" {{ old('method') == 'online' ? 'selected' : '' }}>Online</option>
                            </select>
                            @error('method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Transaction Date -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="transaction_date">Date/Time</label>
                            <input type="datetime-local" class="form-control shadow-sm rounded-3 @error('transaction_date') is-invalid @enderror" id="transaction_date" name="transaction_date" value="{{ old('transaction_date') }}" required>
                            @error('transaction_date')
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

                        <!-- By Whom (Sender) -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="user_id">By Whom</label>
                            <select class="form-control shadow-sm rounded-3 custom-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                                <option value="" disabled selected>Select sender user or admin</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group basic mt-4">
                            <button type="submit" class="btn btn-primary btn-block rounded-pill py-3 fw-semibold">Add Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection