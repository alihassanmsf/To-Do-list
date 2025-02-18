<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class ManageUsers extends Component
{
    // UI state
    public $isModalOpen = false;
    public $editMode = false;

    // User fields
    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role_id;

    // Lists
    public $roles;
    public $users;

    // Called on every request
    public function render()
    {
        // Fetch users and roles for display
        $this->users = User::with('role')->get();
        $this->roles = Role::all();

        return view('livewire.manage-users');
    }

    // Show the modal for creating a new user
    public function createUser()
    {
        $this->resetInputs();
        $this->editMode = false;
        $this->openModal();

    }

    // Show the modal for editing an existing user
    public function editUser($id)
    {
        $user = User::findOrFail($id);

        // Populate fields
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email  = $user->email;
        $this->role_id = $user->role_id;

        // We won't load password for editing (security best practice)
        $this->password = null;
        $this->password_confirmation = null;

        $this->editMode = true;
        $this->openModal();
    }




    // Create or update the user
    public function saveUser()
    {
        // Validate fields
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email'
                . ($this->editMode ? (',' . $this->userId . ',id') : ''),
            'role_id' => 'required|exists:roles,id',
        ];

        // Only validate password in create mode or if provided in edit mode
        if (!$this->editMode || $this->password) {
            $rules['password'] = 'required|string|confirmed|min:6';
        }

        $validatedData = $this->validate($rules);

        // If password is present, encrypt it
        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($this->password);
            unset($validatedData['password_confirmation']);
        }

        if ($this->editMode) {
            // Update existing user
            $user = User::findOrFail($this->userId);
            $user->update($validatedData);
            session()->flash('message', 'User updated successfully!');
        } else {
            // Create new user
            User::create($validatedData);
            session()->flash('message', 'User created successfully!');
        }

        $this->closeModal();
        $this->resetInputs();
    }
    // Helpers
    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetInputs()
    {
        $this->userId = null;
        $this->name   = null;
        $this->email  = null;
        $this->password = null;
        $this->password_confirmation = null;
        $this->role_id = null;
    }
}
