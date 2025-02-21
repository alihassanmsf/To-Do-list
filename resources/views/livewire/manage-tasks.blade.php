<div class="container mx-auto py-8 px-4" :class="darkMode ? 'bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-900'">

    <!-- ✅ Success Message -->
    @if (session()->has('message'))
        <div class="p-3 mb-4 rounded-lg bg-green-500 text-white shadow-lg">
            {{ session('message') }}
        </div>
    @endif

    <!-- ✅ Top Action Buttons -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Task Management</h2>
        <div class="space-x-3">
            <button class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300 transform hover:scale-105"
                    wire:click="createTask">
                ➕ Create Task
            </button>

            @if(auth()->user()->role->name === 'Admin')
                <a href="{{route('admin.dashboard')}}"
                   class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition duration-300 transform hover:scale-105">
                    ⬅ Return To Dashboard
                </a>
            @elseif(auth()->user()->role->name === 'Manager')
                <a href="{{route('manager.dashboard')}}"
                   class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition duration-300 transform hover:scale-105">
                    ⬅ Return To Dashboard
                </a>
            @endif
        </div>
    </div>

    <!-- ✅ Styled Table -->
    <div class="bg-white dark:bg-gray-800 bg-opacity-80 backdrop-blur-lg shadow-md rounded-lg overflow-hidden transition duration-300 hover:shadow-2xl">
        <table class="w-full border-collapse">
            <thead>
            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-sm">
                <th class="px-6 py-3 text-left">Task</th>
                <th class="px-6 py-3 text-left">Assigned</th>
                <th class="px-6 py-3 text-left">Due Date</th>
                <th class="px-6 py-3 text-left">Priority</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4 text-gray-900 dark:text-gray-100 font-semibold">{{ $task->name }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                        {{ $task->assignedUser ? $task->assignedUser->name : 'None' }}
                    </td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ date('d M Y', strtotime($task->due_date)) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-sm font-semibold rounded-full"
                              :class="{
                                'bg-green-500 text-white': '{{ $task->priority }}' === 'high',
                                'bg-yellow-500 text-white': '{{ $task->priority }}' === 'medium',
                                'bg-gray-500 text-white': '{{ $task->priority }}' === 'low'
                              }">
                            {{ ucfirst($task->priority) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-sm font-semibold rounded-full"
                              :class="{
                                'bg-red-500 text-white': '{{ $task->status }}' === 'pending',
                                'bg-yellow-500 text-white': '{{ $task->status }}' === 'in_progress',
                                'bg-green-500 text-white': '{{ $task->status }}' === 'completed'
                              }">
                            {{ ucfirst($task->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105"
                                wire:click="editTask({{ $task->id }})">
                            ✏ Edit
                        </button>
                        <button class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300 transform hover:scale-105"
                                wire:click="deleteTask({{ $task->id }})">
                            ❌ Delete
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- ✅ Task Modal -->
    @if($isModalOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl w-96 p-6 transition-all transform scale-95">

                <!-- ✅ Modal Header -->
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-xl font-semibold">
                        {{ $editMode ? 'Edit Task' : 'Create Task' }}
                    </h5>
                    <button class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300"
                            wire:click="closeModal">
                        ❌
                    </button>
                </div>

                <!-- ✅ Task Form -->
                <form wire:submit.prevent="saveTask">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium">Task Name</label>
                            <input type="text" wire:model="name"
                                   class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Description</label>
                            <textarea wire:model="description"
                                      class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Due Date</label>
                            <input type="date" wire:model="due_date"
                                   class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <!-- ✅ Modal Buttons -->
                    <div class="mt-4 flex justify-end space-x-3">
                        <button class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition"
                                wire:click="closeModal">
                            ❌ Close
                        </button>
                        <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
                                type="submit">
                            {{ $editMode ? 'Update Task' : 'Create Task' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
