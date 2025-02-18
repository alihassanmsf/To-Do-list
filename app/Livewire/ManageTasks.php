<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class ManageTasks extends Component
{

    public $isModalOpen = false;
    public $editMode = false;

    public $taskId;
    public $name;
    public $description;
    public $due_date;
    public $priority;
    public $status;
    public $assigned_for;

    public $tasks ;
    public $users ;



    public function render()
    {
        if (auth()->user()->role->name === 'Admin') {
            $this->tasks = Task::with(['creator', 'assignedUser'])->get();
            $this->users = User::all();
        }
        elseif (auth()->user()->role->name === 'Manager') {

            $this->tasks = Task::with(['creator', 'assignedUser'])->where('created_by',Auth::id())->get();
            $this->users = User::all();
        }
        return view('livewire.manage-tasks');
    }

    public function createTask()
    {
        $this->resetInputs();
        $this->openModal();
        $this->editMode = false;
    }

    public function editTask($id)
    {
        $task = Task::findOrFail($id);

        $this->taskId = $id;
        $this->name = $task->name;
        $this->description = $task->description;
        $this->priority = $task->priority;
        $this->status = $task->status;
        $this->assigned_for = $task->assigned_for;
        $this->due_date = $task->due_date;

        $this->editMode = true;
        $this->openModal();

    }

    // Create or Update the Task
    public function saveTask()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'priority' => 'required|string|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed',
            'assigned_for' => 'nullable|exists:users,id',
        ]);

        // Ensure values are correctly cast (though validate should handle this)
        $validated['priority'] = (string) $validated['priority'];
        $validated['status'] = (string) $validated['status'];

        if ($this->editMode) {
            $task = Task::findOrFail($this->taskId);
            $task->update($validated);
            // Log the activity
            Activity::create([
                'user_id' => Auth::id(),
                'action' => 'Update a Task',
                'target_type' => 'Task',
                'target_id' => $task->id,
            ]);
            session()->flash('message', 'Task updated successfully.');
        } else {
            $validated['created_by'] = Auth::user()->id;
            $task = Task::create($validated);
            Activity::create([
                'user_id' => Auth::id(),
                'action' => 'Create a Task',
                'target_type' => 'Task',
                'target_id' => $task->id,
            ]);
            session()->flash('message', 'Task created successfully!');
        }

        $this->closeModal();
        $this->resetInputs();
    }

        public function deleteTask($id)
        {
            $task = Task::findOrFail($id);
            $task->delete();
            session()->flash('message', 'Task deleted successfully!');
        }

    //Helpers

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function resetInputs()
    {
        $this->taskId = null;
        $this->name = null;
        $this->description = null;
        $this->due_date = null;
        $this->priority = null;
        $this->status = null;
        $this->assigned_for = null;

    }
}
