<!-- resources/views/auth/passwords/reset.blade.php -->
@extends('layouts.app')

@section('content')
    <style>


        .card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .form-control {
            border: none;
            border-radius: 12px;
            background: #f8f9fa;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(106, 17, 203, 0.1);
        }

        .btn {
            border: none;
            border-radius: 12px;
            background: linear-gradient(145deg, #6a11cb, #2575fc);
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: linear-gradient(145deg, #2575fc, #6a11cb);
            box-shadow: 0 4px 12px rgba(106, 17, 203, 0.3);
        }

        .alert {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0" style="border-radius: 20px; background: linear-gradient(145deg, #ffffff, #f8f9fa);">
                    <div class="card-header border-0 py-4" style="background: linear-gradient(145deg, #6a11cb, #2575fc); border-radius: 20px 20px 0 0;">
                        <h1 class="h3 mb-0 text-white text-center">{{ __('passwords.Reset Password') }}</h1>
                    </div>
                    <div class="card-body px-5 py-4">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <!-- Hidden Token Field -->
                            <input type="hidden" name="token" value="{{ $token }}">

                            <!-- Email Input -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold text-muted">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control form-control-lg border-0 shadow-sm @error('email') is-invalid @enderror"
                                       name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                                       style="border-radius: 12px; background: #f8f9fa;">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold text-muted">{{ __('passwords.Password') }}</label>
                                <input id="password" type="password" class="form-control form-control-lg border-0 shadow-sm @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="new-password"
                                       style="border-radius: 12px; background: #f8f9fa;">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Confirm Password Input -->
                            <div class="mb-4">
                                <label for="password-confirm" class="form-label fw-bold text-muted">{{ __('passwords.Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control form-control-lg border-0 shadow-sm"
                                       name="password_confirmation" required autocomplete="new-password"
                                       style="border-radius: 12px; background: #f8f9fa;">
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-lg text-white fw-bold border-0 shadow-sm"
                                        style="background: linear-gradient(145deg, #6a11cb, #2575fc); border-radius: 12px;">
                                    {{ __('passwords.Reset Password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
