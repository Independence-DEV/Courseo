<?php

namespace App\Http\Livewire;

use App\Models\CustomPage;
use Livewire\Component;

class ActiveCustompage extends Component
{
    public CustomPage $custompage;

    public function activate()
    {
        $this->custompage->active = 1;
        $this->custompage->update();
    }

    public function deactivate()
    {
        $this->custompage->active = 0;
        $this->custompage->update();
    }

    public function render()
    {
        return view('livewire.active-custompage');
    }
}
