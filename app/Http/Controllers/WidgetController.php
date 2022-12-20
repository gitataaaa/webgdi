<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Widget;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            $path = $req->file('image_upload')->store('public/images/slider');
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
}
