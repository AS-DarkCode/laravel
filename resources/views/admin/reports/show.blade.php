@extends('layouts.app')

@section('content')
    <div class="appHeader bg-gradient-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px; background: linear-gradient(135deg, #007bff, #0056b3);">
        <div class="left">
            <a href="{{ route('reports.index') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: background 0.3s ease;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Report for {{ $user->name }}</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
        </div>
    </div>

    <div id="appCapsule" class="pb-5 mb-5">
        <div class="section mt-3 px-3">
            @include('Admin.overview.messages')

            <!-- Date Range Filter -->
            <div class="card border-0 shadow-lg rounded-4 bg-gradient-light mb-4" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb);">
                <div class="card-body">
                    <form method="GET" action="{{ route('reports.show', $user->id) }}">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label fw-semibold text-dark">Start Date</label>
                                <input type="date" class="form-control shadow-sm rounded-3" name="start_date" value="{{ $startDate }}" max="{{ now()->toDateString() }}" required>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-semibold text-dark">End Date</label>
                                <input type="date" class="form-control shadow-sm rounded-3" name="end_date" value="{{ $endDate }}" max="{{ now()->toDateString() }}" required>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-block rounded-pill py-2">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- User Details with Profile Picture -->
            <div class="card border-0 shadow-lg rounded-4 bg-gradient-light mb-4" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb);">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-3">
                            @if ($user->profile_pic)
                                <img src="{{ asset('storage/' . $user->profile_pic) }}" alt="{{ $user->name }}" class="rounded-circle shadow-sm" style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #007bff;">
                            @else
                                <div class="rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: #007bff; color: white; font-size: 36px; font-weight: bold;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="mb-1 fw-bold text-dark">{{ $user->name }}</h3>
                            <p class="text-muted small mb-0">User Details</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Contact:</strong> {{ $user->contact ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Address:</strong> {{ $user->address ?? 'N/A' }}</p>
                            <p><strong>Joining Date:</strong> {{ $user->joiningdate ? $user->joiningdate->toDateString() : 'N/A' }}</p>
                            <p><strong>Daily Rate:</strong> ₹{{ number_format($user->setamount ?? 0, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Date-wise Records -->
            <div class="card border-0 shadow-lg rounded-4 bg-gradient-light mb-4" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb);">
                <div class="card-body">
                    <h3 class="mb-3 fw-bold text-dark">Records ({{ $formattedStartDate }} to {{ $formattedEndDate }})</h3>

                    <!-- Attendance -->
                    <h4 class="mb-3 text-dark fw-semibold">Attendance</h4>
                    @if ($attendanceRecords->isEmpty())
                        <p class="text-muted">No attendance records found.</p>
                    @else
                        <div class="table-responsive mb-4">
                            <table class="table table-hover border-0 rounded-3">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="py-3 ps-3 text-muted small fw-semibold text-start">Date</th>
                                        <th class="py-3 text-muted small fw-semibold text-start">Status</th>
                                        <th class="py-3 text-muted small fw-semibold text-start">Site</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendanceRecords as $record)
                                        <tr class="align-middle">
                                            <td class="py-3 ps-3 text-start">
                                                <span class="text-dark small">{{ $record->date->format('d M, Y') }}</span>
                                            </td>
                                            <td class="py-3 text-start">
                                                <span class="text-dark small">{{ ucfirst($record->status) }}</span>
                                            </td>
                                            <td class="py-3 text-start">
                                                <span class="text-dark small">{{ $record->site ? $record->site->sitelocation : 'N/A' }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <!-- Send Payments -->
                    <h4 class="mb-3 text-dark fw-semibold">Payments Sent</h4>
                    @if ($sendPaymentRecords->isEmpty())
                        <p class="text-muted">No payments sent found.</p>
                    @else
                        <div class="table-responsive mb-4">
                            <table class="table table-hover border-0 rounded-3">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="py-3 ps-3 text-muted small fw-semibold text-start">Date</th>
                                        <th class="py-3 text-muted small fw-semibold text-start">Brief</th>
                                        <th class="py-3 text-muted small fw-semibold text-start">Payment Type</th>
                                        <th class="py-3 text-muted small fw-semibold text-end">Amount (₹)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sendPaymentRecords as $record)
                                        <tr class="align-middle">
                                            <td class="py-3 ps-3 text-start">
                                                <span class="text-dark small">{{ $record->transationdate->format('d M, Y') }}</span>
                                            </td>
                                            <td class="py-3 text-start">
                                                <span class="text-dark small">{{ $record->breif }}</span>
                                            </td>
                                            <td class="py-3 text-start">
                                                <span class="text-dark small">{{ ucfirst($record->paymenttype) }}</span>
                                            </td>
                                            <td class="py-3 text-end">
                                                <span class="text-dark small">₹{{ number_format($record->amount, 2) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <!-- Expenses -->
                    <h4 class="mb-3 text-dark fw-semibold">Expenses</h4>
                    @if ($expenseRecords->isEmpty())
                        <p class="text-muted">No expenses found.</p>
                    @else
                        <div class="table-responsive mb-4">
                            <table class="table table-hover border-0 rounded-3">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="py-3 ps-3 text-muted small fw-semibold text-start">Date</th>
                                        <th class="py-3 text-muted small fw-semibold text-start">Item Name</th>
                                        <th class="py-3 text-muted small fw-semibold text-start">Location</th>
                                        <th class="py-3 text-muted small fw-semibold text-end">Amount (₹)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenseRecords as $record)
                                        <tr class="align-middle">
                                            <td class="py-3 ps-3 text-start">
                                                <span class="text-dark small">{{ $record->date->format('d M, Y') }}</span>
                                            </td>
                                            <td class="py-3 text-start">
                                                <span class="text-dark small">{{ $record->itemname }}</span>
                                            </td>
                                            <td class="py-3 text-start">
                                                <span class="text-dark small">{{ $record->location }}</span>
                                            </td>
                                            <td class="py-3 text-end">
                                                <span class="text-dark small">₹{{ number_format($record->amount, 2) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Summary -->
            <div class="card border-0 shadow-lg rounded-4 bg-gradient-light mb-4" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb);">
                <div class="card-body">
                    <h3 class="mb-3 fw-bold text-dark">Summary</h3>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <p><strong>Present Days:</strong> {{ $summary['present_days'] }}</p>
                            <p><strong>Total Earnings:</strong> ₹{{ number_format($summary['total_earnings'], 2) }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Total Sent:</strong> ₹{{ number_format($summary['total_send'], 2) }}</p>
                            <p><strong>Total Expenses:</strong> ₹{{ number_format($summary['total_expense'], 2) }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Total Profit:</strong> ₹{{ number_format($summary['total_profit'], 2) }}</p>
                            <p><strong>Total Remaining:</strong> ₹{{ number_format($summary['total_remaining'], 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Download Button -->
            <div class="text-center">
                <a href="{{ route('reports.download', $user->id) }}?start_date={{ $startDate }}&end_date={{ $endDate }}" class="btn btn-success rounded-pill py-3 px-5 fw-semibold shadow-sm">
                    <ion-icon name="download-outline" style="font-size: 16px; vertical-align: middle;"></ion-icon> Download PDF
                </a>
            </div>
        </div>
    </div>

    <style>
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important; }
        .headerButton:hover { background: rgba(255, 255, 255, 0.3) !important; }
        .btn-primary:hover { transform: scale(1.05); }
        .btn-success:hover { background-color: #218838; transform: scale(1.05); }
        .table tbody tr:hover { background-color: rgba(0, 123, 255, 0.05); transition: background-color 0.3s ease; }
    </style>
@endsection