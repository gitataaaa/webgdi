<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct(){}

    public function index(){
        return view('menu.list-menu', [
            'pageTitle' => 'Menu',
            'active' => ['MenuActive' => 'active']
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
}
