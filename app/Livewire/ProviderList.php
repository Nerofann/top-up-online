<?php

namespace App\Livewire;

use App\Models\Provider;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ProviderList extends Component
{
    public $offset  = 0;
    public $limit   = 9;
    public $counter = 10;
    public $allProviders = [];

    public function render()
    {
        if(empty($allProviders)) {
            $this->getProvider();
        }

        return view('livewire.provider-list');
    }

    public function setOffsetLimit() {
        $this->offset += $this->counter;
        $this->limit += $this->counter;
    }

    public function getProvider() {
        foreach(Provider::with('kategory')->get() as $pro) {
            $this->allProviders[] = [
                'pv_slug'   => $pro->pv_slug,
                'created_at' => date("Y-m-d H:i:s", strtotime($pro->created_at)),
                'kategory' => $pro->kategory->kt_name,
                'pv_code' => $pro->pv_code,
                'pv_name' => $pro->pv_name,
                'pv_image' => Storage::url($pro->pv_image)
            ];
        }
    }
}
