<?php

namespace App\Http\Livewire\Admin\Profile;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfile extends Component
{
    use WithFileUploads;

    public $image;

    public function updatedImage()
    {
        $path = $this->image->store('/', 'avatars');

        if (auth()->user()->avatar) {
            Storage::disk('avatars')->delete(auth()->user()->avatar);
        }
        auth()->user()->update(['avatar' => $path]);

        $this->dispatchBrowserEvent('updated', ['message' => 'Profile change successfully!']);
    }

    public function render()
    {
        return view('livewire.admin.profile.update-profile');
    }
}
