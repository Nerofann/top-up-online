<?php

namespace App\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $filename;
    public $title;

    public function showModal()
    {
    }

    
    public function render()
    {
        return view('livewire.modal');
    }
}
