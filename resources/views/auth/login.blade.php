<!-- login.blade.php -->
@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h2>Welcome Back</h2>
            <p class="subtitle">Please sign in to your account</p>
        </div>

        <div class="login-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email Input -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-group">
                        <span class="input-icon">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input id="email" 
                               type="email" 
                               class="form-input @error('email') is-invalid @enderror" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email" 
                               placeholder="Enter your email"
                               autofocus>
                    </div>
                    @error('email')
                        <span class="error-message">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <span class="input-icon">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input id="password" 
                               type="password" 
                               class="form-input @error('password') is-invalid @enderror" 
                               name="password" 
                               required 
                               autocomplete="current-password"
                               placeholder="Enter your password">
                    </div>
                    @error('password')
                        <span class="error-message">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="form-options">
                    <label class="checkbox-container">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                        Remember me
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="login-button">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Main Container */
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(to right, #f8f9fa, #e9ecef);
        padding: 20px;
    }

    /* Login Card */
    .login-card {
        width: 100%;
        max-width: 400px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    /* Header Section */
    .login-header {
        text-align: center;
        padding: 30px 20px;
    }

    .login-header h2 {
        color: #2d3748;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .login-header .subtitle {
        color: #718096;
        font-size: 16px;
        margin: 0;
    }

    /* Form Body */
    .login-body {
        padding: 0 32px 32px;
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 24px;
    }

    .form-group label {
        display: block;
        color: #4a5568;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 8px;
    }

    /* Input Groups */
    .input-group {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon {
        position: absolute;
        left: 12px;
        color: #a0aec0;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-input {
        width: 100%;
        padding: 12px 12px 12px 40px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 15px;
        color: #4a5568;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #4299e1;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.15);
    }

    .form-input::placeholder {
        color: #a0aec0;
    }

    /* Error Messages */
    .error-message {
        display: block;
        color: #e53e3e;
        font-size: 14px;
        margin-top: 5px;
    }

    .is-invalid {
        border-color: #e53e3e;
    }

    /* Options Row */
    .form-options {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }

    /* Checkbox Styling */
    .checkbox-container {
        display: flex;
        align-items: center;
        color: #4a5568;
        font-size: 14px;
        cursor: pointer;
    }

    .checkbox-container input {
        margin-right: 8px;
    }

    /* Forgot Password Link */
    .forgot-link {
        color: #4299e1;
        font-size: 14px;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .forgot-link:hover {
        color: #2b6cb0;
    }

    /* Submit Button */
    .login-button {
        width: 100%;
        padding: 12px;
        background: #4299e1;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .login-button:hover {
        background: #3182ce;
        transform: translateY(-1px);
    }

    .login-button:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
    }

    /* Responsive Adjustments */
    @media (max-width: 480px) {
        .login-card {
            margin: 0 15px;
        }
        
        .login-body {
            padding: 0 20px 20px;
        }
    }

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-card {
        animation: fadeIn 0.5s ease-out;
    }
</style>
@endpush