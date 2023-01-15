<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    public function __construct(){}

    public function index(){
        $logo = Meta::where('var', 'INST_LOGO')->first();
        $name = Meta::where('var', 'INST_NAME')->first();
        $addr = Meta::where('var', 'INST_ADDR')->first();
        $telp = Meta::where('var', 'INST_TELP')->first();
        $email = Meta::where('var', 'INST_EMAIL')->first();

        $output = [
            'instLogo' => $logo->value,
            'instName' => $name->value,
            'instAddr' => $addr->value,
            'instTelp' => $telp->value,
            'instEmail' => $email->value
        ];

        return view('meta.index-meta-setting', [
            'pageTitle' => 'Meta: Identitas Instansi',
            'active' => ['MetaActive' => 'active', 'MetaIDActive' => 'active'],
            'detail' => $output
        ]);
    }

    public function store(Request $req){
        $instLogo = $req->INST_LOGO;
        $instName = $req->INST_NAME;
        $instAddr = $req->INST_ADDR;
        $instTelp = $req->INST_TELP;
        $instEmail = $req->INST_EMAIL;

        if($req->file('image_upload')){
            $filename = $req->file('image_upload')->getClientOriginalName();
            $path = $req->file('image_upload')->move('images/meta', $filename);
            $instLogo = $path;
        }

        Meta::where('var', 'INST_LOGO')->update(['value' => $instLogo]);
        Meta::where('var', 'INST_NAME')->update(['value' => $instName]);
        Meta::where('var', 'INST_TELP')->update(['value' => $instTelp]);
        Meta::where('var', 'INST_ADDR')->update(['value' => $instAddr]);
        Meta::where('var', 'INST_EMAIL')->update(['value' => $instEmail]);

        return redirect('/admin/meta/identitas-instansi');
    }
}
