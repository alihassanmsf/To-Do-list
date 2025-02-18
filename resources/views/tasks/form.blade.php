@extends('layouts.app')
@section('header')
@endsection
@section('content')
    <style>
        /* Custom Styles for Sexy Design */
        body {
            background: linear-gradient(145deg, #f8f9fa, #e9ecef);
        }

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

        .form-control, .form-select {
            border: none;
            border-radius: 12px;
            background: #f8f9fa;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
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
            <div class="col-md-8">
                <div class="card shadow-lg border-0" style="border-radius: 20px; background: linear-gradient(145deg, #ffffff, #f8f9fa);">
                    <div class="card-header border-0 py-4" style="background: linear-gradient(145deg, #6a11cb, #2575fc); border-radius: 20px 20px 0 0;">
                        <h1 class="h3 mb-0 text-white text-center">{{ isset($task) ? 'Edit Task' : 'Create Task' }}</h1>
                    </div>
                    <div class="card-body px-5 py-4">
                        <form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
                            @csrf
                            @if(isset($task))
                                @method('PUT')
                            @endif

                            <!-- Task Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold text-muted">Task Name</label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg border-0 shadow-sm"
                                       value="{{ isset($task) ? $task->name : old('name') }}" required
                                       style="border-radius: 12px; background: #f8f9fa;">
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold text-muted">Description</label>
                                <textarea name="description" id="description" class="form-control form-control-lg border-0 shadow-sm" rows="4" required
                                          style="border-radius: 12px; background: #f8f9fa;">{{ isset($task) ? $task->description : old('description') }}</textarea>
                            </div>

                            <!-- Due Date -->
                            <div class="mb-4">
                                <label for="due_date" class="form-label fw-bold text-muted">Due Date</label>
                                <input type="date" name="due_date" id="due_date" class="form-control form-control-lg border-0 shadow-sm"
                                       value="{{ isset($task) ? $task->due_date : old('due_date') }}" required
                                       style="border-radius: 12px; background: #f8f9fa;">
                            </div>

                            <!-- Priority -->
                            <div class="mb-4">
                                <label for="priority" class="form-label fw-bold text-muted">Priority</label>
                                <select name="priority" id="priority" class="form-select form-select-lg border-0 shadow-sm" required
                                        style="border-radius: 12px; background: #f8f9fa;">
                                    <option value="low" {{ (isset($task) && $task->priority == 'low') ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ (isset($task) && $task->priority == 'medium') ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ (isset($task) && $task->priority == 'high') ? 'selected' : '' }}>High</option>
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="mb-4">
                                <label for="status" class="form-label fw-bold text-muted">Status</label>
                                <select name="status" id="status" class="form-select form-select-lg border-0 shadow-sm" required
                                        style="border-radius: 12px; background: #f8f9fa;">
                                    <option value="pending" {{ (isset($task) && $task->status == 'pending') ? 'selected' : '' }}>Pending</option>
                                    <option value="in_progress" {{ (isset($task) && $task->status == 'in_progress') ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ (isset($task) && $task->status == 'completed') ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>

                            <!-- Assigned For -->
                            <div class="mb-4">
                                <label for="assigned_for" class="form-label fw-bold text-muted">Assign To</label>
                                <select name="assigned_for" id="assigned_for" class="form-select form-select-lg border-0 shadow-sm"
                                        style="border-radius: 12px; background: #f8f9fa;">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ (isset($task) && $task->assigned_for == $user->id) ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-lg text-white fw-bold border-0 shadow-sm"
                                        style="background: linear-gradient(145deg, #6a11cb, #2575fc); border-radius: 12px;">
                                    {{ isset($task) ? 'Update Task' : 'Create Task' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
