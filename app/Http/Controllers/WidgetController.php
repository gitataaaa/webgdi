<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Widget;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class WidgetController extends Controller
{
    public function __construct(){}

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
}
