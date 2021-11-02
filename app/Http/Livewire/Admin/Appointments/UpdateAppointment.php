<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UpdateAppointment extends Component
{
    public $state = [];

    public $appointment;

    public function mount(Appointment $appointment)
    {
        $this->state = $appointment->toArray();
        $this->appointment = $appointment;
    }

    public function update()
    {
        $validate_data = Validator::make($this->state, [
            'client_id' => 'required|numeric',
            'date' => 'required|date',
            'time' => 'required',
            'status' => 'nullable',
            'note' => 'required|string',
        ],[
            'client_id.required' => 'The client field is required.'
        ])
            ->validate();

        $this->appointment->update($this->state);

        $this->dispatchBrowserEvent('alert', ['message' => 'Appointment created successfully']);

        return redirect()->route('admin.appointments');
    }

    public function render()
    {
        $clients = Client::all();
        return view('livewire.admin.appointments.update-appointment', [
            'clients' => $clients]);
    }
}
