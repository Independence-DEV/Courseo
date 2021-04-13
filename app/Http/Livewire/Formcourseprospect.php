<?php

namespace App\Http\Livewire;

use App\Mail\ProspectCourseMail;
use App\Models\Prospect;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Formcourseprospect extends Component
{
    public $email;
    public $name;
    public $course;
    public $success;
    protected $rules = [
        'email' => 'required|email',
        'name' => 'required|max:255',
    ];

    public function formSubmit()
    {
        $this->validate();
        $this->success = 'NOK';

        if(is_null($prospect = Prospect::where('email', $this->email)->first())) {
            $prospect = Prospect::create(['email' => $this->email, 'name' => $this->name, 'account_id' => $this->course->id]);
        }
        $prospect->courses()->sync($this->course);

        $url = '/memberarea/course/'.$this->course->slug.'/payment?prospectEmail='.$prospect->email;

        /*if($this->price == 0) $url = route('account.memberarea.course.payment');
        else $url = 'f';*/

        Mail::to($this->email)
            ->send(new ProspectCourseMail($url, $this->course, $this->name));
        $this->success = 'OK';

        $this->clearFields();
    }

    private function clearFields()
    {
        $this->name = '';
        $this->email = '';
    }

    public function render()
    {
        return view('livewire.formcourseprospect');
    }
}
