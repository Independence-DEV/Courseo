<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class ActivePost extends Component
{
    public Post $post;

    public function activate()
    {
        $this->post->active = 1;
        $this->post->update();
    }

    public function deactivate()
    {
        $this->post->active = 0;
        $this->post->update();
    }

    public function render()
    {
        return view('livewire.active-post');
    }
}
