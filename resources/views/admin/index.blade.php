<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-all">

<div class="min-h-screen flex">

    <!-- ✅ Sidebar -->
    <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg p-6 transition-all">
        <h1 class="text-2xl font-bold text-blue-600 dark:text-blue-400">Admin Dashboard</h1>

        <nav class="mt-6 space-y-2">
            <a href="#" class="flex items-center px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                <i class="fas fa-home mr-2"></i> Dashboard
            </a>
            <a href="{{ route('profile') }}" class="flex items-center px-4 py-2 rounded-lg hover:text-blue-600">
                <i class="fas fa-user mr-2"></i> Profile
            </a>
            <a href="{{ route('admin.users.list') }}" class="flex items-center px-4 py-2 rounded-lg hover:text-blue-600">
                <i class="fas fa-users mr-2"></i> Users List
            </a>
            <a href="{{ route('admin.tasks.list') }}" class="flex items-center px-4 py-2 rounded-lg hover:text-blue-600">
                <i class="fas fa-tasks mr-2"></i> Tasks List
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="flex items-center px-4 py-2 rounded-lg text-red-500 hover:bg-red-100 dark:hover:bg-red-700 transition">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- ✅ Main Content -->
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Welcome Back, Admin</h2>
            <div class="flex space-x-4">
                <a href="{{ route('admin.create-user') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition">
                    ➕ Add User
                </a>
                <a href="{{ route('admin.create-task') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 transition">
                    ➕ Add Task
                </a>
                <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-500 transition">
                    📊 Generate Report
                </button>
            </div>
        </div>

        <!-- ✅ Summary Cards -->
        <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transform hover:scale-105 transition">
                <h3 class="text-gray-700 dark:text-gray-300 font-bold">Users</h3>
                <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalUsers }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transform hover:scale-105 transition">
                <h3 class="text-gray-700 dark:text-gray-300 font-bold">Tasks</h3>
                <p class="text-4xl font-bold text-green-600 mt-2">{{ $totalTasks }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transform hover:scale-105 transition">
                <h3 class="text-gray-700 dark:text-gray-300 font-bold">In Progress</h3>
                <p class="text-4xl font-bold text-yellow-600 mt-2">{{ $totalInProgressTasks }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transform hover:scale-105 transition">
                <h3 class="text-gray-700 dark:text-gray-300 font-bold">Completed</h3>
                <p class="text-4xl font-bold text-green-600 mt-2">{{ $totalCompletedTasks }}</p>
            </div>
        </section>

        <!-- ✅ Recent Activities -->
        <section class="mt-6">
            <h3 class="text-xl font-bold text-gray-700 dark:text-gray-300">Recent Activities</h3>
            <div class="bg-white dark:bg-gray-800 mt-4 p-6 rounded-lg shadow-md">
                <table class="w-full border-collapse">
                    <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-sm">
                        <th class="p-2">#</th>
                        <th class="p-2">Activity</th>
                        <th class="p-2">Time</th>
                        <th class="p-2">Task Name</th>
                        <th class="p-2">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activities as $activity)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="p-2">{{ $activity->id }}</td>
                            <td class="p-2">{{ $activity->action }}</td>
                            <td class="p-2">{{ $activity->created_at->diffForHumans() }}</td>
                            @if(isset($activity->task))
                                <td class="p-2">{{ $activity->task->name }}</td>
                                <td class="p-2 {{ $activity->task->status == 'pending' ? 'text-red-600' : '' }}
                                           {{ $activity->task->status == 'in_progress' ? 'text-yellow-600' : '' }}
                                           {{ $activity->task->status == 'completed' ? 'text-green-600' : '' }}">
                                    {{ ucfirst($activity->task->status) }}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

</body>
</html>
