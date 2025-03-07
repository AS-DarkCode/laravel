@extends('layouts.app')

@section('content')
    <!-- App Header -->
    <div class="appHeader bg-gradient-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px; background: linear-gradient(135deg, #007bff, #0056b3);">
        <div class="left">
            <a href="/" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: background 0.3s ease;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Manage Dashboard</span>
        </div>
        <div class="right">
            <a href="#" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: background 0.3s ease;">
                <ion-icon name="filter-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule for Content -->
    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            <!-- Messages -->
            @include('Admin.overview.messages')

            <!-- Dashboard Summary Cards -->
            {{-- <h2 class="mb-3 text-center fw-bold text-dark" style="font-size: 1.5rem; letter-spacing: 0.5px;">Financial Snapshot Without Admin</h2>
            <div class="row g-3 mb-4">
                <!-- Total Users -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-lg rounded-4 text-center bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb); transition: transform 0.3s ease; overflow: hidden;">
                        <div class="card-body py-4 position-relative">
                            <div class="icon-box rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #007bff, #0056b3);">
                                <ion-icon name="people-outline" style="font-size: 24px; color: white;"></ion-icon>
                            </div>
                            <h6 class="fw-semibold text-dark mb-1" style="font-size: 1rem;">Total Users</h6>
                            <span class="text-primary fw-bold" style="font-size: 1.2rem;">{{ $dashboardSummary['total_users'] }}</span>
                            <div class="position-absolute top-0 end-0 m-2 opacity-10">
                                <ion-icon name="people-outline" style="font-size: 40px;"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Working Days -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-lg rounded-4 text-center bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb); transition: transform 0.3s ease; overflow: hidden;">
                        <div class="card-body py-4 position-relative">
                            <div class="icon-box rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #28a745, #1e7e34);">
                                <ion-icon name="calendar-outline" style="font-size: 24px; color: white;"></ion-icon>
                            </div>
                            <h6 class="fw-semibold text-dark mb-1" style="font-size: 1rem;">Total Working Days</h6>
                            <span class="text-success fw-bold" style="font-size: 1.2rem;">{{ number_format($dashboardSummary['total_working_days'], 2) }}</span>
                            <div class="position-absolute top-0 end-0 m-2 opacity-10">
                                <ion-icon name="calendar-outline" style="font-size: 40px;"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Amount -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-lg rounded-4 text-center bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb); transition: transform 0.3s ease; overflow: hidden;">
                        <div class="card-body py-4 position-relative">
                            <div class="icon-box rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #ffc107, #e0a800);">
                                <ion-icon name="cash-outline" style="font-size: 24px; color: white;"></ion-icon>
                            </div>
                            <h6 class="fw-semibold text-dark mb-1" style="font-size: 1rem;">Total Amount</h6>
                            <span class="text-warning fw-bold" style="font-size: 1.2rem;">₹{{ number_format($dashboardSummary['total_amount'], 2) }}</span>
                            <div class="position-absolute top-0 end-0 m-2 opacity-10">
                                <ion-icon name="cash-outline" style="font-size: 40px;"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Payments Sent -->
<div class="col-6 col-md-4 col-lg-3">
    <a href="{{ route('payments.send_form') }}" class="text-decoration-none">
        <div class="card border-0 shadow-lg rounded-4 text-center bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb); transition: transform 0.3s ease; overflow: hidden;">
            <div class="card-body py-4 position-relative">
                <div class="icon-box rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #dc3545, #b02a37);">
                    <ion-icon name="send-outline" style="font-size: 24px; color: white;"></ion-icon>
                </div>
                <h6 class="fw-semibold text-dark mb-1" style="font-size: 1rem;">Payments Sent</h6>
                <span class="text-danger fw-bold" style="font-size: 1.2rem;">₹{{ number_format($dashboardSummary['total_payments_sent'], 2) }}</span>
                <div class="position-absolute top-0 end-0 m-2 opacity-10">
                    <ion-icon name="send-outline" style="font-size: 40px;"></ion-icon>
                </div>
            </div>
        </div>
    </a>
