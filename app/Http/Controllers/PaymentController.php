<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Payment;
use App\Models\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private function _dateFormat($date){
        $d = explode('-', $date);
        return $d[2].'-'.$d[1].'-'.$d[0];
    }
    private function _rangeReFormat($dates){
        $date = explode(' s/d ', $dates);
        return array(
            'date_start' => $this->_dateFormat($date[0]),
            'date_end'   => $this->_dateFormat($date[1])
        );
    }

    public function index(){
        $bank = Bank::where('status', 'A')->get();
        return view('payment.list-payment',[
            'pageTitle' => 'Daftar Muzaki',
            'active' => ['PayActive'=>'active'],
            'bank' => $bank
        ]);
    }

    public function table(Request $request){
        $payment = Payment::selectRaw('payments.*, banks.bank_name')
            ->leftJoin('banks', 'banks.id', '=', 'payments.bank_id');

        if($request->dates){
            $dates = $this->_rangeReFormat($request->dates);
            $payment->whereRaw('DATE(payments.created_at) >= "' . $dates['date_start'] . '"');
            $payment->whereRaw('DATE(payments.created_at) <= "'. $dates['date_end'] . '"');
        }else{
            $payment->whereRaw('MONTH(payments.created_at) = "'. date('m') . '" AND YEAR(payments.created_at) = "'. date('Y') .'"');
        }

        if($request->type){
            $payment->where('payments.type', $request->type);
        }

        if($request->status){
            $payment->where('payments.status', $request->status);
        }

        if($request->transcode){
            $payment->where('payments.transcode', $request->transcode);
        }

        if($request->bank_id){
            $payment->where('payments.bank_id', $request->bank_id);
        }

        return DataTables::eloquent($payment)
            ->addIndexColumn()
            ->addColumn('action', function(Payment $table){
                $button = '<a href="/admin/program/'.$table->id.'/detail" class="btn btn-sm btn-warning disabled" title="Detail Program"><i class="bi-list"></i></a> 
                    <button type="button" class="btn btn-sm btn-primary btn-update" data-id="'.$table->id.'" title="Complete Payment"><i class="bi-bookmark-check"></i></button>';
                return $button;
            })
            ->make();
    }

    public function update_status($id){
        Payment::where('id', $id)->update([
            'status' => 'complete'
        ]);
    }
}
