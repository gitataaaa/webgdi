<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    protected $pageType = [
        'general' => 'General',
        'contact' => 'Contact',
        'blog_list' => 'Blog List',
        'program_list' => 'Program_list',
        'gallery' => 'Gallery',
        'homepage' => 'Homepage'
    ];
    public function __construct(){}

    public function index(){
        return view('menu.list-menu', [
            'pageTitle' => 'Menu',
            'active' => ['MenuActive' => 'active'],
        ]);
    }

    public function table(){
        return DataTables::eloquent(Menu::query())
            ->addIndexColumn()
            ->addColumn('action', function(Menu $table){
                $button = '<a href="/admin/menu/'.$table->id.'/edit" class="btn btn-sm btn-primary"><i class="bi-pencil-square"></i></a> 
                    <button type="button" class="btn btn-sm btn-danger btn-del" data-id="'.$table->id.'"><i class="bi-trash"></i></button>';
                return $button;
            })
            ->make();
    }

    public function delete($id){
        $user = Menu::find($id);
        $user->delete();
    }

    public function form($id=null){
        $detail = [];
        $parent = Menu::where('parent_id', 0)->get();
        if($id){
            $mode = 'Ubah Data';
            $detail = Menu::find($id);
        }else{
            $mode = 'Tambah';
        }
        
        return view('menu.form-menu', [
            'pageTitle' => $mode.' Menu',
            'active' => ['MenuActive' => 'active'],
            'mode' => $mode,
            'detail' => $detail,
            'pageType' => $this->pageType,
            'parent' => $parent
        ]);
    }

    public function store(Request $req){
        /* nanti dilengkapi */
        $dataCheck = $req->validate([
            'title' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'featured_img' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $dataInput = [
            'title' => $req->title,
            'parent_id' => $req->parent_id,
            'slug' => $req->slug,
            'menu_type' => $req->menu_type,
            'url' => $req->url,
            'content' => $req->content, 
            'page_type' => $req->page_type,
            'footer_display' => $req->footer_display,
            'status_display' => $req->status_display,
        ];

        if($req->file('featured_img')){
            $path = $req->file('featured_img')->store('public/images/menu');
            $dataInput['featured_img'] = $path;
        }
        
        if($req->id){
            Menu::where('id', $req->id)->update($dataInput);
        }else{
            Menu::create($dataInput);
        }
        
        return redirect('/admin/menu');
    }
}
