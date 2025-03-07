<!-- resources/views/admin/users/manage.blade.php -->
@extends('layouts.app')

@section('content')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px;">
        <div class="left">
            <a href="{{ route('dashboard.manage') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Manage Users</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
            <a href="{{ route('add_user.create') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%;">
                <ion-icon name="add-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
    </div>

    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm rounded-3 bg-success text-light" role="alert">
                    <div class="d-flex align-items-center">
                        <ion-icon name="checkmark-circle-outline" style="font-size: 24px; margin-right: 10px;"></ion-icon>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm rounded-3 bg-danger text-light" role="alert">
                    <div class="d-flex align-items-center">
                        <ion-icon name="alert-circle-outline" style="font-size: 24px; margin-right: 10px;"></ion-icon>
                        <div>
                            @foreach ($errors->all() as $error)
                                <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($users->isEmpty())
                <div class="card border-0 shadow-sm rounded-4 text-center">
                    <div class="card-body py-5">
                        <ion-icon name="sad-outline" style="font-size: 48px; color: #6c757d;"></ion-icon>
                        <h5 class="mt-3 text-muted fw-semibold">No Users Found</h5>
                        <p class="text-muted mb-0 small">Add some users to get started.</p>
                    </div>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover border-0 rounded-3">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="py-3 ps-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">User</th>
                                <th scope="col" class="py-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">Role</th>
                                <th scope="col" class="py-3 text-muted small fw-semibold text-start" style="font-size: 0.85rem;">Contact</th>
                                <th scope="col" class="py-3 pe-3 text-muted small fw-semibold text-end" style="font-size: 0.85rem;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="align-middle">
                                    <td class="py-3 ps-3 text-start">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : 'https://via.placeholder.com/40' }}" alt="Profile" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                            <span class="fw-semibold text-dark" style="font-size: 0.9rem;">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-start">
                                        <span class="badge {{ $user->role == 'admin' ? 'bg-danger' : 'bg-success' }} rounded-pill px-2 py-1" style="font-size: 0.75rem;">{{ ucfirst($user->role) }}</span>
                                    </td>
                                    <td class="py-3 text-start">
                                        <span class="text-muted small" style="font-size: 0.85rem;">{{ $user->contact }}</span>
                                    </td>
                                    <td class="py-3 pe-3 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('edit_user', $user->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-2 py-1" style="font-size: 0.75rem;">
                                                <ion-icon name="pencil-outline" style="font-size: 14px; vertical-align: middle;"></ion-icon>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-2 py-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}" style="font-size: 0.75rem;">
                                                <ion-icon name="trash-outline" style="font-size: 14px; vertical-align: middle;"></ion-icon>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content border-0 rounded-4 shadow-sm">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <ion-icon name="alert-circle-outline" class="text-danger" style="font-size: 48px;"></ion-icon>
                                                <p class="mt-3 mb-0 fw-semibold">Are you sure you want to delete <strong>{{ $user->name }}</strong>?</p>
                                                <p class="text-muted small">This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer border-0 justify-content-center">
                                                <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2" data-bs-dismiss="modal">Cancel</button>
                                                <a href="{{ route('delete_user', $user->id) }}" class="btn btn-danger rounded-pill px-4 py-2">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection