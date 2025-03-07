@extends('layouts.app')

@section('content')
    <div class="appHeader bg-gradient-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px; background: linear-gradient(135deg, #007bff, #0056b3);">
        <div class="left">
            <a href="{{ route('expense.index') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: background 0.3s ease;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Add Expense</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
        </div>
    </div>

    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            @include('Admin.overview.messages')

            <div class="card border-0 shadow-lg rounded-4 bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb);">
                <div class="card-body">
                    <form method="POST" action="{{ route('expense.store') }}">
                        @csrf

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="itemname">Item Name</label>
                            <input type="text" class="form-control shadow-sm rounded-3 @error('itemname') is-invalid @enderror" id="itemname" name="itemname" placeholder="Enter item name" value="{{ old('itemname') }}" required>
                            @error('itemname')
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

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="location">Location</label>
                            <input type="text" class="form-control shadow-sm rounded-3 @error('location') is-invalid @enderror" id="location" name="location" placeholder="Enter location" value="{{ old('location') }}" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="userid">User (Optional)</label>
                            <select class="form-control shadow-sm rounded-3 custom-select @error('userid') is-invalid @enderror" id="userid" name="userid">
                                <option value="" {{ old('userid') == '' ? 'selected' : '' }}>Default ({{ Auth::user()->name }})</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('userid') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ ucfirst($user->role) }})</option>
                                @endforeach
                            </select>
                            @error('userid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Leave blank to use current user ({{ Auth::user()->name }}).</small>
                        </div>

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="amount">Amount (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3">₹</span>
                                <input type="number" step="0.01" class="form-control shadow-sm rounded-end-3 @error('amount') is-invalid @enderror" id="amount" name="amount" placeholder="Enter amount" value="{{ old('amount') }}" required>
                            </div>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group basic mt-4">
                            <button type="submit" class="btn btn-primary btn-block rounded-pill py-3 fw-semibold shadow-sm" style="transition: transform 0.3s ease;">Add Expense</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important; }
        .headerButton:hover { background: rgba(255, 255, 255, 0.3) !important; }
        .btn-primary:hover { transform: scale(1.05); }
    </style>
@endsection