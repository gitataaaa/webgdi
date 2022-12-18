<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(){

    }

    public function index(){
        return view('user.list-user', [
            'pageTitle' => 'Kelola User',
            'active' => ['UserActive' => 'active']
        ]);
    }

    public function table(){
        return DataTables::eloquent(User::query())
            ->addIndexColumn()
            ->addColumn('action', function(User $table){
                $button = '<a href="/admin/user/'.$table->id.'/edit" class="btn btn-sm btn-primary"><i class="bi-pencil-square"></i></a> 
                    <button type="button" class="btn btn-sm btn-danger btn-del" data-id="'.$table->id.'"><i class="bi-trash"></i></button>';
                return $button;
            })
            ->make();
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
    }

    public function form($id=null){
        $detail = [];
        if($id){
            $mode = 'Ubah Data';
            $detail = User::find($id);
        }else{
            $mode = 'Tambah';
        }
        
        return view('user.form-user', [
            'pageTitle' => $mode.' User',
            'active' => ['UserActive' => 'active'],
            'mode' => $mode,
            'detail' => $detail
        ]);
    }

    public function store(Request $req){
        /* nanti dilengkapi */
        $dataCheck = $req->validate([
            'username' => ['required', 'string'],
            'password' => $req->password ? ['required'] : ''
        ]);
        $dataInput = [
            'name' => $req->name,
            'username' => $req->username,
            'email' => $req->email,
            'level' => $req->level,
            'status' => $req->status
        ];
        
        if($req->password){
            $dataInput['password'] = Hash::make($req->password);
        }
        
        
        if($req->id){
            User::where('id', $req->id)->update($dataInput);
        }else{
            User::create($dataInput);
        }
        
        return redirect('/admin/user');
    }

    public function detail(){
        return view('/user/detail-user', [
            'pageTitle' => 'Profil Anda',
            'active' => ['ProfileActive' => 'active'],
            'detail' => Auth::user()
        ]);
    }
}
