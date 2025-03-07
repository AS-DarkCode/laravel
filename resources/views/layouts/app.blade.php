@extends('layouts.app')

@section('content')
    <!-- App Header -->
    <div class="appHeader bg-gradient-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px; background: linear-gradient(135deg, #007bff, #0056b3);">
        <div class="left">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
                <ion-icon name="menu-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Admin Dashboard</span>
        </div>
        <div class="right">
            <!-- Add any right-side actions if needed -->
        </div>
    </div>

    <!-- Dashboard Content -->
    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            @include('Admin.overview.messages')

            <!-- Welcome Card -->
            <div class="card border-0 shadow-lg rounded-4 bg-gradient-light mb-4" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb);">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            @if (auth()->user()->profile_pic)
                                <img src="{{ asset('storage/' . auth()->user()->profile_pic) }}" alt="{{ auth()->user()->name }}" class="rounded-circle shadow-sm" style="width: 60px; height: 60px; object-fit: cover; border: 2px solid #007bff;">
                            @else
                                <div class="rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: #007bff; color: white; font-size: 24px; font-weight: bold;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="mb-1 fw-bold text-dark">Welcome, {{ auth()->user()->name }}</h3>
                            <p class="text-muted small mb-0">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm rounded-4 text-center" style="background: linear-gradient(135deg, #007bff, #0056b3); color: white;">
                        <div class="card-body">
                            <ion-icon name="people-outline" style="font-size: 32px;"></ion-icon>
                            <h5 class="mt-2 fw-semibold">Total Users</h5>
                            <h3 class="mb-0">{{ $totalUsers ?? 'N/A' }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm rounded-4 text-center" style="background: linear-gradient(135deg, #28a745, #218838); color: white;">
                        <div class="card-body">
                            <ion-icon name="cash-outline" style="font-size: 32px;"></ion-icon>
                            <h5 class="mt-2 fw-semibold">Total Profit</h5>
                            <h3 class="mb-0">₹{{ number_format($totalProfit ?? 0, 2) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm rounded-4 text-center" style="background: linear-gradient(135deg, #ffc107, #e0a800); color: white;">
                        <div class="card-body">
                            <ion-icon name="send-outline" style="font-size: 32px;"></ion-icon>
                            <h5 class="mt-2 fw-semibold">Payments Sent</h5>
                            <h3 class="mb-0">₹{{ number_format($totalPaymentsSent ?? 0, 2) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm rounded-4 text-center" style="background: linear-gradient(135deg, #dc3545, #c82333); color: white;">
                        <div class="card-body">
                            <ion-icon name="wallet-outline" style="font-size: 32px;"></ion-icon>
                            <h5 class="mt-2 fw-semibold">Total Expenses</h5>
                            <h3 class="mb-0">₹{{ number_format($totalExpenses ?? 0, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Users Table -->
            <div class="card border-0 shadow-lg rounded-4 bg-gradient-light mt-4" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb);">
                <div class="card-body">
                    <h3 class="mb-3 fw-bold text-dark">Recent Users</h3>
                    @if ($users->isEmpty())
                        <p class="text-muted">No users found.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover border-0 rounded-3">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="py-3 ps-3 text-muted small fw-semibold text-start">Name</th>
                                        <th class="py-3 text-muted small fw-semibold text-start">Email</th>
                                        <th class="py-3 text-muted small fw-semibold text-start">Profit</th>
                                        <th class="py-3 text-muted small fw-semibold text-start">Payments Sent</th>
                                        <th class="py-3 text-muted small fw-semibold text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="align-middle">
                                            <td class="py-3 ps-3 text-start">
                                                <span class="text-dark fw-semibold small">{{ $user->name }}</span>
                                            </td>
                                            <td class="py-3 text-start">
                                                <span class="text-muted small">{{ $user->email }}</span>
                                            </td>
                                            <td class="py-3 text-start">
                                                <span class="text-muted small">₹{{ number_format($user->total_profit ?? 0, 2) }}</span>
                                            </td>
                                            <td class="py-3 text-start">
                                                <span class="text-muted small">₹{{ number_format($user->total_send ?? 0, 2) }}</span>
                                            </td>
                                            <td class="py-3 text-end">
                                                <a href="{{ route('reports.show', $user->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-2 py-1">
                                                    <ion-icon name="eye-outline" style="font-size: 14px; vertical-align: middle;"></ion-icon> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important; }
        .headerButton:hover { background: rgba(255, 255, 255, 0.3) !important; }
        .btn-outline-primary:hover { background-color: #007bff; color: white; transform: scale(1.05); }
        .table tbody tr:hover { background-color: rgba(0, 123, 255, 0.05); transition: background-color 0.3s ease; }
    </style>
@endsection