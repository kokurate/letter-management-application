<?php

namespace App\Http\Livewire;

use App\Models\Surat;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class PegawaiUploadForm extends Component
{
    use WithFileUploads;

    public $tipe_surat, $no_surat, $perihal, $tanggal, $alamat_pengirim, $alamat_tujuan, $file;

    public function render()
    {
        return view('livewire.pegawai-upload-form');
    }

    public function PegawaiUpload()
    {
        
        $this->validate([
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


        $path = "surat/";
        $file = $this->file;
        $filename = $file->getClientOriginalName();
        $new_filename = auth()->user()->username.'_'.time().'_'.$filename;
        
        // $upload = Storage::disk('public')->put($path.$new_filename, (string) file_get_contents($file));
        $upload = $file->storeAs($path, $new_filename, 'public');



        if($upload){
            $surat = new Surat();
            $surat->status_id = 1;
            $surat->user_id = auth()->user()->id;
            $surat->tipe_surat = $this->tipe_surat;
            $surat->no_surat = $this->no_surat;
            $surat->perihal = $this->perihal;
            $surat->tanggal = $this->tanggal;
            $surat->alamat_pengirim = $this->alamat_pengirim;
            $surat->alamat_tujuan = $this->alamat_tujuan;
            $surat->file = $new_filename;
            $saved = $surat->save();
            
    
                if($saved){
                    session()->flash('success', 'User baru telah berhasil ditambahkan');
                    $this->dispatchBrowserEvent('success',['message' => 'User baru telah berhasil ditambahkan.']);
                    $this->tipe_surat = null;
                    $this->no_surat = null;
                    $this->perihal = null;
                    $this->tanggal = null;
                    $this->alamat_pengirim = null;
                    $this->alamat_tujuan = null;
                    $this->file = null;
                }else{
                    $this->dispatchBrowserEvent('error',['message' => 'Ada yang salah saat upload surat']);
                }
            }        

        else{
            $this->dispatchBrowserEvent('error',['message' => 'Ada yang salah saat upload surat']);
        }

    

        // $saved =$surat->save();

        // if($saved){
        //  

        // }else{
        //     $this->dispatchBrowserEvent('error',['Something went wrong']);
        // }


    }


    
}