</div>

                <!-- Total Expenses -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-lg rounded-4 text-center bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb); transition: transform 0.3s ease; overflow: hidden;">
                        <div class="card-body py-4 position-relative">
                            <div class="icon-box rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #fd7e14, #e06b00);">
                                <ion-icon name="wallet-outline" style="font-size: 24px; color: white;"></ion-icon>
                            </div>
                            <h6 class="fw-semibold text-dark mb-1" style="font-size: 1rem;">Total Expenses</h6>
                            <span class="text-orange fw-bold" style="font-size: 1.2rem;">₹{{ number_format($dashboardSummary['total_expenses'], 2) }}</span>
                            <div class="position-absolute top-0 end-0 m-2 opacity-10">
                                <ion-icon name="wallet-outline" style="font-size: 40px;"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Profit -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-lg rounded-4 text-center bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb); transition: transform 0.3s ease; overflow: hidden;">
                        <div class="card-body py-4 position-relative">
                            <div class="icon-box rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #17a2b8, #117a8b);">
                                <ion-icon name="trending-up-outline" style="font-size: 24px; color: white;"></ion-icon>
                            </div>
                            <h6 class="fw-semibold text-dark mb-1" style="font-size: 1rem;">Total Profit</h6>
                            <span class="text-info fw-bold" style="font-size: 1.2rem;">₹{{ number_format($dashboardSummary['total_profit'], 2) }}</span>
                            <div class="position-absolute top-0 end-0 m-2 opacity-10">
                                <ion-icon name="trending-up-outline" style="font-size: 40px;"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Remaining Amount -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card border-0 shadow-lg rounded-4 text-center bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb); transition: transform 0.3s ease; overflow: hidden;">
                        <div class="card-body py-4 position-relative">
                            <div class="icon-box rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #6f42c1, #5a32a3);">
                                <ion-icon name="balance-scale-outline" style="font-size: 24px; color: white;"></ion-icon>
                            </div>
                            <h6 class="fw-semibold text-dark mb-1" style="font-size: 1rem;">Remaining Amount</h6>
                            <span class="text-purple fw-bold" style="font-size: 1.2rem;">₹{{ number_format($dashboardSummary['total_remaining'], 2) }}</span>
                            <div class="position-absolute top-0 end-0 m-2 opacity-10">
                                <ion-icon name="balance-scale-outline" style="font-size: 40px;"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Out-of-Pocket Loss -->
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow-lg rounded-4 text-center bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb); transition: transform 0.3s ease; overflow: hidden;">
                    <div class="card-body py-4 position-relative">
                        <div class="icon-box rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #343a40, #212529);">
                            <ion-icon name="trending-down-outline" style="font-size: 24px; color: white;"></ion-icon>
                        </div>
                        <h6 class="fw-semibold text-dark mb-1" style="font-size: 1rem;">Out-of-Pocket Loss</h6>
                        <span class="text-dark fw-bold" style="font-size: 1.2rem;">₹{{ number_format($dashboardSummary['out_of_pocket_loss'], 2) }}</span>
                        <div class="position-absolute top-0 end-0 m-2 opacity-10">
                            <ion-icon name="trending-down-outline" style="font-size: 40px;"></ion-icon>
                        </div>
                    </div>
                </div>
            </div>
            </div> --}}
            

            <!-- Manage Sections -->
            <h2 class="mb-4 text-center fw-bold text-dark" style="font-size: 1.5rem; letter-spacing: 0.5px;">Manage Sections</h2>
            <div class="row g-3">
                <!-- Users Manage -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('manage_users') }}" class="text-decoration-none">
                        <div class="card h-100 border-0 shadow-sm rounded-4 text-center bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div class="card-body py-4">
                                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(135deg, #007bff, #0056b3);">
                                    <ion-icon name="people-outline" style="font-size: 28px; color: white;"></ion-icon>
                                </div>
                                <h5 class="card-title fw-bold mb-1 fs-6 text-dark">Users</h5>
                                <p class="card-text text-muted small">Manage all user accounts</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Send Payment Manage -->
<div class="col-6 col-md-4 col-lg-3">
    <a href="{{ route('send.index') }}" class="text-decoration-none">
        <div class="card h-100 border-0 shadow-sm rounded-4 text-center bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb); transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="card-body py-4">
                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(135deg, #ff6b6b, #ff4757); box-shadow: 0 4px 12px rgba(255, 107, 107, 0.4);">
                    <ion-icon name="paper-plane-outline" style="font-size: 30px; color: white;"></ion-icon>
                </div>
                <h5 class="card-title fw-bold mb-1 fs-6 text-dark">Payment</h5>
                <p class="card-text text-muted small">Track Send payment transactions</p>
            </div>
        </div>
    </a>
</div>

<!-- Receive Payment Manage -->
<div class="col-6 col-md-4 col-lg-3">
    <a href="{{ route('receive.index') }}" class="text-decoration-none">
        <div class="card h-100 border-0 shadow-sm rounded-4 text-center bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb); transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="card-body py-4">
                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(135deg, #4facfe, #00f2fe); box-shadow: 0 4px 12px rgba(79, 172, 254, 0.4);">
                    <ion-icon name="download-outline" style="font-size: 30px; color: white;"></ion-icon>
                </div>
                <h5 class="card-title fw-bold mb-1 fs-6 text-dark">Receive</h5>
                <p class="card-text text-muted small">Track Receive payment transactions</p>
            </div>
        </div>
    </a>
</div>

                <!-- Expense Manage -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('expense.index') }}" class="text-decoration-none">
                        <div class="card h-100 border-0 shadow-sm rounded-4 text-center bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div class="card-body py-4">
                                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(135deg, #dc3545, #b02a37);">
                                    <ion-icon name="wallet-outline" style="font-size: 28px; color: white;"></ion-icon>
                                </div>
                                <h5 class="card-title fw-bold mb-1 fs-6 text-dark">Expense</h5>
                                <p class="card-text text-muted small">Monitor expenses</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Attendance Manage -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('attendance.index') }}" class="text-decoration-none">
                        <div class="card h-100 border-0 shadow-sm rounded-4 text-center bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div class="card-body py-4">
                                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(135deg, #ffc107, #e0a800);">
                                    <ion-icon name="calendar-outline" style="font-size: 28px; color: white;"></ion-icon>
                                </div>
                                <h5 class="card-title fw-bold mb-1 fs-6 text-dark">Attendance</h5>
                                <p class="card-text text-muted small">Track attendance records</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Site Manage -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('sites.index') }}" class="text-decoration-none">
                        <div class="card h-100 border-0 shadow-sm rounded-4 text-center bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div class="card-body py-4">
                                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(135deg, #17a2b8, #117a8b);">
                                    <ion-icon name="settings-outline" style="font-size: 28px; color: white;"></ion-icon>
                                </div>
                                <h5 class="card-title fw-bold mb-1 fs-6 text-dark">Site</h5>
                                <p class="card-text text-muted small">Manage site settings</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Overview Manage -->
                <div class="col-6 col-md-4 col-lg-3">
                    {{-- <a href="{{ route('overview.manage') }}" class="text-decoration-none"> --}}
                        <div class="card h-100 border-0 shadow-sm rounded-4 text-center bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <div class="card-body py-4">
                                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(135deg, #6f42c1, #5a32a3);">
                                    <ion-icon name="stats-chart-outline" style="font-size: 28px; color: white;"></ion-icon>
                                </div>
                                <h5 class="card-title fw-bold mb-1 fs-6 text-dark">Overview</h5>
                                <p class="card-text text-muted small">All financial overview</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS for Hover Effects -->
    <style>
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
        }
        .headerButton:hover {
            background: rgba(255, 255, 255, 0.3) !important;
        }
        .text-orange {
            color: #fd7e14 !important;
        }
        .text-purple {
            color: #6f42c1 !important;
        }
    </style>
@endsection