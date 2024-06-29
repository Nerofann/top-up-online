<?php

namespace App\View\Components;

use App\Services\AppGlobals;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $sidebarShow = [];
    /**
     * Create a new component instance.
     */
    public function __construct(public AppGlobals $sidebar)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $isLoggedIn = Auth::check();
        $user       = Auth::user();
        $this->sidebarShow = $this->sidebar->getSidebar();

        return view('components.Sidebar');
    }
}
