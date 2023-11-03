<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

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
        

    }

  

}
