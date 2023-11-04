<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function upload_surat_store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'tipe_surat' => 'required|in:Surat Masuk,Surat Keluar',
            'no_surat' => 'required|max:255',
            'perihal' => 'required|max:255',
            'tanggal' => 'required|date',
            'alamat_pengirim' => 'required|max:255',
            'alamat_tujuan' => 'required|max:255',
            'file' => 'required|file|max:2024|mimes:pdf',
        ],[
            'tipe_surat.required' => ':attribute tidak boleh kosong',
            'no_surat.required' => ':attribute tidak boleh kosong',
            'perihal.required' => ':attribute tidak boleh kosong',
            'tanggal.required' => ':attribute tidak boleh kosong',
            'alamat_pengirim.required' => ':attribute tidak boleh kosong',
            'alamat_tujuan.required' => ':attribute tidak boleh kosong',
            'file.required' => ':attribute tidak boleh kosong',
            'file.file' => ':attribute tidak valid',
            'file.mimes' => ':attribute tidak valid',
            'file.max' => ':attribute maksimal 2mb',
        ]);


        if ($validator->fails()) {
            return back()->with('toast_error', $validator->errors()->all()[0])
                        ->withInput()
                        ->withErrors($validator);
            
        }

        $path = "surat/";
        $file = $request->file;
        $filename = $file->getClientOriginalName();
        $new_filename = auth()->user()->username.'_'.time().'_'.$filename;

        // $upload = Storage::disk('public')->put($path.$new_filename, (string) file_get_contents($file));
        $upload = $file->storeAs($path, $new_filename, 'public');



        if($upload){
            $surat = new Surat();
            $surat->status_id = 4;
            $surat->user_id = auth()->user()->id;
            $surat->tipe_surat = $request->tipe_surat;
            $surat->no_surat = $request->no_surat;
            $surat->perihal = $request->perihal;
            $surat->tanggal = $request->tanggal;
            $surat->alamat_pengirim = $request->alamat_pengirim;
            $surat->alamat_tujuan = $request->alamat_tujuan;
            $surat->file = $new_filename;
            $saved = $surat->save();


                if($saved){
                    // Alert::success('Success', 'Surat Berhasil Diedit');
                    return redirect()->route('admin.riwayat-upload-surat')->withToastSuccess('Surat Berhasil Ditambahkan');
             
                }else{
                     return back()->with('toast_error', 'Error');
                }
            }        

        else{
             return back()->with('toast_error', 'Error');
        }

        
    }

    public function delete_surat($id)
    {
        $surat = Surat::findOrFail($id);
        $path = "surat/";
        $file = $surat->getRawOriginal('file');

        if($file != null  && Storage::disk('public')->exists($path.$file)){
            // delete 
            Storage::disk('public')->delete($path.$file);
        }

        $delete_surat = $surat->delete();
        

        if($delete_surat){
           return redirect()->back()->withToastSuccess('Surat Berhasil Dihapus');
        }else{
           return back()->with('toast_error', 'Error');
        }
    }

    
    public function upload_surat_edit($id)
    {
        return view('user.admin.edit-surat',[
            'h1' => 'Upload Surat',
            'detail' => Surat::with('user')->find($id),
            'pageTitle' => 'Admin Surat Detail',
        ]);
    }

    public function surat_masuk_edit($id)
    {
        return view('user.admin.edit-surat',[
            'h1' => 'Edit Surat',
            'detail' => Surat::with('user')->find($id),
            'pageTitle' => 'Admin Surat Masuk Detail',
        ]);
    }

    public function surat_keluar_edit($id)
    {
        return view('user.admin.edit-surat',[
            'h1' => 'Edit Surat',
            'detail' => Surat::with('user')->find($id),
            'pageTitle' => 'Admin Surat Keluar Detail',
        ]);
    }

    public function check_surat_edit($id)
    {
        return view('user.admin.edit-surat',[
            'h1' => 'Lengkapi Surat',
            'detail' => Surat::with('user')->find($id),
            'pageTitle' => 'Admin Surat Keluar Detail',
        ]);
    }


    public function edit_surat_store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tipe_surat' => 'required|in:Surat Masuk,Surat Keluar',
            'no_surat' => 'required|max:255',
            'perihal' => 'required|max:255',
            'tanggal' => 'required|date',
            'alamat_pengirim' => 'required|max:255',
            'alamat_tujuan' => 'required|max:255',
            'file' => 'file|max:2024|mimes:pdf',
        ],[
            'tipe_surat.required' => ':attribute tidak boleh kosong',
            'no_surat.required' => ':attribute tidak boleh kosong',
            'perihal.required' => ':attribute tidak boleh kosong',
            'tanggal.required' => ':attribute tidak boleh kosong',
            'alamat_pengirim.required' => ':attribute tidak boleh kosong',
            'alamat_tujuan.required' => ':attribute tidak boleh kosong',
            'file.file' => ':attribute tidak valid',
            'file.mimes' => ':attribute tidak valid',
            'file.max' => ':attribute maksimal 2mb',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->errors()->all()[0])
                        ->withInput()
                        ->withErrors($validator);
            
        }


        // Cek File Lama Kalo Ada Hapus
        if($request->hasFile('file'))
        {
            $surat = Surat::findOrFail($id);
            $path = 'storage/surat/';
            $surat_file = $surat->getAttributes()['file'];
            $file_full_path = public_path($path . $surat_file);
            
            
            if ($surat_file != null && File::exists($file_full_path)) {
                File::delete($file_full_path);
            }
            
            $path = "surat/";
            $file = $request->file;
            $filename = $file->getClientOriginalName();
            $new_filename = $surat->user->username.'_'.time().'_'.$filename;
            
            $file->storeAs($path, $new_filename, 'public');
            
            $surat->file = $new_filename;


            // Update file baru yang so ttd
            $surat = Surat::findOrFail($id);
            $surat->status_id = 4;
            $surat->user_id = auth()->user()->id;
            $surat->tipe_surat = $request->tipe_surat;
            $surat->no_surat = $request->no_surat;
            $surat->perihal = $request->perihal;
            $surat->tanggal = $request->tanggal;
            $surat->alamat_pengirim = $request->alamat_pengirim;
            $surat->alamat_tujuan = $request->alamat_tujuan;
            $surat->file = $new_filename;
            $saved = $surat->save();


            if($saved){
                return redirect()->back()->withToastSuccess('Surat Berhasil Diedit');
            }else{
                return back()->with('toast_error', 'Error');
            }
        }
        else
        {
            // Update file baru yang so ttd
            $surat = Surat::findOrFail($id);
            $surat->status_id = 4;
            $surat->user_id = auth()->user()->id;
            $surat->tipe_surat = $request->tipe_surat;
            $surat->no_surat = $request->no_surat;
            $surat->perihal = $request->perihal;
            $surat->tanggal = $request->tanggal;
            $surat->alamat_pengirim = $request->alamat_pengirim;
            $surat->alamat_tujuan = $request->alamat_tujuan;
            $saved = $surat->save();
     
            if($saved){
                return redirect()->back()->withToastSuccess('Surat Berhasil Diedit');
            }else{
                return back()->with('toast_error', 'Error');
            }
        }



    }

    
}
