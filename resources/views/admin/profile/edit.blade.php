@extends('layouts.app')

@section('content')
    <div class="appHeader bg-gradient-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px; background: linear-gradient(135deg, #007bff, #0056b3);">
        <div class="left">
            <a href="{{ route('admin.profile.index') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: all 0.3s ease;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Edit Profile</span>
        </div>
        <div class="right"></div>
    </div>

    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            @include('Admin.overview.messages')

            <div class="card border-0 shadow-lg rounded-4" style="background: linear-gradient(135deg, #ffffff, #f5f7fa);">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Name</label>
                            <input type="text" name="name" class="form-control shadow-sm rounded-3" value="{{ old('name', $admin->name) }}" required>
                            @error('name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Email Address</label>
                            <input type="email" name="email" class="form-control shadow-sm rounded-3" value="{{ old('email', $admin->email) }}" required>
                            @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Contact -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Contact Number</label>
                            <input type="text" name="contact" class="form-control shadow-sm rounded-3" value="{{ old('contact', $admin->contact) }}">
                            @error('contact')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Address</label>
                            <textarea name="address" class="form-control shadow-sm rounded-3">{{ old('address', $admin->address) }}</textarea>
                            @error('address')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Joining Date -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Joining Date</label>
                            <input type="date" name="joiningdate" class="form-control shadow-sm rounded-3" value="{{ old('joiningdate', $admin->joiningdate ? $admin->joiningdate->format('Y-m-d') : '') }}">
                            @error('joiningdate')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Amount -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Monthly Amount</label>
                            <input type="number" name="setamount" step="0.01" class="form-control shadow-sm rounded-3" value="{{ old('setamount', $admin->setamount) }}">
                            @error('setamount')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Profile Picture -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Profile Picture</label>
                            <input type="file" class="form-control shadow-sm rounded-3 @error('profile_pic') is-invalid @enderror" id="profile_pic" name="profile_pic">
                            @if ($admin->profile_pic)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $admin->profile_pic) }}" alt="Current Profile Picture" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                                    <p class="text-muted small mt-1">Current Profile Picture</p>
                                </div>
                            @endif
                            @error('profile_pic')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Change Password Section -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Change Password (Optional)</label>
                            <input type="password" name="password" class="form-control shadow-sm rounded-3" placeholder="Enter new password">
                            @error('password')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control shadow-sm rounded-3" placeholder="Confirm new password">
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary rounded-pill py-2 px-5 fw-semibold shadow-sm">Update Profile</button>
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