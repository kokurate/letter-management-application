<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{

    public function kadis_surat_masuk()
    {
        $token = Str::random(30);
        Session::put('surat_token', $token);

        // Pass the token to the view
        return view('user.surat-masuk')->with('token', $token);
    }

    public function kadis_surat_masuk_detail(Request $request, $detail)
    {

        $token = $request->query('token');
        $storedToken = Session::get('surat_token');

        if (!$token || !$storedToken || $token !== $storedToken ) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.surat-masuk-detail',[
            'detail' => Surat::with('user')->find($detail),
        ]);

    }

    public function kadis_surat_masuk_store(Request $request, $detail)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:2024|mimes:pdf',
        ],[
            'file.required' => ':attribute tidak boleh kosong',
            'file.file' => ':attribute tidak valid',
            'file.mimes' => ':attribute tidak valid',
            'file.max' => ':attribute maksimal 2mb',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        // Cek File Lama Kalo Ada Hapus
        if($request->hasFile('file'))
        {
            $surat = Surat::find($detail);
            $path = 'storage/surat/';
            $surat_file = $surat->getAttributes()['file'];
            $file_full_path = public_path($path . $surat_file);
            
            
            // dd($surat_file, $file_full_path, File::exists($file_full_path));
            
            if ($surat_file != null && File::exists($file_full_path)) {
                File::delete($file_full_path);
            }
            
        }

        // Update file baru yang so ttd
        $surat = Surat::find($detail);

        $path = "surat/";
        $file = $request->file;
        $filename = $file->getClientOriginalName();
        $new_filename = $surat->user->username.'_'.time().'_ttd_'.$filename;
        
        // $upload = Storage::disk('public')->put($path.$new_filename, (string) file_get_contents($file));
        $upload = $file->storeAs($path, $new_filename, 'public');

        if($upload)
        {
            $surat->status_id = 2;
            $surat->file = $new_filename;
            $saved = $surat->save();

            if($saved){
                return redirect()->route('user.surat-masuk')->withToastSuccess('Surat Berhasil Diproses');
            }else{
                return back()->with('toast_error', 'Error');
            }
        }
        else
        {
            return back()->with('toast_error', 'Error');
        }

    }

  

}
