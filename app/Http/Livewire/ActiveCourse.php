<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Livewire\Component;

class ActiveCourse extends Component
{
    public Course $course;

    public function activate()
    {
        $this->course->active = 1;
        $this->course->update();
    }

    public function deactivate()
    {
        $this->course->active = 0;
        $this->course->update();
    }

    public function render()
    {
        return view('livewire.active-course');
    }
}
