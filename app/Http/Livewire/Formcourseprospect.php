<?php

namespace App\Http\Livewire;

use App\Mail\ProspectCourseMail;
use App\Mail\ProspectMail;
use App\Mail\WaitingListMail;
use App\Models\Prospect;
use App\Models\WaitingList;
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
        if(is_null(Prospect::where('email', $this->email)->first())){
            Prospect::create(['email' => $this->email, 'name' => $this->email]);
            Mail::to($this->email)
                ->send(new ProspectCourseMail());
            $this->success = 'OK';
        }
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
