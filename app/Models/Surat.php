<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'user',
        'tipe_surat',
        'perihal',
        'alamat_pengirim',
        'alamat_tujuan',
        'tanggal',
        'no_surat',
        'file',
        'file_ttd',
    ];

    public function status(){
        return $this->belongsTo(Status::class,'status_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }


    public function getFileAttribute($value)
    {
        if($value){
            return asset('storage/surat/'.$value);
        }

    }

}
