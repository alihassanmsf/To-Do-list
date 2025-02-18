<!-- resources/views/auth/profile.blade.php -->

@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        User Profile
                       <div class="container">
                           @if (!$editMode)
                               <a href="{{ route('profile', ['edit' => true]) }}" class="btn btn-primary btn-sm float-end">Edit Profile</a>
                           @endif
                           @if(auth()->user()->role->name === 'Admin')
                                   <a href="{{route('admin.dashboard')}}" class="btn btn-primary btn-sm float-end">Return To Dashboard</a>
                               @elseif(auth()->user()->role->name === 'Manager')
                                   <a href="{{route('manager.dashboard')}}" class="btn btn-primary btn-sm float-end">Return To Dashboard</a>
                           @endif
                       </div>
                       </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($editMode)
                            <!-- Edit Form -->
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password (Leave blank to keep current password)</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>

                                <button type="submit" class="btn btn-primary">Update Profile</button>
                                <a href="{{ route('profile') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        @else
                            <!-- Display Mode -->
                            <p><strong>Name:</strong> {{ $user->name }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Role:</strong> {{ $user->role->name }}</p> <!-- Assuming the role relationship exists -->
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
