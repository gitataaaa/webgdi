<?php

namespace App;

use Illuminate\Support\Arr;

class Helper{
    public function dateFormat($date){
        $month = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        $d = date('d', strtotime($date));
        $m = date('m', strtotime($date));
        $y = date('Y', strtotime($date));

        return $d.' '.Arr::get($month, $d).' '.$y;
    }
}