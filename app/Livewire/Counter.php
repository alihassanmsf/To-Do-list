<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 0;

    public function increment()
    {
        \Log::info('Increment clicked');
        $this->count++;
    }


    public function render()
    {
        return view('livewire.counter');
    }
}
