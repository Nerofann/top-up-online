<?php

namespace App\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;

class VendorAutoSlug extends Component
{
    public $name;
    public $slug;
    public function generate() {
        $this->slug = Str::slug($this->name);
    }

    public function render()
    {
        $this->generate();
        return view('livewire.vendor-auto-slug');
    }
}
