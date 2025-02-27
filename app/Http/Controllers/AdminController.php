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
        $roles = Role::all();
        return view('admin.users.users-list', ['users' => $users, 'roles' => $roles]);
    }

    public function createUser(Request $request)
    {
        $roles = Role::all();
        return view('admin.users.form', ['roles' => $roles]);
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role_id'  => 'required|exists:roles,id',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => $request->role_id,
        ]);

        return redirect()->route('admin.users.list')->with('message', 'User created successfully!');
    }

    public function editUser(User $user)
    {
        $roles = Role::all();
        return view('admin.users.form', compact('user', 'roles'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'role_id' => $request->role_id,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('admin.users.list')->with('message', 'User updated successfully!');
    }

    public function tasksList(Request $request)
    {
        if (auth()->user()->role->name === 'Admin') {
          $tasks = Task::with(['creator', 'assignedUser'])->get();
          $users = User::all();
        }
        elseif (auth()->user()->role->name === 'Manager') {

           $tasks = Task::with(['creator', 'assignedUser'])->where('created_by',Auth::id())->get();
           $users = User::all();
        }

        return view('admin.tasks.tasks-list', compact('tasks', 'users'));
    }

}
