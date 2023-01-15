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
        $files = File::files(public_path('images/gallery/')); //Storage::disk('local')->files('public/images/gallery/');
        //dd($files);
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
                $file = $req->file('image_upload')[$key];
                $filename = md5($file->getClientOriginalName().date('YmdHis')).'.'.$file->getClientOriginalExtension();
                $path = $req->file('image_upload')[$key]->move('images/gallery', $filename);
                $output[] = [
                    'file' => asset('images/gallery/'.$filename),
                    'path' => 'images/gallery/'.$filename
                ];
            }
        }

        return response()->json($output, 200);
    }

    public function delete(Request $req){
        $imgPath = public_path($req->path);
        if(File::exists($imgPath)){
            unlink($imgPath);
        }
    }
}
