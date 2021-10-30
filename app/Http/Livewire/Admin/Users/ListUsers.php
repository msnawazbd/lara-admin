<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class ListUsers extends AdminComponent
{
    public $state = [];
    public $user;
    public $edit_mode = false;
    public $user_id;
    public $search_keywords = null;
    public $photo;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';

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
        $this->reset();
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

        if ($this->photo) {
            Storage::disk('avatars')->delete($this->user->avatar);
            $validate_data['avatar'] = $this->photo->store('/', 'avatars');
        } else {
            $validate_data['avatar'] = '';
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

    public function change_role(User $user, $role)
    {
        Validator::make(['role' => $role], [
            // 'role' => 'required|in:admin,user'
            'role' => [
                'required',
                Rule::in(User::ROLE_ADMIN, User::ROLE_USER)
            ]
        ])->validate();

        $user->update(['role' => $role]);
        $this->dispatchBrowserEvent('updated', ['message' => "User role change to {$role} successfully!"]);

        return redirect()->back();
    }

    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function render()
    {
        $users = User::where('id', '!=', Auth::user()->id)
            ->where(function ($query){
                $query->where('name', 'like', '%' . $this->search_keywords . '%')
                    ->orWhere('email', 'like', '%' . $this->search_keywords . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(5);

        return view('livewire.admin.users.list-users', [
            'users' => $users
        ]);
    }
}
