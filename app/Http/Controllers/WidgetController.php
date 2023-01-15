<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Widget;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;

class WidgetController extends Controller
{
    public function __construct(){}

    /* SLIDER */
    public function index_slider(){
        return view('widget.list-slider', [
            'pageTitle' => 'Widget: Slider',
            'active' => ['WidgetActive' => 'active', 'WidSliderActive' => 'active']
        ]);
    }

    public function table_slider(){
        return DataTables::eloquent(Widget::where('type', 'slider'))
            ->addIndexColumn()
            ->addColumn('action', function(Widget $table){
                $button = '<a href="/admin/widget/slider/'.$table->id.'/edit" class="btn btn-sm btn-primary"><i class="bi-pencil-square"></i></a> 
                    <button type="button" class="btn btn-sm btn-danger btn-del" data-id="'.$table->id.'"><i class="bi-trash"></i></button>';
                return $button;
            })
            ->make();
    }

    public function form_slider($id=null){
        $detail = [];
        if($id){
            $mode = 'Ubah Data';
            $detail = Widget::find($id);
        }else{
            $mode = 'Tambah';
        }
        
        return view('widget.form-slider', [
            'pageTitle' => $mode.' Slider',
            'active' => ['WidgetActive' => 'active', 'WidSliderActive' => 'active'],
            'mode' => $mode,
            'detail' => $detail
        ]);
    }

