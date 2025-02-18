@extends('layouts.app')

@section('header')
@endsection

@section('content')
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
        <div>
            @if (session('email'))
                <div class="alert alert-success">
                    {{ session('email') }}
                </div>
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0" style="border-radius: 20px; background: linear-gradient(145deg, #ffffff, #f8f9fa);">
                    <div class="card-header border-0 py-4" style="background: linear-gradient(145deg, #6a11cb, #2575fc); border-radius: 20px 20px 0 0;">
                        <h1 class="h3 mb-0 text-white text-center">Login</h1>
                    </div>
                    <div class="card-body px-5 py-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Input -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold text-muted">Email</label>
                                <input type="email" name="email" id="email" class="form-control form-control-lg border-0 shadow-sm"
                                       placeholder="Enter your email" required
                                       style="border-radius: 12px; background: #f8f9fa;">
                            </div>

                            <!-- Password Input -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold text-muted">Password</label>
                                <input type="password" name="password" id="password" class="form-control form-control-lg border-0 shadow-sm"
                                       placeholder="Enter your password" required
                                       style="border-radius: 12px; background: #f8f9fa;">
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-lg text-white fw-bold border-0 shadow-sm"
                                        style="background: linear-gradient(145deg, #6a11cb, #2575fc); border-radius: 12px;">
                                    Login
                                </button>
                                <a href="{{ route('password.request') }}" class="text-decoration-none mt-3 d-inline-block custom-hover">
                                    <span class="text-danger fw-bold">Forgot your password?</span>
                                    <span class="text-primary fw-bold"> Reset it here.</span>
                                </a>
                                <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold mt-3">
                                    Or register if you don't have an account
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
