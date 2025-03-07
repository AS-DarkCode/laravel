@extends('layouts.app')

@section('content')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
        <div class="right">
            <a href="{{ url('notifications') }}" class="headerButton">
                <ion-icon class="icon" name="notifications-outline"></ion-icon>
                <span class="badge badge-danger">5</span>
            </a>
            <a href="{{ url('settings') }}" class="headerButton">
                <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" alt="image" class="imaged w32">
                <span class="badge badge-danger">6</span>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <!-- Wallet Card -->
        @include('Admin.overview.wallet_card')
        <!-- * Wallet Card -->
        
        {{-- message alert popup start --}}
        @include('Admin.overview.messages')
        {{-- message alert popup end --}}

        <!-- Add User form sheet start -->
        {{-- @include('Admin.forms.form_adduser') --}}
        <!--  Add User form Sheet end -->

        <!-- Payment Action form Sheet start-->
        {{-- @include('Admin.forms.form_payment') --}}
        <!-- * Payment Action form Sheet end-->

        <!-- Expense Action form Sheet start-->
        {{-- @include('Admin.forms.form_expense') --}}
        <!-- * Expense Action form Sheet end-->

        <!-- Create Site form Sheet start-->
        {{-- @include('Admin.forms.form_create_site') --}}
        <!-- * Create Site form Sheet end-->

        <!-- Stats -->
        {{-- @include('Admin.overview.total_stats') --}}
        <!-- * Stats -->

        <!-- Attendance Overview -->
        {{-- @include('Admin.overview.attendance_overview') --}}
        <!-- * Attendance Overview -->

        <!-- Working Fields -->
        {{-- @include('Admin.overview.working_fields') --}}
        <!-- * Working Fields -->

        <!-- Attendance Stats -->
        <div class="section mt-4">
            <div class="section-heading">
                <h2 class="title">Attendance Statistics</h2>
                <a href="{{ url('attendance-stats') }}" class="link">View Detailed</a>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card text-center" style="background: #fff; border-radius: 10px; box-shadow: 0 5px 15px rgba(220,53,69,0.2); padding: 15px;">
                        <ion-icon name="close-circle-outline" style="font-size: 2.5rem; color: #dc3545;"></ion-icon>
                        <h6 class="mt-2 mb-1">Most Absences</h6>
                        <h5 class="mb-0">Suresh Singh</h5>
                        <p class="text-muted">5 days</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card text-center" style="background: #fff; border-radius: 10px; box-shadow: 0 5px 15px rgba(40,167,69,0.2); padding: 15px;">
                        <ion-icon name="checkmark-circle-outline" style="font-size: 2.5rem; color: #28a745;"></ion-icon>
                        <h6 class="mt-2 mb-1">Best Attendance</h6>
                        <h5 class="mb-0">Priya Sharma</h5>
                        <p class="text-muted">20 days</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Attendance Stats -->

        <!-- Payment Stats -->
        <div class="section mt-4">
            <div class="section-heading">
                <h2 class="title">Payment Statistics</h2>
                <a href="{{ url('payment-stats') }}" class="link">View All</a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3 p-3" style="background: linear-gradient(to right, #fff, #fff3e0); border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 text-warning">Lowest Pending</h6>
                                <h5 class="mb-0">Rahul Verma</h5>
                            </div>
                            <div class="text-right">
                                <span class="badge bg-warning text-dark" style="font-size: 1.1rem;">₹ 2,000</span>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 p-3" style="background: linear-gradient(to right, #fff, #ffe5e5); border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 text-danger">Highest Pending</h6>
                                <h5 class="mb-0">Amit Sharma</h5>
                            </div>
                            <div class="text-right">
                                <span class="badge bg-danger text-white" style="font-size: 1.1rem;">₹ 8,000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Payment Stats -->

        <!-- Pending Actions -->
        <div class="section mt-4">
            <div class="section-heading">
                <h2 class="title">Pending Actions</h2>
                <a href="{{ url('pending-actions') }}" class="link">View All</a>
            </div>
            <div class="transactions">
                <a href="#" class="item">
                    <div class="detail">
                        <div class="icon-wrapper bg-warning image-block imaged w48">
                            <ion-icon name="send-outline"></ion-icon>
                        </div>
                        <div>
                            <strong>Rahul Verma</strong>
                            <p>Payment: Project Work</p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="price text-danger">₹ 5,000.00</div>
                    </div>
                </a>
                <a href="#" class="item">
                    <div class="detail">
                        <div class="icon-wrapper bg-danger image-block imaged w48">
                            <ion-icon name="cash-outline"></ion-icon>
                        </div>
                        <div>
                            <strong>Amit Sharma</strong>
                            <p>Expense: Office Supplies</p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="price text-danger">₹ 2,000.00</div>
                    </div>
                </a>
            </div>
        </div>
        <!-- * Pending Actions -->

        <!-- App Footer -->
        <div class="appFooter">
            <div class="footer-title">
                Copyright © AS-DarkCode 2025. All Rights Reserved.
            </div>
            Jai Shree Mahakaal
        </div>
        <!-- * App Footer -->
    </div>
    <!-- * App Capsule -->
@endsection
