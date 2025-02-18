<div class="container my-5">
    <div class="mb-4">
        <div class="position-relative">
            <input
                wire:model.live.debounce.300ms="search"
                type="text"
                placeholder="Search tasks..."
                class="form-control form-control-lg border-0 shadow-sm ps-5"
                style="border-radius: 12px; background: #f8f9fa; transition: all 0.3s ease;"
            />
            <!-- Search Icon -->
            <span class="position-absolute top-50 start-0 translate-middle-y ms-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#6a11cb" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg>
    </span>
        </div>
    </div>
    <div class="row">
        @foreach($tasks as $task)
            <div class="col-md-6 col-lg-4 mb-4">
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
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

                            <form method="POST" action="{{ route('tasks.complete', $task) }}" style="display: inline;">
                                @csrf
                                <button {{ $task->status === 'completed' ? 'disabled hidden' : '' }} type="submit" class="btn btn-outline-success btn-sm ms-2">
                                    Complete
                                </button>
                            </form>

                            <form method="POST" action="{{route('tasks.in_progress',$task)}}" style="display: inline;">
                                @csrf
                                <button type="submit" {{$task->status === 'in_progress'|| $task->status === 'completed' ?'disabled hidden':''}} class="btn btn-outline-warning btn-sm ms-2">
                                    In Progress
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
