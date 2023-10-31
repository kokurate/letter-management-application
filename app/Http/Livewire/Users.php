<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    public $name, $username, $email, $type_id, $password;
    public $selected_user_id;
    public $updateUserMode =  false;

    protected $listeners = [
        'resetModalForm',
        'deleteUserAction',
    ];

    public function resetModalForm(){
        $this->resetErrorBag();
        $this->name = null;
        $this->username = null;
        $this->email = null;
        $this->type_id = null;
        $this->password = null;
        $this->updateUserMode = false;
    }


    public function addUser()
    {
        $this->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'type_id' => 'required',
            'password' => 'required|min:6',
        ],[
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Nama harus diisi',
            'username.unique' => 'Username sudah terdaftar',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah terdaftar',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Minimal password 6 karakter',
            'type_id.required' => 'Tipe User harus diisi',
        ]);

        $user = new User();
        $user->name = $this->name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->type_id = $this->type_id;
        $user->password = Hash::make($this->password);
        $saved = $user->save();

        if($saved){
            session()->flash('success','User baru telah berhasil ditambahkan.');
            $this->dispatchBrowserEvent('success',['message' => 'User baru telah berhasil ditambahkan.']);
            $this->dispatchBrowserEvent('hideUserModal');
            $this->name = null;
            $this->username = null;
            $this->email = null;
            $this->type_id = null;
            $this->password = null;

        }else{
            $this->dispatchBrowserEvent('error',['Something went wrong']);
        }
    }


    public function editUser($id){
        $user = User::findOrFail($id);
        $this->selected_user_id = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->type_id = $user->type_id;
        $this->updateUserMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUserModal');
    }

    public function updateUser(){
        if($this->selected_user_id){
            $this->validate([
                'name' => 'required',
                'username' => 'required|unique:users,username,'.$this->selected_user_id,
                'email' => 'required|email|unique:users,email,'.$this->selected_user_id,
                'type_id' => 'required',
                'password' => '',
            ],[
                'name.required' => 'Nama harus diisi',
                'username.required' => 'Nama harus diisi',
                'username.unique' => 'Username sudah terdaftar',
                'email.required' => 'Email harus diisi',
                'email.unique' => 'Email sudah terdaftar',
                'email.email' => 'Format email tidak valid',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Minimal password 6 karakter',
                'type_id.required' => 'Tipe User harus diisi',
            ]);

            $user = User::findOrFail($this->selected_user_id);
            $user->name = $this->name; 
            $user->username = $this->username; 
            $user->email = $this->email; 
            $user->type_id = $this->type_id; 
    

            if($this->password != null){
                $user->password = Hash::make($this->password);
            }
            
            $updated = $user->save();

            if($updated){
                $this->dispatchBrowserEvent('success',['message' => 'User telah berhasil diperbarui']);
                $this->dispatchBrowserEvent('hideUserModal');
                $this->name = null;
                $this->username = null;
                $this->email = null;
                $this->type_id = null;
                $this->updateUserMode = false;
            }else{
                $this->dispatchBrowserEvent('error',['message' => 'Something went wrong']);
            }
        }
    }


    public function render()
    {
        return view('livewire.users',[
            'users' => User::where('id', '!=', auth()->id())
                        ->orderBy('updated_at', 'desc') // terbaru
                        ->get(),
        ]);
    }
}
