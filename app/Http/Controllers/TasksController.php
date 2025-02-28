<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $tasks = Task::where('assigned_for', Auth::id())->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $this->authorize('create', Task::class);
            $users = User::all(); // Fetch all users for the "Assigned For" dropdown
            return view('tasks.form', compact('users'));
        }
        catch (AuthorizationException $e){

            return redirect()->route('tasks.index')->with('message', 'You are not allowed to create tasks.');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->authorize('create', Task::class);
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'due_date' => 'required|date',
                'priority' => 'required|string|in:low,medium,high',
                'status' => 'required|in:pending,in_progress,completed',
                'assigned_for' => 'nullable|exists:users,id',
            ]);

            $validated['created_by'] = auth()->id(); // Set the creator
            $task = Task::create($validated);

            if (auth()->user()->role->name === 'Admin') {
                Activity::create([
                    'user_id' => Auth::id(),
                    'action' => 'Admin  Create a Task',
                    'target_type' => 'Task',
                    'target_id' => $task->id,
                ]);
            }


            return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
        }
        catch (AuthorizationException $e){
            return redirect()->route('tasks.index')->with('message', 'You are not allowed to create tasks.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function completeTask(Task $task)
    {
        // Check if the task is not already completed
        if ($task->status !== 'completed') {
            $task->update([
                'status' => 'completed',
                'completed_by' => Auth::id(), // Set the authenticated user's ID
            ]);

            Activity::create([
                'user_id' => Auth::id(),
                'action' => 'Update a Task Status To Complete',
                'target_type' => 'Task',
                'target_id' => $task->id,
            ]);

            return redirect()->back()->with('success', 'Task marked as completed.');
        }

        return redirect()->back()->with('error', 'Task is already completed.');
    }
    public function triggerToInProgress(Task $task)
    {
        // Check if the task is not already in progress
        if ($task->status !== 'in_progress') {
            $task->update([
                'status' => 'in_progress',
                'completed_by' => Auth::id(), // Set the authenticated user's ID
            ]);

            Activity::create([
                'user_id' => Auth::id(),
                'action' => 'Update a Task Status To In Progress',
                'target_type' => 'Task',
                'target_id' => $task->id,
            ]);

            return redirect()->back()->with('success', 'Task marked as in progress.');
        }

        return redirect()->back()->with('error', 'Task is already in progress.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        try {
            $this->authorize('update', $task);
            $users = User::all(); // Fetch all users for the "Assigned For" dropdown
            return view('tasks.form', compact('task', 'users'));
        }
        catch (AuthorizationException $e){
            return redirect()->route('tasks.index')->with('message', 'You are not allowed to edit tasks.');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        try {
            $this->authorize('update', $task);
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'due_date' => 'required|date',
                'priority' => 'required|string|in:low,medium,high',
                'status' => 'required|in:pending,in_progress,completed',
                'assigned_for' => 'nullable|exists:users,id',
            ]);

            $task->update($validated);

            Activity::create([
                'user_id' => Auth::id(),
                'action' => 'Update a Task',
                'target_type' => 'Task',
                'target_id' => $task->id,
            ]);

            return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
        }
        catch (AuthorizationException $e){
            return redirect()->route('tasks.index')->with('message', 'You are not allowed to update tasks.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $this->authorize('delete', $task);
            $task->delete();
            return redirect()->route('admin.tasks.list')->with('success', 'Task deleted successfully!');
        }
        catch (AuthorizationException $e){
            return redirect()->route('tasks.index')->with('message', 'You are not allowed to delete tasks.');
        }
    }
}
