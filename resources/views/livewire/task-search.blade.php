<div class="container mx-auto py-8 px-4" :class="darkMode ? 'bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-900'">

    <!-- ✅ Livewire Search Bar -->
    <div class="relative w-full max-w-lg mx-auto mb-6">
        <input wire:model.debounce.300ms="search"
               wire:keydown.debounce.300ms="search"
               wire:model.defer="search"
               type="text"
               class="w-full px-4 py-3 pl-10 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all shadow-md"
               placeholder="Search tasks...">
        <!-- Search Icon -->
        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-400">
            🔍
        </span>
    </div>

    <!-- ✅ Task List with Hover-to-Reveal Description -->
    <div class="space-y-6">
        @forelse($tasks as $task)
            <div class="relative flex items-center bg-white dark:bg-gray-800 bg-opacity-80 backdrop-blur-lg shadow-xl rounded-full p-4 border border-gray-200 dark:border-gray-700 transition transform hover:scale-[1.02] hover:shadow-2xl duration-300"
                 x-data="{ showDetails: false }"
                 @mouseover="showDetails = true" @mouseleave="showDetails = false">

                <!-- ✅ Task Status Indicator -->
                <div class="w-12 h-12 flex-shrink-0 rounded-full shadow-md"
                     :class="{
                        'bg-red-500 shadow-red-300': '{{ $task->status }}' === 'pending',
                        'bg-yellow-400 shadow-yellow-300': '{{ $task->status }}' === 'in_progress',
                        'bg-green-500 shadow-green-300': '{{ $task->status }}' === 'completed'
                     }">
                </div>

                <!-- ✅ Task Details -->
                <div class="flex-1 px-5">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        {{ $task->name }}
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 flex items-center">
                        📅 {{ date('d M Y', strtotime($task->due_date)) }} • ⏰ {{ date('h:i A', strtotime($task->due_date)) }}
                    </p>
                    <!-- ✅ Task Description (Only Show on Hover) -->
                    <p x-show="showDetails"
                       class="mt-2 text-sm text-gray-500 dark:text-gray-300 transition duration-300 opacity-0"
                       :class="{ 'opacity-100': showDetails }">
                        {{ $task->description }}
                    </p>
                </div>

                <!-- ✅ Action Buttons (Minimal & Clean) -->
                <div class="flex space-x-3">
                    <!-- ✅ Edit Button -->
                    <a href="{{ route('tasks.edit', [$task->id]) }}"
                       class="px-4 py-2 text-sm font-medium bg-blue-500 text-white rounded-full hover:bg-blue-600 transition shadow-md">
                        ✏ Edit
                    </a>

                    <!-- ✅ Delete Button (Only for Admin) -->
                    @if(auth()->user()->role->name == 'Admin')
                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 text-sm font-medium bg-red-500 text-white rounded-full hover:bg-red-600 transition shadow-md">
                                ❌ Delete
                            </button>
                        </form>
                    @endif

                    <!-- ✅ Complete Button -->
                    <form method="POST" action="{{ route('tasks.complete', $task) }}">
                        @csrf
                        <button type="submit"
                                {{ $task->status === 'completed' ? 'disabled hidden' : '' }}
                                class="px-4 py-2 text-sm font-medium bg-green-500 text-white rounded-full hover:bg-green-600 transition shadow-md">
                            ✅ Complete
                        </button>
                    </form>

                    <!-- ✅ Mark In Progress Button -->
                    <form method="POST" action="{{ route('tasks.in_progress', $task) }}">
                        @csrf
                        <button type="submit"
                                {{ $task->status === 'in_progress' || $task->status === 'completed' ? 'disabled hidden' : '' }}
                                class="px-4 py-2 text-sm font-medium bg-yellow-500 text-white rounded-full hover:bg-yellow-600 transition shadow-md">
                            ⏳ In Progress
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <div class="text-center text-gray-600 dark:text-gray-300">
                No tasks found.
            </div>
        @endforelse
    </div>
</div>
