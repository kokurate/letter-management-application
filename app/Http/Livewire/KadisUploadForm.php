<?php

namespace App\Http\Livewire;

use App\Models\Surat;
use Livewire\Component;
use Livewire\WithFileUploads;

class KadisUploadForm extends Component
{
    use WithFileUploads;

    public $perihal, $tanggal, $file;

    protected $listeners = [
        'resetModalForm',
    ];

    public function resetModalForm(){
        $this->resetErrorBag();
        $this->perihal = null;
        $this->tanggal = null;
        $this->file = null;
    }


    public function KadisUpload()
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
            $surat->status_id = 3;
            $surat->user_id = auth()->user()->id;
            $surat->perihal = $this->perihal;
            $surat->tanggal = $this->tanggal;
            $surat->file = $new_filename;
            $saved = $surat->save();
            
    
                if($saved){
                    $this->dispatchBrowserEvent('success',['message' => 'Surat baru telah berhasil ditambahkan.']);
                    $this->dispatchBrowserEvent('hideKadisModal');
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

    public function render()
    {
        return view('livewire.kadis-upload-form',[
            'surat_kadis' => Surat::where('user_id', auth()->user()->id)
                                    ->where('status_id',3)
                                    ->orderBy('created_at','asc')
                                    ->get(),
        ]);
    }
}
