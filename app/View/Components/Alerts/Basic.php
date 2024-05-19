<?php

namespace App\View\Components\Alerts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Basic extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $type = "",
        public $header = "Berhasil",
        public $message = [],
        public $active  = true
    )
    {
        switch(true) {
            case (!empty(Session::get('success'))): 
                $this->type     = "success";
                $this->header   = "Berhasil";
                break;

            case (!empty(Session::get('danger'))): 
                $this->type     = "danger";
                $this->header   = "Error";
                break;

            case (!empty(Session::get('warning'))): 
                $this->type     = "warning";
                $this->header   = "Gagal";
                break;

            case (!empty(Session::get('warning'))): 
                $this->type     = "warning";
                $this->header   = "Gagal";
                break;

            default: $this->active = false; break;
        }

        $this->message = Session::get( $this->type ) ?? [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alerts.basic');
    }
}
