<!-- register.blade.php -->
@extends('layouts.app')

@section('content')
<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <h2>Create Account</h2>
            <p class="subtitle">Please fill in your information</p>
        </div>

        <div class="register-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Name Input -->
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <div class="input-group">
                        <span class="input-icon">
                            <i class="bi bi-person"></i>
                        </span>
                        <input id="name" 
                               type="text" 
                               class="form-input @error('name') is-invalid @enderror" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autocomplete="name" 
                               placeholder="Enter your full name"
                               autofocus>
                    </div>
                    @error('name')
                        <span class="error-message">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

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
                               placeholder="Enter your email">
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
                               autocomplete="new-password"
                               placeholder="Create a password">
                    </div>
                    @error('password')
                        <span class="error-message">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Confirm Password Input -->
                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <div class="input-group">
                        <span class="input-icon">
                            <i class="bi bi-lock-fill"></i>
                        </span>
                        <input id="password-confirm" 
                               type="password" 
                               class="form-input" 
                               name="password_confirmation" 
                               required 
                               autocomplete="new-password"
                               placeholder="Confirm your password">
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="form-group terms-group">
                    <label class="checkbox-container">
                        <input type="checkbox" name="terms" required>
                        <span class="checkmark"></span>
                        I agree to the <a href="#" class="terms-link">Terms & Conditions</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="register-button">
                    Create Account
                </button>

                <!-- Login Link -->
                <div class="login-link-container">
                    Already have an account? <a href="{{ route('login') }}" class="login-link">Sign in</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Main Container */
    .register-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(to right, #f8f9fa, #e9ecef);
        padding: 20px;
    }

    /* Register Card */
    .register-card {
        width: 100%;
        max-width: 450px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    /* Header Section */
    .register-header {
        text-align: center;
        padding: 30px 20px;
    }

    .register-header h2 {
        color: #2d3748;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .register-header .subtitle {
        color: #718096;
        font-size: 16px;
        margin: 0;
    }

    /* Form Body */
    .register-body {
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

    /* Terms Group */
    .terms-group {
        margin-bottom: 20px;
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

    .terms-link {
        color: #4299e1;
        text-decoration: none;
        font-weight: 500;
    }

    .terms-link:hover {
        text-decoration: underline;
    }

    /* Submit Button */
    .register-button {
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
        margin-bottom: 16px;
    }

    .register-button:hover {
        background: #3182ce;
        transform: translateY(-1px);
    }

    .register-button:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
    }

    /* Login Link */
    .login-link-container {
        text-align: center;
        color: #718096;
        font-size: 14px;
    }

    .login-link {
        color: #4299e1;
        text-decoration: none;
        font-weight: 500;
        margin-left: 4px;
    }

    .login-link:hover {
        text-decoration: underline;
    }

    /* Responsive Adjustments */
    @media (max-width: 480px) {
        .register-card {
            margin: 0 15px;
        }
        
        .register-body {
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

    .register-card {
        animation: fadeIn 0.5s ease-out;
    }
</style>
@endpush