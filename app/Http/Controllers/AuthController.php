<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function logout(Request $request){
        Auth::logout($request);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login')->with('success','Anda berhasil keluar');
    }

    public function change_password_store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'p1' => 'required|min:8',
            'p2' => 'same:p1',
            ], [
                'p1.required' => 'Password harus diisi',
                'p1.min' => 'Password minimal 8 karakter',
                'p2.same' => 'Kata sandi konfirmasi harus sama dengan kata sandi baru', 
            ]);
        
        if ($validator->fails()) {
            Alert::error($validator->errors()->all()[0]);
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Gagal mengubah password');
        }

        // Validasi
        $validatedData = $validator->validated();
        $validatedData['p1'] = Hash::make($validatedData['p1']);

        // dd($validatedData);
        User::where('email', auth()->user()->email)->update(['password' => $validatedData['p1']]);
        
        Alert::success('Password Changed','Password Berhasil Diubah');

        if(auth()->user()->type_id == 1 || auth()->user()->type_id == 2)
        {
            return redirect()->route('user.index');
        }
        elseif(auth()->user()->type_id == 3)
        {
            return redirect()->back()->with('success','Password Berhasil Diubah');
        }


    }

}