    public function store_slider(Request $req){
        /* nanti dilengkapi */
        $dataCheck = $req->validate([
            'title' => ['required', 'string'],
            'image_upload' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $dataInput = [
            'title' => $req->title,
            'subtitle' => $req->subtitle,
            'description' => $req->description,
            'type' => $req->type,
            'status' => $req->status
        ];
        
        if($req->file('image_upload')){
            $filename = $req->file('image_upload')->getClientOriginalName();
            $path = $req->file('image_upload')->move('images/slider', $filename);
            $dataInput['image_upload'] = $path;
        }

        if($req->input('btn-text.*')){
            $button = [];
            foreach($req->input('btn-text') as $key=>$val){
                if($val){
                    $button[] = [
                        'text' => $val,
                        'url' => $req->input('btn-url')[$key],
                        'classname' => $req->input('btn-class')[$key]
                    ];
                }
            }

            if($button){
                $dataInput['button'] = json_encode($button);
            }
        }
        
        if($req->id){
            Widget::where('id', $req->id)->update($dataInput);
        }else{
            Widget::create($dataInput);
        }
        
        return redirect('/admin/widget/slider');
    }

    public function delete_slider($id){
        $user = Widget::find($id);
        $path = storage_path('app/'.$user->image_upload);
        //dd($path);
        if(File::exists($path)){
            unlink($path);
        }
        $user->delete();
    }

    /* ADS */
    public function index_ads(){
        $detail = Widget::where('type', 'ads')->first();
        return view('widget.index-ads', [
            'pageTitle' => 'Widget: Ads',
            'active' => ['WidgetActive' => 'active', 'WidAdsActive' => 'active'],
            'detail' => $detail
        ]);
    }

    public function store_ads(Request $req){
        $dataCheck = $req->validate([
            'title' => ['required','string'],
            'subtitle' => ['string'],
            'image_upload' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $dataInput = [
            'title' => $req->title,
            'subtitle' => $req->subtitle,
            'type' => $req->type,
            'status' => $req->status
        ];
        
        if($req->file('image_upload')){
            $filename = $req->file('image_upload')->getClientOriginalName();
            $path = $req->file('image_upload')->move('images/ads', $filename);
            $dataInput['image_upload'] = $path;
        }

        if($req->input('btn-text.*')){
            $button = [];
            foreach($req->input('btn-text') as $key=>$val){
                if($val){
                    $button[] = [
                        'text' => $val,
                        'url' => $req->input('btn-url')[$key],
                        'classname' => $req->input('btn-class')[$key]
                    ];
                }
            }

            if($button){
                $dataInput['button'] = json_encode($button);
            }
        }
        
        if($req->id){     
            $detail = Widget::find($req->id);   
            if(!$req->image_upload_temp){
                if($detail->image_upload){
                    $imgPath = storage_path('app/'.$detail->image_upload);
                    if(File::exists($imgPath)){
                        unlink($imgPath);
                        $dataInput['image_upload'] = null;
                    }
                }
            }
            Widget::where('id', $req->id)->update($dataInput);
        }else{
            Widget::create($dataInput);
        }
        
        return redirect('/admin/widget/ads');
    }

    /* SELAYANG PANDANG */
    public function index_about(){
        $detail = Widget::where('type', 'about')->first();
        return view('widget.index-about', [
            'pageTitle' => 'Widget: Selayang Pandang',
            'active' => ['WidgetActive' => 'active', 'WidAboutActive' => 'active'],
            'detail' => $detail
        ]);
    }

    public function store_about(Request $req){
        $dataCheck = $req->validate([
            'title' => ['required','string'],
            'subtitle' => ['string'],
            'description' => ['string'],
            'image_upload_1' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'image_upload_2' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $dataInput = [
            'title' => $req->title,
            'subtitle' => $req->subtitle,
            'description' => $req->description,
            'type' => $req->type,
            'status' => $req->status
        ];
        
        $image = [];
        if($req->file('image_upload_1')){
            $filename = $req->file('image_upload_1')->getClientOriginalName();
            $path = $req->file('image_upload_1')->move('images/about', $filename);
            $image[] = [
                'id' => '1',
                'path' => $path
            ];
        }else{
            $image[] = [
                'id' => '1',
                'path' => $req->image_upload_temp_1
            ];
        }
        if($req->file('image_upload_2')){
            $filename = $req->file('image_upload_2')->getClientOriginalName();
            $path = $req->file('image_upload_2')->move('images/about', $filename);
            $image[] = [
                'id' => '2',
                'path' => $path
            ];
        }else{
            $image[] = [
                'id' => '2',
                'path' => $req->image_upload_temp_2
            ];
        }
        if($image){
            $dataInput['image_upload'] = $image ? json_encode($image) : null;
        }
        
        if($req->id){    
            //dd($image); 
            if($image){
                foreach($image as $im){
                    if(!$im['path']){
                        $tempPath = ($im['id'] == '1' ? $req->image_upload_temp_t1 : $req->image_upload_temp_t2);
                        if($tempPath){
                            $imgPath = storage_path('app/'.$tempPath);
                            if(File::exists($imgPath)){
                                unlink($imgPath);
                                Arr::except($image, ['id.'.$im['id']]);
                            }
                        }
                    }
                }

                $dataInput['image_upload'] = $image ? json_encode($image) : null;
            }   
            
            Widget::where('id', $req->id)->update($dataInput);
        }else{
            Widget::create($dataInput);
        }
        
        return redirect('/admin/widget/about');
    }

    /* SHORT DESC */
    public function index_desc(){
        $detail = Widget::where('type', 'general')->first();
        return view('widget.index-short-desc', [
            'pageTitle' => 'Widget: Deskripsi Singkat',
            'active' => ['WidgetActive' => 'active', 'WidDescActive' => 'active'],
            'detail' => $detail
        ]);
    }

    public function store_desc(Request $req){
        $dataCheck = $req->validate([
            'title' => ['required','string'],
            'subtitle' => ['string'],
            'image_upload' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $dataInput = [
            'title' => $req->title,
            'subtitle' => $req->subtitle,
            'description' => $req->description,
            'type' => $req->type,
            'status' => $req->status
        ];
        
        if($req->file('image_upload')){
            $filename = $req->file('image_upload')->getClientOriginalName();
            $path = $req->file('image_upload')->move('images/widget', $filename);
            $dataInput['image_upload'] = $path;
        }

        if($req->input('btn-text.*')){
            $button = [];
            foreach($req->input('btn-text') as $key=>$val){
                if($val){
                    $button[] = [
                        'text' => $val,
                        'url' => $req->input('btn-url')[$key],
                        'classname' => $req->input('btn-class')[$key]
                    ];
                }
            }

            if($button){
                $dataInput['button'] = json_encode($button);
            }
        }
        
        if($req->id){     
            $detail = Widget::find($req->id);   
            if(!$req->image_upload_temp){
                if($detail->image_upload){
                    $imgPath = storage_path('app/'.$detail->image_upload);
                    if(File::exists($imgPath)){
                        unlink($imgPath);
                        $dataInput['image_upload'] = null;
                    }
                }
            }
            Widget::where('id', $req->id)->update($dataInput);
        }else{
            Widget::create($dataInput);
        }
        
        return redirect('/admin/widget/desc');
    }
}
