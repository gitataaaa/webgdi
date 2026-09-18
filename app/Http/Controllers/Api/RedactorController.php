<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RedactorController extends Controller
{
    public function upload(Request $req){
        $creds = $req->validate([
            'file.*' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],[
            'erros' => true,
            'message' => 'File upload tidak sesuai',
            'file.*.mimes' => 'Jenis file tidak sesuai',
            'file.*.max' => 'Ukuran file terlalu besar'
        ]);
        $output = [];
        foreach($req->file as $key=>$val){
            $name = $req->file('file')[$key]->getClientOriginalName();
            $path = $req->file('file')[$key]->move('images/general', $name);

            $output['file-'.($key+1)] =  [
                'url' => asset($path),
                'id' => $name
            ];
        }
        //return response()->json($output, 200);
        return $output;
    }
}
