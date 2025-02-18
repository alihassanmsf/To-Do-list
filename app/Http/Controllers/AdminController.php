<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::all()->count();
        $totalTasks = Task::all()->count();
        $totalPandingTasks = Task::where('status', 'pending')->count();
        $totalCompletedTasks = Task::where('status', 'completed')->count();
        $totalInProgressTasks = Task::where('status', 'in_progress')->count();
        $activities = Activity::with('user', 'task')->latest()->take(10)->get();


        return view('admin.index', ['totalUsers' => $totalUsers, 'totalTasks' => $totalTasks,
            'totalPandingTasks' => $totalPandingTasks, 'totalCompletedTasks' => $totalCompletedTasks,
            'totalInProgressTasks' => $totalInProgressTasks, 'activities' => $activities]);
    }

    public function usersList(Request $request)
    {
        $users = User::all();
        return view('admin.users.users-list', ['users' => $users]);
    }
}
