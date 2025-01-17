@extends('Home.layouts.main')
@section('content')
    <div class="auth-container">
        <div class="auth-form">
            <p class="auth-title">Create Account</p>
            <form class="auth-input-form" method="POST" action="{{ route('register.auth') }}">
                @csrf
                <input type="text" name="name" class="auth-input" placeholder="Username" required>
                <input type="email" name="email" class="auth-input" placeholder="Email" required>
                <div class="password-container">
                    <input type="password" name="password" class="auth-input password-input" placeholder="Password"
                        required>
                    <i class="bx bx-show password-toggle" onclick="togglePassword(this)"></i>
                </div>
                <div class="password-container">
                    <input type="password" name="password_confirmation" class="auth-input password-input"
                        placeholder="Confirm Password" required>
                    <i class="bx bx-show password-toggle" onclick="togglePassword(this)"></i>
                </div>
                <button type="submit" class="auth-submit-btn">Create Account</button>
            </form>
            <p class="auth-sign-up-label">
                Already have an account? <a href="{{ route('login') }}"><span class="auth-sign-up-link">Log
                        in</span></a>
            </p>
        </div>
    </div>
@endsection
