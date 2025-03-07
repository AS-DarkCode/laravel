@extends('layouts.app')

@section('content')
    <div class="appHeader bg-gradient-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px; background: linear-gradient(135deg, #007bff, #0056b3);">
        <div class="left">
            <a href="{{ route('dashboard.manage') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: background 0.3s ease;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">User Reports</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
        </div>
    </div>

    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            @include('Admin.overview.messages')

            <div class="card border-0 shadow-lg rounded-4 bg-gradient-light" style="background: linear-gradient(135deg, #f5f7fa, #e4e7eb);">
                <div class="card-body">
                    @if ($users->isEmpty())
                        <div class="text-center py-5">
                            <ion-icon name="sad-outline" style="font-size: 48px; color: #6c757d;"></ion-icon>
                            <h5 class="mt-3 text-muted fw-semibold">No Users Found</h5>
                            <p class="text-muted mb-0 small">Add some users to generate their reports.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover border-0 rounded-3">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="py-3 ps-3 text-muted small fw-semibold text-start">User Name</th>
                                        <th scope="col" class="py-3 text-muted small fw-semibold text-start">Set Amount</th>
                                        <th scope="col" class="py-3 text-muted small fw-semibold text-start">Present Days</th>
                                        <th scope="col" class="py-3 text-muted small fw-semibold text-start">Total Profit</th>
                                        <th scope="col" class="py-3 text-muted small fw-semibold text-start">Send Amount</th>
                                        <th scope="col" class="py-3 text-muted small fw-semibold text-start">Expenses</th>
                                        <th scope="col" class="py-3 text-muted small fw-semibold text-start">Remaining Amount</th>
                                        <th scope="col" class="py-3 text-muted small fw-semibold text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="align-middle {{ auth()->id() === $user->id ? 'bg-light' : '' }}">
                                            <td class="py-3 ps-3 text-start">
                                                <span class="text-dark fw-semibold small">
                                                    {{ $user->name }} {{ auth()->id() === $user->id ? '(Me)' : '' }}
                                                </span>
                                            </td>
                                            <td class="py-3 text-start">
                                                <span class="text-muted small">₹{{ number_format($user->setamount ?? 0, 2) }}</span>
                                            </td>
                                            <td class="py-3 text-start">
                                                <span class="text-muted small">{{ $user->attendance()->where('status', 'present')->count() }}</span>
                                            </td>
                                            <td class="py-3 text-start">
                                                <span class="text-muted small">₹{{ number_format($user->total_profit, 2) }}</span>
                                            </td>
                                            <td class="py-3 text-start">
                                                <span class="text-muted small">₹{{ number_format($user->total_send, 2) }}</span>
                                            </td>
                                            <td class="py-3 text-start">
                                                <span class="text-muted small">₹{{ number_format($user->total_expense, 2) }}</span>
                                            </td>
                                            <td class="py-3 text-start">
                                                <span class="text-muted small">₹{{ number_format($user->remaining_amount, 2) }}</span>
                                            </td>
                                            <td class="py-3 pe-3 text-end">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('reports.show', $user->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-2 py-1">
                                                        <ion-icon name="eye-outline" style="font-size: 14px; vertical-align: middle;"></ion-icon> View
                                                    </a>
                                                    <a href="{{ route('reports.download', $user->id) }}" class="btn btn-sm btn-outline-success rounded-pill px-2 py-1">
                                                        <ion-icon name="download-outline" style="font-size: 14px; vertical-align: middle;"></ion-icon> PDF
                                                    </a>
                                                </div>
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
        .btn-outline-success:hover { background-color: #28a745; color: white; transform: scale(1.05); }
        .table tbody tr:hover { background-color: rgba(0, 123, 255, 0.05); transition: background-color 0.3s ease; }
        .bg-light { background-color: #e9ecef !important; } /* Highlight admin row */
    </style>
@endsection