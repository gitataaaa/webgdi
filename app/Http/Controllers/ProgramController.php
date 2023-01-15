<?php

namespace App\Http\Controllers;

use DataTables;
use App\Helper;
use App\Models\Program;
use App\Models\ProgramRealisasi;
use App\Models\ProgramDonasi;
use App\Exports\DonaturExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class ProgramController extends Controller
{
    public function __construct(){}

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
        return view('program.list-program', [
            'pageTitle' => 'Kelola Program',
            'active' => ['ProgActive'=>'active', 'ProgMngActive'=>'active']
        ]);
    }

    public function table(){
        return DataTables::eloquent(Program::query())
            ->addIndexColumn()
            ->addColumn('action', function(Program $table){
                $button = '<a href="/admin/program/'.$table->id.'/detail" class="btn btn-sm btn-warning" title="Detail Program"><i class="bi-list"></i></a> 
                    <a href="/admin/program/'.$table->id.'/edit" class="btn btn-sm btn-primary"><i class="bi-pencil-square"></i></a> 
                    <button type="button" class="btn btn-sm btn-danger btn-del" data-id="'.$table->id.'"><i class="bi-trash"></i></button>';
                return $button;
            })
            ->make();
    }

    public function delete($id){
        $prog = Program::find($id);
        $prog->delete();
    }

    public function form($id=null){
        $category = Program::select('category')->distinct()->get();
        $detail = [];
        if($id){
            $mode = 'Ubah Data';
            $detail = Program::find($id);
        }else{
            $mode = 'Tambah';
        }
        
        return view('program.form-program', [
            'pageTitle' => $mode.' Program',
            'active' => ['ProgActive'=>'active', 'ProgMngActive'=>'active'],
            'mode' => $mode,
            'detail' => $detail,
            'category' => $category
        ]);
    }

    public function store(Request $req){
        /* nanti dilengkapi */
        $dataCheck = $req->validate([
            'title' => ['required', 'string'],
            'image_upload' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $dates = $this->_rangeReFormat($req->dates);
        $dataInput = [
            'title' => $req->title,
            'slug' => Str::of($req->title)->slug('-'), //$req->slug,
            'description' => $req->description,
            'target_nominal' => str_replace(',','',$req->target_nominal),
            'date_start' => @$dates['date_start'], //$this->_dateFormat($req->date_start),
            'date_end' => @$dates['date_end'], //$this->_dateFormat($req->date_end),
            'pic' => $req->pic,
            'date_publish' => $req->status == 'publish' ? date('Y-m-d H:i:s') : null,
            'contact' => $req->contact,
            'category' => $req->kategori_baru ? $req->kategori_baru : $req->category,
            'status' => $req->status
        ];
        if($req->file('image_upload')){
            $fileName = $req->file('image_upload')->getClientOriginalName() ;
            $path = $req->file('image_upload')->move('images/program', $fileName);
            $dataInput['image_upload'] = $path;
        }
        
        if($req->id){
            Program::where('id', $req->id)->update($dataInput);
        }else{
            Program::create($dataInput);
        }
        
        return redirect('/admin/program');
    }

    /* realisasi */
    public function detail($id){
        $detail = Program::find($id);
        return view('program.detail-program', [
            'pageTitle' => 'Detail Program',
            'active' => ['ProgActive'=>'active', 'ProgMngActive'=>'active'],
            'detail' => $detail
        ]);
    }

    public function table_realisasi($id){
        return DataTables::eloquent(ProgramRealisasi::where('program_id', $id))
            ->addIndexColumn()
            ->addColumn('action', function(ProgramRealisasi $table){
                $button = '<a href="/admin/program/realisasi/'.$table->program_id.'/'.$table->id.'/edit" class="btn btn-sm btn-primary"><i class="bi-pencil-square"></i></a> 
                    <button type="button" class="btn btn-sm btn-danger btn-del" data-id="'.$table->id.'"><i class="bi-trash"></i></button>';
                return $button;
            })
            ->make();
    }

    public function form_realisasi($program, $id=null){
        $detail = [];
        $programList = Program::find($program);
        if($id){
            $mode = 'Ubah Data';
            $detail = ProgramRealisasi::find($id);
        }else{
            $mode = 'Tambah';
        }
        
        return view('program.form-program-realisasi', [
            'pageTitle' => $mode.' Realisasi Program',
            'active' => ['ProgActive'=>'active', 'ProgMngActive'=>'active'],
            'mode' => $mode,
            'detail' => $detail,
            'program' => $programList
        ]);
    }

    public function store_realisasi(Request $req){
        /* nanti dilengkapi */
        $dataCheck = $req->validate([
            'title' => ['required', 'string'],
        ]);
        $dataInput = [
            'program_id' => $req->program_id,
            'title' => $req->title,
            'description' => $req->description,
            'date_realisasi' => $this->_dateFormat($req->date_realisasi),
            'pelaksana' => $req->pelaksana,
            'date_publish' => $req->status == 'publish' ? date('Y-m-d H:i:s') : null,
            'status' => $req->status
        ];
        
        if($req->id){
            ProgramRealisasi::where('id', $req->id)->update($dataInput);
        }else{
            ProgramRealisasi::create($dataInput);
        }
        
        return redirect('/admin/program/'.$req->program_id.'/detail');
    }

    public function delete_realisasi($id){
        $prog = ProgramRealisasi::find($id);
        $prog->delete();
    }

    /* rekapitulasi */

    public function index_recap(){
        $program = Program::all();
        
        return view('program.list-program-recap', [
            'pageTitle' => 'Rekapitulasi Program',
            'active' => ['ProgActive'=>'active', 'ProgRecapActive'=>'active'],
            'program' => $program,
        ]);
    }

    public function getDataChart(Request $req){
        $program = @$req->program;
        $dates = [];
        if(@$req->dates){
            $dates = $this->_rangeReFormat($req->dates);
            if(@$req->program != 'all'){
                $table = Program::selectRaw('programs.title, (SELECT SUM(program_donasis.nominal) FROM program_donasis WHERE program_donasis.program_id = programs.id AND DATE_FORMAT(program_donasis.date_donasi, "%Y-%m-%d") BETWEEN "'.$dates['date_start'].'" AND "'.$dates['date_end'].'") as donasi')
                                    ->where('programs.id', $req->program)->get();
            }else{
                $table = Program::selectRaw('programs.title, (SELECT SUM(program_donasis.nominal) FROM program_donasis WHERE program_donasis.program_id = programs.id AND DATE_FORMAT(program_donasis.date_donasi, "%Y-%m-%d") BETWEEN "'.$dates['date_start'].'" AND "'.$dates['date_end'].'") as donasi')->get();
            }
        }else{
            if(@$req->program != 'all'){
                $table = Program::selectRaw('programs.title, (SELECT SUM(nominal) FROM program_donasis WHERE program_id = programs.id) as donasi')
                                    ->where('programs.id', $req->program)->get();
            }else{
                $table = Program::selectRaw('programs.title, (SELECT SUM(nominal) FROM program_donasis WHERE program_id = programs.id) as donasi')->get();
            }
        }
        $output = [
            'program' => [],
            'donasi' => [],
            'total' => 0,
            'range' => @$req->dates ? Helper::dateFormat($dates['date_start']).' s/d '.Helper::dateFormat($dates['date_end']) : ''
        ];
        if($table){
            foreach($table as $dt){
                $output['program'][] = $dt->title;
                $output['donasi'][] = $dt->donasi; 
                $output['total'] += $dt->donasi;
            }
        }

        return response()->json($output, 200);
    }

    public function table_recap(Request $req){
        $program = $req->program;

        $dStart = null;
        $dEnd = null;
        if($req->dates){
            $dates = $this->_rangeReFormat($req->dates);
            $dStart = $dates['date_start'];
            $dEnd = $dates['date_end'];
        }

        if($program == 'all'){
            if($req->dates){
                $table = Program::selectRaw('programs.*, (SELECT SUM(nominal) FROM program_donasis WHERE program_donasis.program_id = programs.id AND DATE_FORMAT(program_donasis.date_donasi, "%Y-%m-%d") BETWEEN "'.$dStart.'" AND "'.$dEnd.'") as total_donasi');
            }else{
                $table = Program::selectRaw('programs.*, (SELECT SUM(nominal) FROM program_donasis WHERE program_donasis.program_id = programs.id) as total_donasi');
            }
        }else{
            if($req->dates){
                $table = Program::selectRaw('programs.*, (SELECT SUM(nominal) FROM program_donasis WHERE program_donasis.program_id = programs.id AND DATE_FORMAT(program_donasis.date_donasi, "%Y-%m-%d") BETWEEN "'.$dStart.'" AND "'.$dEnd.'") as total_donasi')
                            ->where('programs.id', $program);
            }else{
                $table = Program::selectRaw('programs.*, (SELECT SUM(nominal) FROM program_donasis WHERE program_donasis.program_id = programs.id) as total_donasi')
                            ->where('programs.id', $program);
            }
            
        }

        return DataTables::eloquent($table)
            ->addIndexColumn()
            ->make();
    }

    /* rekapitulasi donatur */
    public function index_recap_donatur(){
        $program = Program::all();
        
        return view('program.list-program-recap-donatur', [
            'pageTitle' => 'Rekapitulasi Donatur',
            'active' => ['ProgActive'=>'active', 'ProgRecapActive'=>'active'],
            'program' => $program,
        ]);
    }

    public function table_recap_donatur(Request $req){
        $program = $req->program;

        $dStart = null;
        $dEnd = null;
        if($req->dates){
            $dates = $this->_rangeReFormat($req->dates);
            $dStart = $dates['date_start'];
            $dEnd = $dates['date_end'];
        }

        
        if($program == 'all'){
            if($req->dates){
                $table = ProgramDonasi::leftJoin('programs', 'programs.id', '=', 'program_donasis.program_id')
                            ->selectRaw('donatur, nominal, DATE_FORMAT(date_donasi, "%d-%m-%Y %H:%i") as date_donasi, programs.title as program')
                            ->whereRaw('DATE_FORMAT(date_donasi, "%Y-%m-%d") BETWEEN "'.$dStart.'" AND "'.$dEnd.'"')
                            ->orderBy('program_donasis.date_donasi', 'desc');
            }else{
                $table = ProgramDonasi::leftJoin('programs', 'programs.id', '=', 'program_donasis.program_id')
                            ->selectRaw('donatur, nominal, DATE_FORMAT(date_donasi, "%d-%m-%Y %H:%i") as date_donasi, programs.title as program')
                            ->orderBy('program_donasis.date_donasi', 'desc');
            }
        }else{
            if($req->dates){
                $table = ProgramDonasi::leftJoin('programs', 'programs.id', '=', 'program_donasis.program_id')
                            ->selectRaw('donatur, nominal, DATE_FORMAT(date_donasi, "%d-%m-%Y %H:%i") as date_donasi, programs.title as program')
                            ->whereRaw('DATE_FORMAT(date_donasi, "%Y-%m-%d") BETWEEN "'.$dStart.'" AND "'.$dEnd.'"')
                            ->where('program_id', $program)
                            ->orderBy('program_donasis.date_donasi', 'desc');
            }else{
                $table = ProgramDonasi::leftJoin('programs', 'programs.id', '=', 'program_donasis.program_id')
                            ->selectRaw('donatur, nominal, DATE_FORMAT(date_donasi, "%d-%m-%Y %H:%i") as date_donasi, programs.title as program')
                            ->where('program_id', $program)
                            ->orderBy('program_donasis.date_donasi', 'desc');
            }
            
        }

        //dd($table->get());

        return DataTables::eloquent($table)
            ->addIndexColumn()
            ->make();
    }

    public function exportExcel($program=null, $dateStart=null, $dateEnd=null){
        $program = $program ? $program : 'all';
        return Excel::download(new DonaturExport($program, $dateStart, $dateEnd), 'Rekapitulasi_Daftar_Donatur.xlsx');
    }
}
