<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(){}

    public function index(){
        return view('message.list-message',[
            'pageTitle' => 'Pesan',
            'active' => ['MsgActive' => 'active']
        ]);
    }

    public function table(){
        return DataTables::eloquent(Message::query()->orderBy('date_send', 'asc'))
            ->addIndexColumn()
            ->addColumn('action', function(Message $table){
                $button = '<a href="/admin/message/'.$table->id.'/detail" class="btn btn-sm btn-primary"><i class="bi-eye"></i></a> 
                    <button type="button" class="btn btn-sm btn-danger btn-del" data-id="'.$table->id.'"><i class="bi-trash"></i></button>';
                return $button;
            })
            ->make();
    }

    public function delete($id){
        $msg = Message::find($id);
        $msg->delete();
    }

    public function detail($id){
        $detail = Message::find($id);

        Message::where('id', $id)->update(['status' => 'read']);

        return view('message.detail-message', [
           'pageTitle' => 'Pesan',
           'active' => ['MsgActive' => 'active'],
           'detail' => $detail 
        ]);
    }
}
