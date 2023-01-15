<?php

namespace App\Exports;

use App\Models\ProgramDonasi;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DonaturExport implements FromView
{
    protected $program, $dateStart, $dateEnd;

    public function __construct($program, $dateStart, $dateEnd){
        $this->program = $program;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }
    
    public function view(): View
    {
        $program = $this->program;
        $dateStart = $this->dateStart;
        $dateEnd = $this->dateEnd;
        
        if($program == 'all'){
            if($dateStart && $dateEnd){
                $table = ProgramDonasi::join('programs', 'programs.id', '=', 'program_id')
                            ->selectRaw('donatur, DATE_FORMAT(date_donasi, "%d-%m-%Y %H:%i") as tanggal, nominal, programs.title')
                            ->whereRaw('DATE_FORMAT(date_donasi, "%Y-%m-%d") BETWEEN "'.$dateStart.'" AND "'.$dateEnd.'"')
                            ->get();
            }else{
                $table = ProgramDonasi::join('programs', 'programs.id', '=', 'program_id')
                            ->selectRaw('donatur, DATE_FORMAT(date_donasi, "%d-%m-%Y %H:%i") as tanggal, nominal, programs.title')
                            ->get();
            }
            
        }else{
            if($dateStart && $dateEnd){
                $table = ProgramDonasi::join('programs', 'programs.id', '=', 'program_id')
                            ->selectRaw('donatur, DATE_FORMAT(date_donasi, "%d-%m-%Y %H:%i") as tanggal, nominal, programs.title')
                            ->where('program_id', $program)
                            ->whereRaw('DATE_FORMAT(date_donasi, "%Y-%m-%d") BETWEEN "'.$dateStart.'" AND "'.$dateEnd.'"')
                            ->get();
            }else{
                $table = ProgramDonasi::join('programs', 'programs.id', '=', 'program_id')
                            ->selectRaw('donatur, DATE_FORMAT(date_donasi, "%d-%m-%Y %H:%i") as tanggal, nominal, programs.title')
                            ->where('program_id', $program)
                            ->get();
            }
            
        }
        
        return view('program.exports.donatur', [
            'result' => $table
        ]);
    }
}
