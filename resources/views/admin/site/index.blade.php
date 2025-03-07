@extends('layouts.app')

@section('content')
    <div class="appHeader bg-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px;">
        <div class="left">
            <a href="{{ route('dashboard.manage') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Manage Sites</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
            <span class="badge bg-danger rounded-pill px-2 py-1" style="font-size: 16px;">{{ $sites->count() }}</span>
            <a href="{{ route('sites.create') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%;">
                <ion-icon name="add-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
    </div>

    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            @include('Admin.overview.messages')

            @if ($sites->isEmpty())
                <div class="card border-0 shadow-sm rounded-4 text-center">
                    <div class="card-body py-5">
                        <ion-icon name="sad-outline" style="font-size: 48px; color: #6c757d;"></ion-icon>
                        <h5 class="mt-3 text-muted fw-semibold">No Sites Found</h5>
                        <p class="text-muted mb-0 small">Add some sites to get started.</p>
                    </div>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover border-0 rounded-3">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="py-3 ps-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">Location</th>
                                <th scope="col" class="py-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">Contractor</th>
                                <th scope="col" class="py-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">Area (sq ft)</th>
                                <th scope="col" class="py-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">Start Date</th>
                                <th scope="col" class="py-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">End Date</th>
                                <th scope="col" class="py-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">Price (₹)</th>
                                <th scope="col" class="py-3 pe-3 text-muted small fw-semibold text-end" style="font-size: 0.85rem;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sites as $site)
                                <tr class="align-middle">
                                    <td class="py-3 ps-3 text-start">
                                        <span class="text-dark fw-semibold small" style="font-size: 0.85rem;">{{ $site->sitelocation }}</span>
                                    </td>
                                    <td class="py-3 text-start">
                                        <span class="text-muted small" style="font-size: 0.85rem;">{{ $site->contactorname }}</span>
                                    </td>
                                    <td class="py-3 text-start">
                                        <span class="text-muted small" style="font-size: 0.85rem;">{{ number_format(floatval($site->area), 2) }} sq ft</span>
                                    </td>
                                    <td class="py-3 text-start">
                                        <span class="text-muted small" style="font-size: 0.85rem;">{{ \Carbon\Carbon::parse($site->sitestartingdate)->format('d M, Y') }}</span>
                                    </td>
                                    <td class="py-3 text-start">
                                        <span class="text-muted small" style="font-size: 0.85rem;">{{ $site->siteendingdate ? \Carbon\Carbon::parse($site->siteendingdate)->format('d M, Y') : 'N/A' }}</span>
                                    </td>
                                    <td class="py-3 text-start">
                                        <span class="text-muted small" style="font-size: 0.85rem;">₹{{ $site->siteprice ? number_format(floatval($site->siteprice), 2) : 'N/A' }}</span>
                                    </td>
                                    <td class="py-3 pe-3 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('sites.edit', $site->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-2 py-1" style="font-size: 0.75rem;">
                                                <ion-icon name="pencil-outline" style="font-size: 14px; vertical-align: middle;"></ion-icon>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-2 py-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $site->id }}" style="font-size: 0.75rem;">
                                                <ion-icon name="trash-outline" style="font-size: 14px; vertical-align: middle;"></ion-icon>
                                            </button>

                                            <div class="modal fade" id="deleteModal{{ $site->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $site->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content border-0 rounded-4 shadow-sm">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title" id="deleteModalLabel{{ $site->id }}">Confirm Deletion</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <ion-icon name="alert-circle-outline" class="text-danger" style="font-size: 48px;"></ion-icon>
                                                            <p class="mt-3 mb-0 fw-semibold">Are you sure you want to delete this site?</p>
                                                            <p class="text-muted small">This action cannot be undone.</p>
                                                        </div>
                                                        <div class="modal-footer border-0 justify-content-center">
                                                            <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2" data-bs-dismiss="modal">Cancel</button>
                                                            <form action="{{ route('sites.destroy', $site->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you absolutely sure?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger rounded-pill px-4 py-2">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

    <style>
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important; }
        .headerButton:hover { background: rgba(255, 255, 255, 0.3) !important; }
        .btn-outline-warning:hover { background-color: #ffc107; color: white; transform: scale(1.05); }
        .btn-outline-danger:hover { background-color: #dc3545; color: white; transform: scale(1.05); }
        .table tbody tr:hover { background-color: rgba(0, 123, 255, 0.05); transition: background-color 0.3s ease; }
    </style>
@endsection