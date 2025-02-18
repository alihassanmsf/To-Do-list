<div>
    <!-- Optional success message -->
    @if (session()->has('message'))
        <div class="alert alert-success mb-3">
            {{ session('message') }}
        </div>
    @endif

    <!-- Button to Create a New Task -->
    <div class="mb-3 text-end">
        <button class="btn btn-success" wire:click="createTask">
            Create New Task
        </button>
        @if(auth()->user()->role->name === 'Admin')
            <a href="{{route('admin.dashboard')}}" class="btn btn-primary btn-sm float-end">Return To Dashboard</a>
        @elseif(auth()->user()->role->name === 'Manager')
            <a href="{{route('manager.dashboard')}}" class="btn btn-primary btn-sm float-end">Return To Dashboard</a>
        @endif
    </div>

    <!-- Your Styled Table Container -->
    <div class="table-container">
        <div class="table-header">
            Task Directory
        </div>
        <table class="table table-bordered"> <!-- or tasks-table, same style as you used -->
            <thead>
            <tr>
                <th>Name</th>
                <th>Assigned</th>
                <th>Due Date</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td><strong>{{ $task->name }}</strong></td>
                    <td>{{ $task->assignedUser ? $task->assignedUser->name : 'None' }}</td>
                    <td>{{ $task->due_date ?? 'N/A' }}</td>
                    <td>{{ $task->priority ?? 'N/A' }}</td>
                    <td>{{ $task->status ?? 'N/A' }}</td>
                    <td>
                        <button
                            class="btn btn-primary btn-sm"
                            wire:click="editTask({{ $task->id }})"
                        >
                            Edit
                        </button>
                        <button
                            class="btn btn-danger btn-sm"
                            wire:click="deleteTask({{ $task->id }})"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- The Modal -->
    @if($isModalOpen)
        <div class="modal fade show" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ $editMode ? 'Edit Task' : 'Create Task' }}
                        </h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <form wire:submit.prevent="saveTask">
                        <div class="modal-body">
                            <!-- Task Name -->
                            <div class="mb-3">
                                <label class="form-label">Task Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    wire:model="name"
                                    required
                                />
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea
                                    class="form-control"
                                    wire:model="description"
                                ></textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Due Date -->
                            <div class="mb-3">
                                <label class="form-label">Due Date</label>
                                <input
                                    type="date"
                                    class="form-control"
                                    wire:model="due_date"
                                />
                                @error('due_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Priority -->
                            <div class="mb-3">
                                <label class="form-label">Priority</label>
                                <select wire:model="priority" name="priority" id="priority" class="form-control" required>
                                    <option value="low" {{ (isset($task) && $task->priority == 'low') ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ (isset($task) && $task->priority == 'medium') ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ (isset($task) && $task->priority == 'high') ? 'selected' : '' }}>High</option>
                                </select>
                                @error('priority') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label class="form-label">Status</label>
{{--                                <input--}}
{{--                                    type="text"--}}
{{--                                    class="form-control"--}}
{{--                                    wire:model="status"--}}
{{--                                />--}}
                                <select wire:model="status" name="status" id="status" class="form-control" required>
                                    <option value="pending" {{ (isset($task) && $task->status == 'pending') ? 'selected' : '' }}>Pending</option>
                                    <option value="in_progress" {{ (isset($task) && $task->status == 'in_progress') ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ (isset($task) && $task->status == 'completed') ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Assigned User -->
                            @if($users->count() > 0)
                                <div class="mb-3">
                                    <label class="form-label">Assigned To</label>
                                    <select class="form-control" wire:model="assigned_for">
                                        <option value="">No One</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('assigned_for') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                {{ $editMode ? 'Update Task' : 'Create Task' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Dark backdrop for the modal -->
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
