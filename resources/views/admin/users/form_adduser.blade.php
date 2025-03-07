<!-- resources/views/Admin/users/adduserform.blade.php -->

@extends('layouts.app')

@section('content')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px;">
        <div class="left">
            <a href="{{ route('manage_users') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Add New User</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
            <!-- Optional: Add a button or icon here if needed -->
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule for Content -->
    <div id="appCapsule" class="pb-5 mb-4">
        <div class="section mt-3 px-3">
            <!-- Include Success/Error Messages -->
            @include('Admin.overview.messages')

            <!-- Form -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('add_user.store') }}">
                        @csrf
                        <!-- Name -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="name">Name</label>
                            <input type="text" class="form-control shadow-sm rounded-3 @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter full name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="email">Email</label>
                            <input type="email" class="form-control shadow-sm rounded-3 @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="password">Password</label>
                            <input type="password" class="form-control shadow-sm rounded-3 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control shadow-sm rounded-3 @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contact -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="contact">Contact</label>
                            <input type="text" class="form-control shadow-sm rounded-3 @error('contact') is-invalid @enderror" id="contact" name="contact" placeholder="Enter contact number" value="{{ old('contact') }}" required>
                            @error('contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="address">Address</label>
                            <input type="text" class="form-control shadow-sm rounded-3 @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter address" value="{{ old('address') }}" required>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Joining Date -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="joiningdate">Joining Date</label>
                            <input type="date" class="form-control shadow-sm rounded-3 @error('joiningdate') is-invalid @enderror" id="joiningdate" name="joiningdate" value="{{ old('joiningdate') }}" required>
                            @error('joiningdate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Salary -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="setamount">Salary (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3">₹</span>
                                <input type="number" step="0.01" class="form-control shadow-sm rounded-end-3 @error('setamount') is-invalid @enderror" id="setamount" name="setamount" placeholder="Enter salary" value="{{ old('amount') }}" required>
                            </div>
                            @error('setamount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Profile Picture -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="profile_pic">Profile Picture</label>
                            <input type="file" class="form-control shadow-sm rounded-3 @error('profile_pic') is-invalid @enderror" id="profile_pic" name="profile_pic">
                            @error('profile_pic')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="role">Role</label>
                            <select class="form-control shadow-sm rounded-3 custom-select @error('role') is-invalid @enderror" id="role" name="role">
                                <option value="" disabled selected>Select role</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Employee</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group basic mt-4">
                            <button type="submit" class="btn btn-primary btn-block rounded-pill py-3 fw-semibold" name="users-register-btn">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection