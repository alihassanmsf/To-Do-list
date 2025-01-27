<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::all()->count();
        $totalTasks = Task::all()->count();
        $totalPandingTasks = Task::where('status', 'pending')->count();
        $totalCompletedTasks = Task::where('status', 'completed')->count();
        $totalOpenedTasks = Task::where('status', 'open')->count();


        return view('admin.index',['totalUsers'=>$totalUsers,'totalTasks'=>$totalTasks,
            'totalPandingTasks'=>$totalPandingTasks,'totalCompletedTasks'=>$totalCompletedTasks,
            'totalOpenedTasks'=>$totalOpenedTasks]);
    }
}
