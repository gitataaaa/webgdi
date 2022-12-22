<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SocialMediaController extends Controller
{
    public function __construct(){}

    public function index(){
        $result = SocialMedia::query()->get();
        return view('social_media.list-social-media',[
            'pageTitle' => 'Meta: Media Sosial',
            'active' => ['MetaActive'=>'active', 'MetaSMActive' => 'active'],
            'result' => $result
        ]);
    }

    public function detail($id){
        return response()->json(SocialMedia::find($id));
    }

    public function update(Request $req){
        if($req->id){
            $dataInput = [
                'url' => $req->url,
                'status' => $req->status
            ];
            SocialMedia::where('id', $req->id)->update($dataInput);
        }
        return redirect('/admin/meta/social-media');
    }
}
