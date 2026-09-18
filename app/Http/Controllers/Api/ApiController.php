<?php

namespace App\Http\Controllers\api;

use App\Models\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    protected $type = [
        'profesi' => '01',
        'maal' => '02',
        'fitrah' => '03'
    ];


    public function generatePaymentCode($zakatType, $digit){
        $data = Payment::whereRaw('DATE(created_at) = CURDATE()')->get()->count();
        $ztype = Arr::get($this->type, $zakatType);
        $code = date('ymd').$digit.$ztype.Str::padLeft($data+1, 4, '0');

        return $code;
    }

    public function sample(){
        $ztype = 'fitrah';
        $digit = mt_rand(000, 999);
        $code = $this->generatePaymentCode($ztype, $digit);
        $date = date('Y-m-d H:i:s');
        $exp_date = date('Y-m-d H:i:s', strtotime($date. '+1 day'));
        dd($exp_date);
    }

    public function store_payment(Request $request){
        $digit = mt_rand(000, 999);
        $transcode = $this->generatePaymentCode($request->zakat_type, $digit);
        $email = Str::of($request->email_phone)->is('*@*') == true ? $request->email_phone : null;
        $phone = $email == null ? $email : null;

        $date = date('Y-m-d H:i:s');
        $exp_date = date('Y-m-d H:i:s', strtotime($date. '+1 day'));
        $dataInput = [
            'type' => $request->zakat_type,
            'transcode' => $transcode,
            'name' => $request->name,
            'pronoun' => $request->sapaan,
            'anonim' => $request->anonim,
            'notelp' => $phone,
            'email' => $email,
            'nominal' => str_replace(',','',$request->zakat_nominal),
            'payment_method' => $request->payment_method,
            'bank_type' => null,
            'bank_id' => $request->bank_id,
            'digit' => $digit,
            'status' => 'pending',
            'exp_at' => $exp_date
        ];
        
        Payment::create($dataInput);

        return response()->json([
            'code' => $transcode
        ], 200);
    }
}
