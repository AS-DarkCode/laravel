@extends('layouts.auth')

@section('content')
    <!-- App Header -->
    <div class="appHeader no-border transparent position-absolute">
        <div class="pageTitle">
            AKash
        </div>
        <div class="right">
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section mt-2 text-center">
            <h1>Log in</h1>
            <h4>Fill the form to log in</h4>
        </div>
        <div class="section mb-5 p-2">
            <form method="POST" action="{{ url('login') }}">
                @csrf

                <div class="card">
                    <div class="card-body pb-1">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="email1">E-mail</label>
                                <input type="email" class="form-control" id="email1" name="email" placeholder="Your e-mail" value="{{ old('email') }}">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Password</label>
                                <input type="password" class="form-control" id="password1" name="password" autocomplete="off" placeholder="Your password">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-links mt-2">
                    {{-- <div>
                        <a href="{{ url('register') }}">Register Now</a>
                    </div> --}}
                    {{-- <div>
                        <a href="{{ url('forgot-password') }}" class="text-muted">Forgot Password?</a>
                    </div> --}}
                </div>

                <div class="form-button-group transparent">
                    <button type="submit" class="btn btn-primary btn-block btn-lg" name="login">Log in</button>
                </div>
            </form>
        </div>
    </div>
    <!-- * App Capsule -->
@endsection