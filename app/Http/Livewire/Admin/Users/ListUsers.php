<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

class ListUsers extends AdminComponent
{
    public $state = [];
    public $user;
    public $edit_mode = false;
    public $user_id;
    public $search_keywords = null;
    public $photo;

    use WithFileUploads;

    protected $listeners = [
        'confirm_destroy' => 'confirm_destroy'
    ];

    public function create()
    {
        $this->reset();
        $this->edit_mode = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function store()
    {
        $validate_data = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ])->validate();

        /*$validate_data['password'] = bcrypt($validate_data['password']);
        $user = User::create($validate_data);*/

        if ($this->photo) {
            $validate_data['avatar'] = $this->photo->store('/', 'avatars');
        } else {
            $validate_data['avatar'] = '';
        }

        $user = User::create([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
            'password' => bcrypt($this->state['password']),
            'avatar' => $validate_data['avatar']
        ]);

        if ($user->id) {
            $this->dispatchBrowserEvent('hide-form', ['message' => 'User created successfully']);
        }
        return redirect()->back();
    }

    public function edit(User $user)
    {
        $this->edit_mode = true;
        $this->user = $user;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function update()
    {
        $validate_data = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'sometimes|confirmed',
        ])->validate();

        if (!empty($this->state['password'])) {
            $validate_data['password'] = bcrypt($this->state['password']);
        }

        $this->user->update($validate_data);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);

        return redirect()->back();
    }

    public function destroy($user_id)
    {
        $this->user_id = $user_id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function confirm_destroy()
    {
        $data = User::findOrFail($this->user_id);
        $data->delete();

        $this->dispatchBrowserEvent('deleted', ['message' => 'User deleted successfully.']);
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search_keywords . '%')
            ->orWhere('email', 'like', '%' . $this->search_keywords . '%')
            ->latest()->paginate(2);

        return view('livewire.admin.users.list-users', [
            'users' => $users
        ]);
    }
}
