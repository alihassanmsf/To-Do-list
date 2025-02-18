<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskSearch extends Component
{
    public $search;
    public function render()
    {
        $tasks  = Task::where([
            ['name', 'like', '%' . $this->search . '%'],
            ['assigned_for',Auth::id()]])->get();
        return view('livewire.task-search', compact('tasks'));
    }
}
