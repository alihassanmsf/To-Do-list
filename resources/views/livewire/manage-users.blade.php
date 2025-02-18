<div class="container mt-5">
    @if (session()->has('message'))
        <div class="alert alert-success mb-3">
            {{ session('message') }}
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <h2>Manage Users</h2>
        <button class="btn btn-success" wire:click="createUser">
            Create New User
        </button>
        <a class="btn btn-dark" href="{{route('admin.dashboard')}}">
            Return To Dashboard
        </a>
    </div>

    <!-- Users Table -->
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th width="150">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $usr)
            <tr>
                <td>{{ $usr->name }}</td>
                <td>{{ $usr->email }}</td>
                <td>{{ $usr->role ? ucfirst($usr->role->name) : 'N/A' }}</td>
                <td>
                    <button class="btn btn-primary"
                            wire:click="editUser({{ $usr->id }})">
                        Edit
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    @if ($isModalOpen)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ $editMode ? 'Edit User' : 'Create User' }}
                        </h5>
                        <button type="button" class="btn-close" aria-label="Close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control"
                                   wire:model="name"
                                   required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control"
                                   wire:model="email"
                                   required>
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Password (only for create or if editing and user wants to change) -->
                        @if(!$editMode || $password)
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control"
                                       wire:model="password">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control"
                                       wire:model="password_confirmation">
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        @endif

                        <!-- Role -->
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-control" wire:model="role_id">
                                <option value="">-- Select Role --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="closeModal">Close</button>
                        <button class="btn btn-primary" wire:click="saveUser">
                            {{ $editMode ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
