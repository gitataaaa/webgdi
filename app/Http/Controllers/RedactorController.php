<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class RedactorController extends Controller
{
    public function upload(Request $req){
        $creds = $req->validate([
            'file.*' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        
        $output = [];
        foreach($req->file as $key=>$val){
            $name = $req->file('file')[$key]->getClientOriginalName();
            $path = $req->file('file')[$key]->store('public/images');

            $output['file'] =  [
                'url' => asset(str_replace('public', 'storage', $path)),
                'id' => $name
            ];
        }
        return response()->json($output, 200);
    }
}
