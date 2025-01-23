@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($task) ? 'Edit Task' : 'Create Task' }}</h1>

        <form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
            @csrf
            @if(isset($task))
                @method('PUT')
            @endif

            <!-- Task Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Task Name</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ isset($task) ? $task->name : old('name') }}" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ isset($task) ? $task->description : old('description') }}</textarea>
            </div>

            <!-- Due Date -->
            <div class="mb-3">
                <label for="due_date" class="form-label">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="form-control"
                       value="{{ isset($task) ? $task->due_date : old('due_date') }}" required>
            </div>

            <!-- Priority -->
            <div class="mb-3">
                <label for="priority" class="form-label">Priority</label>
                <select name="priority" id="priority" class="form-control" required>
                    <option value="low" {{ (isset($task) && $task->priority == 'low') ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ (isset($task) && $task->priority == 'medium') ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ (isset($task) && $task->priority == 'high') ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="pending" {{ (isset($task) && $task->status == 'pending') ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ (isset($task) && $task->status == 'in_progress') ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ (isset($task) && $task->status == 'completed') ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <!-- Assigned For -->
            <div class="mb-3">
                <label for="assigned_for" class="form-label">Assign To</label>
                <select name="assigned_for" id="assigned_for" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ (isset($task) && $task->assigned_for == $user->id) ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">{{ isset($task) ? 'Update Task' : 'Create Task' }}</button>
            </div>
        </form>
    </div>
@endsection
