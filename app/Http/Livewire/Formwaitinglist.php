<?php

namespace App\Http\Livewire;

use App\Mail\WaitingListMail;
use App\Models\WaitingList;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Formwaitinglist extends Component
{
    public $email;
    public $success;
    protected $rules = [
        'email' => 'required|email',
    ];

    public function formSubmit()
    {
        $email = $this->validate();
        $this->success = 'NOK';
        if(is_null(WaitingList::where('email', $this->email)->first())){
            WaitingList::create(['email' => $this->email, 'lang' => app()->getLocale()]);
            /*Mail::to($this->email)
                ->send(new WaitingListMail());*/
            $this->success = 'OK';
        }
        $this->clearFields();
    }

    private function clearFields()
    {
        $this->email = '';
    }

    public function render()
    {
        return view('livewire.formwaitinglist');
    }
}
