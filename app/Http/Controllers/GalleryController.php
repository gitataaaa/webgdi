<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function __construct(){}

    public function index(){
        $files = Storage::disk('local')->files('public/images/gallery/');
        return view('gallery.index-gallery', [
            'pageTitle' => 'Galeri',
            'active' => ['GalleryActive' => 'active'],
            'files' => $files
        ]);
    }

    public function store(Request $req){
        $check = $req->validate([
            'image_upload.*' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $output = [];
        if($req->file('image_upload.*')){
            foreach($req->file('image_upload.*') as $key=>$val){
                $path = $req->file('image_upload')[$key]->store('public/images/gallery');
                $output[] = [
                    'file' => asset(str_replace('public', 'storage', $path)),
                    'path' => $path
                ];
            }
        }

        return response()->json($output, 200);
    }

    public function delete(Request $req){
        $imgPath = storage_path('app/'.$req->path);
        if(File::exists($imgPath)){
            unlink($imgPath);
        }
    }
}
