<?php

namespace App\Livewire;

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskSearch extends Component
{
    public $search = '';

    protected $queryString = ['search'];

    public function render()
    {
        return view('livewire.task-search', [
            'tasks' => Task::where('name', 'like', '%' . $this->search . '%')
                ->where('assigned_for', Auth::id())
                ->get()
        ]);
    }
}
