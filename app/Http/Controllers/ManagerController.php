<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $totalTasks = Task::where('created_by', Auth::id())->count();
            $totalInProgressTasks = Task::where('created_by', Auth::id())->where('status', 'in_progress')->count();
            $totalPendingTasks = Task::where('created_by', Auth::id())->where('status', 'pending')->count();
            $totalCompletedTasks = Task::where('created_by', Auth::id())->where('status', 'completed')->count();
            $userId = auth()->id(); // Get the currently logged-in user ID
            $tasks = Task::where('created_by', $userId)->pluck('id');

            $activities = Activity::whereIn('target_id', $tasks)->latest()->take(10)->get();;

        }

        return view('manager.index', ['totalTasks' => $totalTasks,
            'totalInProgressTasks' => $totalInProgressTasks
            , 'totalPendingTasks' => $totalPendingTasks
            , 'totalCompletedTasks' => $totalCompletedTasks, 'activities' => $activities]);
    }
}
