@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row">
            @foreach($tasks as $task)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <!-- Card Header -->
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Task: {{ $task->name }}</h5>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body d-flex flex-column justify-content-between">
                            <!-- User and Time Info -->
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                                        U
                                    </div>
                                    <span class="ms-3"><strong>Posted By:</strong> {{ $task->creator->name }}</span>
                                </div>
                                <span class="text-muted"><small>Created: {{ $task->created_at->format('d M Y, h:i A') }}</small></span>
                            </div>

                            <!-- Task Assignment and Deadline Info -->
                            <div class="mb-3">
                                <p><strong>Assigned To:</strong> {{ $task->assignedUser->name ?? 'Unassigned' }}</p>
                                <p><strong>Deadline:</strong> {{ $task->due_date }}</p>
                            </div>

                            <!-- Task Description -->
                            <p>{{ $task->description }}</p>
                        </div>

                        <!-- Card Footer -->
                        <div class="card-footer d-flex flex-wrap justify-content-between align-items-center {{ $task->status === 'completed' ? 'bg-success text-white' : '' }}">
                            <span><strong>Status:</strong> {{ ucfirst($task->status) }}</span>

                            <!-- Action Buttons -->
                            <div class="d-flex flex-wrap">
                                @if(auth()->user()->role->name == 'Admin')
                                    <a href="{{ route('tasks.edit', [$task->id]) }}" class="btn btn-primary btn-sm me-2">Edit</a>
                                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif

                                <form method="POST" action="{{ route('tasks.complete', $task->id) }}" style="display: inline;">
                                    @csrf
                                    <button {{ $task->status === 'completed' ? 'disabled' : '' }} type="submit" class="btn btn-outline-success btn-sm ms-2">
                                        Complete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
