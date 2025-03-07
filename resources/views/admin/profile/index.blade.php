@extends('layouts.app')

@section('content')
    <!-- App Header -->
    <div class="appHeader bg-gradient-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px; background: linear-gradient(135deg, #007bff, #0056b3);">
        <div class="left">
            <a href="{{ route('admin.dashboard') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: all 0.3s ease;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">My Profile</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
            <a href="{{ url('notifications') }}" class="headerButton">
                <ion-icon class="icon" name="notifications-outline" style="font-size: 24px;"></ion-icon>
                <span class="badge badge-danger">4</span>
            </a>
        </div>
    </div>

    <!-- App Capsule for Content -->
    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            <!-- Success/Error Messages -->
            @include('Admin.overview.messages')

            <!-- Profile Overview -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden position-relative" style="background: linear-gradient(135deg, #ffffff, #f5f7fa);">
                <div class="card-body text-center py-5 position-relative">
                    <div class="avatar-section mb-4">
                        @if ($adminData['profile_pic'] && Storage::disk('public')->exists($adminData['profile_pic']))
                            <img src="{{ asset('storage/' . $adminData['profile_pic']) }}" alt="avatar" class="imaged rounded-circle mb-2" style="width: 120px; height: 120px; border: 4px solid #007bff; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
                        @else
                            <img src="{{ asset('images/default-profile.jpg') }}" alt="default avatar" class="imaged rounded-circle mb-2" style="width: 120px; height: 120px; border: 4px solid #007bff; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
                            <p class="text-muted small">No profile picture available</p>
                        @endif
                        <h2 class="fw-bold text-dark mb-1" style="font-size: 1.8rem;">{{ $adminData['name'] }}</h2>
                        <span class="badge bg-primary text-white px-3 py-1 rounded-pill" style="font-size: 0.9rem;">{{ $adminData['role'] }}</span>
                    </div>
                    <!-- Edit Profile Button -->
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.profile.edit') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold" style="transition: all 0.3s ease;">
                            <ion-icon name="pencil-outline" style="font-size: 16px; vertical-align: middle;"></ion-icon> Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="mt-4">
                <h4 class="fw-bold text-dark mb-3 text-center" style="font-size: 1.5rem;">Profile Details</h4>
                <div class="row g-3">
                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 position-relative overflow-hidden" style="background: linear-gradient(145deg, #f5f7fa, #e4e7eb); transition: all 0.3s ease;">
                            <div class="card-body py-4 px-3 d-flex align-items-center">
                                <div class="icon-box rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #007bff, #0056b3);">
                                    <ion-icon name="mail-outline" style="font-size: 24px; color: white;"></ion-icon>
                                </div>
                                <div>
                                    <h6 class="fw-semibold text-dark mb-1" style="font-size: 1rem;">Email Address</h6>
                                    <p class="text-muted mb-0" style="font-size: 0.9rem;">{{ $adminData['email'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Contact -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 position-relative overflow-hidden" style="background: linear-gradient(145deg, #f5f7fa, #e4e7eb); transition: all 0.3s ease;">
                            <div class="card-body py-4 px-3 d-flex align-items-center">
                                <div class="icon-box rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #28a745, #1e7e34);">
                                    <ion-icon name="call-outline" style="font-size: 24px; color: white;"></ion-icon>
                                </div>
                                <div>
                                    <h6 class="fw-semibold text-dark mb-1" style="font-size: 1rem;">Contact Number</h6>
                                    <p class="text-muted mb-0" style="font-size: 0.9rem;">{{ $adminData['contact'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Address -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 position-relative overflow-hidden" style="background: linear-gradient(145deg, #f5f7fa, #e4e7eb); transition: all 0.3s ease;">
                            <div class="card-body py-4 px-3 d-flex align-items-center">
                                <div class="icon-box rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #ff9800, #e68a00);">
                                    <ion-icon name="location-outline" style="font-size: 24px; color: white;"></ion-icon>
                                </div>
                                <div>
                                    <h6 class="fw-semibold text-dark mb-1" style="font-size: 1rem;">Address</h6>
                                    <p class="text-muted mb-0" style="font-size: 0.9rem;">{{ $adminData['address'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Joining Date -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 position-relative overflow-hidden" style="background: linear-gradient(145deg, #f5f7fa, #e4e7eb); transition: all 0.3s ease;">
                            <div class="card-body py-4 px-3 d-flex align-items-center">
                                <div class="icon-box rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #17a2b8, #138496);">
                                    <ion-icon name="calendar-outline" style="font-size: 24px; color: white;"></ion-icon>
                                </div>
                                <div>
                                    <h6 class="fw-semibold text-dark mb-1" style="font-size: 1rem;">Joining Date</h6>
                                    <p class="text-muted mb-0" style="font-size: 0.9rem;">{{ $adminData['joining_date'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Amount -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 position-relative overflow-hidden" style="background: linear-gradient(145deg, #f5f7fa, #e4e7eb); transition: all 0.3s ease;">
                            <div class="card-body py-4 px-3 d-flex align-items-center">
                                <div class="icon-box rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #dc3545, #c82333);">
                                    <ion-icon name="wallet-outline" style="font-size: 24px; color: white;"></ion-icon>
                                </div>
                                <div>
                                    <h6 class="fw-semibold text-dark mb-1" style="font-size: 1rem;">Monthly Amount</h6>
                                    <p class="text-muted mb-0" style="font-size: 0.9rem;">{{ $adminData['amount'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logout Button -->
            <div class="text-center m-4">
                <form method="POST" action="{{ route('admin.profile.logout') }}" onsubmit="return confirm('Are you sure you want to log out?');">
                    @csrf
                    <button type="submit" class="btn btn-danger rounded-pill py-2 px-5 fw-semibold shadow-sm" style="transition: all 0.3s ease;">
                        <ion-icon name="log-out-outline" style="font-size: 16px; vertical-align: middle;"></ion-icon> Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- CSS for Modern Styling -->
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1) !important;
        }
        .headerButton:hover {
            background: rgba(255, 255, 255, 0.3) !important;
        }
        .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
            transform: scale(1.05);
        }
        .btn-danger:hover {
            transform: scale(1.05);
        }
        .imaged {
            object-fit: cover;
        }
        ion-icon {
            vertical-align: middle;
        }
    </style>
@endsection