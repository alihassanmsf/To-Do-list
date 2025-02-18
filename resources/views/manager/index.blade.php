<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
        <div class="p-6">
            <h1 class="text-xl font-bold text-gray-800">Manager Dashboard</h1>
        </div>
        <nav class="mt-6">
            <a href="#" class="block py-2.5 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-blue-600">
                <i class="fas fa-home mr-2"></i> Dashboard
            </a>
            <a href="{{ route('profile') }}" class="block py-2.5 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-blue-600">
                <i class="fas fa-user mr-2"></i> Profile
            </a>
            <a href="{{ route('manager.manage-tasks') }}" class="block py-2.5 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-blue-600">
                <i class="fas fa-tasks mr-2"></i> Tasks List
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block py-2.5 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-blue-600">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-700">Welcome Back, Manager</h2>
            <div class="flex space-x-4">
                <a  class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-500 no-underline">
                    Add Task
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <h3 class="text-gray-700 font-bold">Total Tasks</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalTasks }}</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <h3 class="text-gray-700 font-bold">In Progress Tasks</h3>
                <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $totalInProgressTasks }}</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <h3 class="text-gray-700 font-bold">Pending Tasks</h3>
                <p class="text-3xl font-bold text-red-600 mt-2">{{ $totalPendingTasks }}</p>
            </div>

            <!-- Card 4 -->
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <h3 class="text-gray-700 font-bold">Completed Tasks</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalCompletedTasks }}</p>
            </div>
        </section>

        <!-- Recent Activities -->
        <section class="mt-6">
            <h3 class="text-xl font-bold text-gray-700">Recent Activities</h3>
            <div class="bg-white mt-4 p-4 rounded-lg shadow-lg">
                <table class="w-full border-collapse">
                    <thead>
                    <tr class="text-left border-b">
                        <th class="p-2">#</th>
                        <th class="p-2">Activity</th>
                        <th class="p-2">Time</th>
                        <th class="p-2">Task Name</th>
                        <th class="p-2">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activities as $activity)
                        <tr class="border-b">
                            <td class="p-2">{{ $activity->id }}</td>
                            <td class="p-2">{{ $activity->action }}</td>
                            <td class="p-2">{{ $activity->created_at->diffForHumans() }}</td>
                            @if(isset($activity->task))
                                <td class="p-2">{{ $activity->task->name }}</td>
                                <td class="p-2 {{ $activity->task->status === 'pending' ? 'text-red-600' : ($activity->task->status === 'in_progress' ? 'text-yellow-600' : 'text-green-600') }}">
                                    {{ $activity->task->status }}
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
