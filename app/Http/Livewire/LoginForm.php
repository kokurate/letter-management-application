<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Request;

class LoginForm extends Component
{
    public $login_id, $password;

    public function LoginHandler()
    {
        // validasi 
            $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            if($fieldType == 'email'){
                $this->validate([
                    'login_id' => 'required|email|exists:users,email',
                    'password' => 'required'
                ],[
                    'login_id.required' => 'Masukkan email atau username anda',
                    'login_id.email' => 'Format email tidak benar',
                    'login_id.exists' => 'Email tidak terdaftar',
                    'password.required' => 'Masukkan password anda',
                ]);
            }else{
                $this->validate([
                    'login_id' => 'required|exists:users,username',
                    'password' => 'required'
                ],[
                    'login_id.required' => 'Masukkan email atau username anda',
                    'login_id.exists' => 'Username tidak terdaftar',
                    'password.required' => 'Masukkan password anda',
                ]);
            }

        
        $creds = array($fieldType => $this->login_id, 'password' => $this->password);

        if(Auth::attempt($creds)){
            $user = User::where($fieldType, $this->login_id)->first();
            // cek level
                if($user->type_id == '1' || $user->type_id == '2'){
                    Request()->session()->regenerate();
                    return redirect()->intended('user/dashboard');
                }
                elseif($user->type_id == '3'){
                    Request()->session()->regenerate();
                    return redirect()->intended('pegawai');
                }

            
        }else{
            session()->flash('fail','Email/username atau password salah');
        }


    }

    public function render()
    {
        return view('livewire.login-form');
    }
}
