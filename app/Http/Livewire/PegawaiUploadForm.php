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

    public $perihal, $tanggal, $file;

    public function render()
    {
        return view('livewire.pegawai-upload-form');
    }

    public function PegawaiUpload()
    {
        
        $this->validate([
            'perihal' => 'required|max:255',
            'tanggal' => 'required|date',
            'file' => 'required|file|max:2024|mimes:pdf',
        ],[
            'perihal.required' => ':attribute tidak boleh kosong',
            'tanggal.required' => ':attribute tidak boleh kosong',
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
            $surat->perihal = $this->perihal;
            $surat->tanggal = $this->tanggal;
            $surat->file = $new_filename;
            $saved = $surat->save();
            
    
                if($saved){

                    session()->flash('success', 'Surat baru telah berhasil ditambahkan');
                    $this->dispatchBrowserEvent('success',['message' => 'Surat baru telah berhasil ditambahkan.']);
                    $this->perihal = null;
                    $this->tanggal = null;
                    $this->file = null;
                }else{
                    $this->dispatchBrowserEvent('error',['message' => 'Ada yang salah saat upload surat']);
                }
            }        

        else{
            $this->dispatchBrowserEvent('error',['message' => 'Ada yang salah saat upload surat']);
        }

    }


    
}
