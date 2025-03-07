@extends('layouts.app')

@section('content')
    <div class="appHeader bg-primary text-light border-0 d-flex align-items-center px-3" style="height: 60px;">
        <div class="left">
            <a href="{{ route('sites.index') }}" class="headerButton d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 50%;">
                <ion-icon name="chevron-back-outline" style="font-size: 24px;"></ion-icon>
            </a>
        </div>
        <div class="pageTitle flex-grow-1 text-center">
            <span class="fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">Edit Site</span>
        </div>
        <div class="right d-flex align-items-center gap-2">
        </div>
    </div>

    <div id="appCapsule" class="pb-5">
        <div class="section mt-3 px-3">
            @include('Admin.overview.messages')

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('sites.update', $site->id) }}">
                        @csrf
                        @method('POST')

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="sitelocation">Site Location</label>
                            <input type="text" class="form-control shadow-sm rounded-3 @error('sitelocation') is-invalid @enderror" id="sitelocation" name="sitelocation" placeholder="Enter site location" value="{{ old('sitelocation', $site->sitelocation) }}" required>
                            @error('sitelocation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="contactorname">Contractor Name</label>
                            <input type="text" class="form-control shadow-sm rounded-3 @error('contactorname') is-invalid @enderror" id="contactorname" name="contactorname" placeholder="Enter contractor name" value="{{ old('contactorname', $site->contactorname) }}" required>
                            @error('contactorname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="area">Area (sq ft)</label>
                            <div class="input-group">
                                <input type="number" step="0.01" class="form-control shadow-sm rounded-3 @error('area') is-invalid @enderror" id="area" name="area" placeholder="Enter site area" value="{{ old('area', $site->area) }}" required>
                                <span class="input-group-text bg-light border-start-0 rounded-end-3">sq ft</span>
                            </div>
                            @error('area')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="sitestartingdate">Start Date</label>
                            <input type="date" class="form-control shadow-sm rounded-3 @error('sitestartingdate') is-invalid @enderror" id="sitestartingdate" name="sitestartingdate" value="{{ old('sitestartingdate', $site->sitestartingdate->format('Y-m-d')) }}" required>
                            @error('sitestartingdate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="siteendingdate">End Date (Optional)</label>
                            <input type="date" class="form-control shadow-sm rounded-3 @error('siteendingdate') is-invalid @enderror" id="siteendingdate" name="siteendingdate" value="{{ old('siteendingdate', $site->siteendingdate ? $site->siteendingdate->format('Y-m-d') : '') }}">
                            @error('siteendingdate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group basic mb-3">
                            <label class="label fw-semibold text-dark mb-2" for="siteprice">Price (₹, Optional)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3">₹</span>
                                <input type="number" step="0.01" class="form-control shadow-sm rounded-end-3 @error('siteprice') is-invalid @enderror" id="siteprice" name="siteprice" placeholder="Enter site price" value="{{ old('siteprice', $site->siteprice) }}">
                            </div>
                            @error('siteprice')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group basic mt-4">
                            <button type="submit" class="btn btn-primary btn-block rounded-pill py-3 fw-semibold">Update Site</button>
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