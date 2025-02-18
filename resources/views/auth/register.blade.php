@extends('layouts.app')

@section('header')
@endsection

@section('content')

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display Error Messages -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <style>
        /* Custom Styles for Sexy Design */
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
    </style>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0" style="border-radius: 20px; background: linear-gradient(145deg, #ffffff, #f8f9fa);">
                    <div class="card-header border-0 py-4" style="background: linear-gradient(145deg, #6a11cb, #2575fc); border-radius: 20px 20px 0 0;">
                        <h1 class="h3 mb-0 text-white text-center">Register</h1>
                    </div>
                    <div class="card-body px-5 py-4">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name Input -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold text-muted">Name</label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg border-0 shadow-sm"
                                       placeholder="Enter your name" required
                                       style="border-radius: 12px; background: #f8f9fa;"  value="{{ old('name') }}">
                            </div>

                            <!-- Email Input -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold text-muted">Email</label>
                                <input type="email" name="email" id="email" class="form-control form-control-lg border-0 shadow-sm"
                                       placeholder="Enter your email" required
                                       style="border-radius: 12px; background: #f8f9fa;" value="{{ old('email') }}">
                            </div>

                            <!-- Password Input -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold text-muted">Password</label>
                                <input type="password" name="password" id="password" class="form-control form-control-lg border-0 shadow-sm"
                                       placeholder="Enter your password" required
                                       style="border-radius: 12px; background: #f8f9fa;">
                            </div>

                            <!-- Confirm Password Input -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-bold text-muted">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg border-0 shadow-sm"
                                       placeholder="Confirm your password" required
                                       style="border-radius: 12px; background: #f8f9fa;">
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-lg text-white fw-bold border-0 shadow-sm"
                                        style="background: linear-gradient(145deg, #6a11cb, #2575fc); border-radius: 12px;">
                                    Register
                                </button>
                                <a href="{{ route('login') }}" class="text-decoration-none text-primary fw-bold mt-3 custom-hover">
                                    <i class="bi bi-arrow-left me-2"></i>Or return to the login page
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
