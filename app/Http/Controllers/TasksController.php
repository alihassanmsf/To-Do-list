<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
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
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all(); // Fetch all users for the "Assigned For" dropdown
        return view('tasks.form', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'priority' => 'required|string|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed',
            'assigned_for' => 'nullable|exists:users,id',
        ]);

        $validated['created_by'] = auth()->id(); // Set the creator
        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
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

            return redirect()->back()->with('success', 'Task marked as completed.');
        }

        return redirect()->back()->with('error', 'Task is already completed.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $users = User::all(); // Fetch all users for the "Assigned For" dropdown
        return view('tasks.form', compact('task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'priority' => 'required|string|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed',
            'assigned_for' => 'nullable|exists:users,id',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
