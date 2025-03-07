<!-- resources/views/Admin/users/edit.blade.php -->
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
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Edit User</span>
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
                    <form method="POST" enctype="multipart/form-data" action="{{ route('update_user', $user->id) }}">
                        @csrf
                        @method('POST')

                        <!-- Name -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="name">Name</label>
                            <input type="text" class="form-control shadow-sm rounded-3 @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter full name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="email">Email</label>
                            <input type="email" class="form-control shadow-sm rounded-3 @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password (Optional) -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="password">New Password (Leave blank to keep unchanged)</label>
                            <input type="password" class="form-control shadow-sm rounded-3 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter new password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="password_confirmation">Confirm New Password</label>
                            <input type="password" class="form-control shadow-sm rounded-3 @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contact -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="contact">Contact</label>
                            <input type="text" class="form-control shadow-sm rounded-3 @error('contact') is-invalid @enderror" id="contact" name="contact" placeholder="Enter contact number" value="{{ old('contact', $user->contact) }}">
                            @error('contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="address">Address</label>
                            <input type="text" class="form-control shadow-sm rounded-3 @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter address" value="{{ old('address', $user->address) }}">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Joining Date -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="joiningdate">Joining Date</label>
                            <input type="date" class="form-control shadow-sm rounded-3 @error('joiningdate') is-invalid @enderror" id="joiningdate" name="joiningdate" value="{{ old('joiningdate', $user->joiningdate ? $user->joiningdate->format('Y-m-d') : '') }}">
                            @error('joiningdate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Salary -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="setamount">Salary (₹)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3">₹</span>
                                <input type="number" step="0.01" class="form-control shadow-sm rounded-end-3 @error('setamount') is-invalid @enderror" id="setamount" name="setamount" placeholder="Enter salary" value="{{ old('setamount', $user->setamount) }}">
                            </div>
                            @error('setamount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Profile Picture -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="profile_pic">Profile Picture (Leave blank to keep existing)</label>
                            <input type="file" class="form-control shadow-sm rounded-3 @error('profile_pic') is-invalid @enderror" id="profile_pic" name="profile_pic">
                            @if ($user->profile_pic)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $user->profile_pic) }}" alt="Current Profile Picture" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                                    <p class="text-muted small mt-1">Current Profile Picture</p>
                                </div>
                            @endif
                            @error('profile_pic')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="role">Role</label>
                            <select class="form-control shadow-sm rounded-3 custom-select @error('role') is-invalid @enderror" id="role" name="role">
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Employee</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group basic mt-4">
                            <button type="submit" class="btn btn-primary btn-block rounded-pill py-3 fw-semibold">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection