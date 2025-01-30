<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function usersList(Request $request)
    {
        $users = User::all();
        return view('admin.users.users-list',['users'=>$users]);
    }

    public function createUser(Request $request)
    {
        $roles = Role::all();
        return view('admin.create-user',['roles'=>$roles]);
    }

    public function storeUser(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->passeord),
            'role_id' => $request->role_id

        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }
}
