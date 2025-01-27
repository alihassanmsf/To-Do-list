<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
        <div class="p-6">
            <h1 class="text-xl font-bold text-gray-800">Laravel Dashboard</h1>
        </div>
        <nav class="mt-6">
            <a href="#" class="block py-2.5 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-blue-600"><i
                    class="fas fa-home mr-2"></i> Dashboard</a>
            <a href="#" class="block py-2.5 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-blue-600"><i
                    class="fas fa-user mr-2"></i> Profile</a>
            <a href="#" class="block py-2.5 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-blue-600"><i
                    class="fas fa-cog mr-2"></i> Settings</a>
            <form  method="POST" action="{{route('logout')}}">
                @csrf
                <button type="submit"
                        class="block py-2.5 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-blue-600"><i
                        class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>

            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-700">Welcome Back</h2>
            <div class="flex space-x-4">
                <a  class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500 no-underline">Add User</a>
                <a href="{{route('tasks.create')}}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-500 no-underline">Add Task</a>
                <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-500">Generate Report</button>
            </div>
        </div>


        <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <h3 class="text-gray-700 font-bold">Users</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{$totalUsers}}</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <h3 class="text-gray-700 font-bold">Tasks</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">{{$totalTasks}}</p>
            </div>
            <!-- Card 2 -->
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <h3 class="text-gray-700 font-bold">Open Tasks</h3>
                <p class="text-3xl font-bold text-red-600 mt-2">{{$totalOpenedTasks}}</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <h3 class="text-gray-700 font-bold">Pending Tasks</h3>
                <p class="text-3xl font-bold text-yellow-600 mt-2">{{$totalPandingTasks}}</p>
            </div>

            <!-- Card 4 -->
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <h3 class="text-gray-700 font-bold">Completed Tasks</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">{{$totalCompletedTasks}}</p>
            </div>
        </section>

        <section class="mt-6">
            <h3 class="text-xl font-bold text-gray-700">Recent Activities</h3>
            <div class="bg-white mt-4 p-4 rounded-lg shadow-lg">
                <table class="w-full border-collapse">
                    <thead>
                    <tr class="text-left border-b">
                        <th class="p-2">#</th>
                        <th class="p-2">Activity</th>
                        <th class="p-2">Time</th>
                        <th class="p-2">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="border-b">
                        <td class="p-2">1</td>
                        <td class="p-2">User registration</td>
                        <td class="p-2">2 hours ago</td>
                        <td class="p-2 text-green-600">Completed</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-2">2</td>
                        <td class="p-2">Payment processed</td>
                        <td class="p-2">5 hours ago</td>
                        <td class="p-2 text-green-600">Completed</td>
                    </tr>
                    <tr>
                        <td class="p-2">3</td>
                        <td class="p-2">Order shipped</td>
                        <td class="p-2">1 day ago</td>
                        <td class="p-2 text-yellow-600">Pending</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
</body>
</html>
