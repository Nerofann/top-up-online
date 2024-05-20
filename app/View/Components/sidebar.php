<?php

namespace App\View\Components;

use App\Services\AppGlobals as ServicesSidebar;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class sidebar extends Component
{
    public $sidebarShow = [];
    /**
     * Create a new component instance.
     */
    public function __construct(public ServicesSidebar $sidebar)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $isLoggedIn = Auth::check();
        foreach($this->sidebar->getSidebar() as $side) {
            if($side['auth'] === false) {
                $this->sidebarShow[] = $side;
                continue;
            }

            if($side['auth'] === true && $isLoggedIn) {
                $this->sidebarShow[] = $side;
            }
        }
        return view('components.sidebar');
    }
}
