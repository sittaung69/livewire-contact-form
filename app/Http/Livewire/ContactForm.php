<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $message;
    public $success;
    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:contacts,email',
        'message' => 'required|min:5'
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function submitForm()
    {
        $this->validate();

        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        $this->reset(['name', 'email', 'message']);
        $this->success = 'Your inquiry has been submitted successfully!';
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
