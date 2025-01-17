@extends('Home.layouts.main')
@section('content')
    <div class="auth-container">
        <div class="auth-form">
            <p class="auth-title">Log in</p>
            <form class="auth-input-form" method="POST" action="{{ route('login.auth') }}">
                @csrf
                <input type="email" name="email" class="auth-input" placeholder="Email" required>
                <div class="password-container">
                    <input type="password" name="password" class="auth-input password-input" placeholder="Password"
                        required>
                    <i class="bx bx-show password-toggle" onclick="togglePassword(this)"></i>
                </div>
                <button type="submit" class="auth-submit-btn">Log in</button>
            </form>
            <p class="auth-sign-up-label">
                Don't have an account?<a href="{{ route('register') }}"><span class="auth-sign-up-link">Create an
                        account</span></a>
            </p>
        </div>
    </div>
@endsection
