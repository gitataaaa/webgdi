<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Program;
use App\Models\ProgramRealisasi;
use App\Models\ProgramDonasi;
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
        $dataInput = [
            'title' => $req->title,
            'slug' => Str::of($req->title)->slug('-'), //$req->slug,
            'description' => $req->description,
            'target_nominal' => str_replace(',','',$req->target_nominal),
            'date_start' => $this->_dateFormat($req->date_start),
            'date_end' => $this->_dateFormat($req->date_end),
            'pic' => $req->pic,
            'date_publish' => $req->status == 'publish' ? date('Y-m-d H:i:s') : null,
            'contact' => $req->contact,
            'category' => $req->kategori_baru ? $req->kategori_baru : $req->category,
            'status' => $req->status
        ];
        
        if($req->file('image_upload')){
            $path = $req->file('image_upload')->store('public/images/program');
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
            'program' => $program
        ]);
    }

    private function _rangeReFormat($dates){
        $date = explode(' s/d ', $dates);
        return array(
            'date_start' => $this->_dateFormat($date[0]),
            'date_end'   => $this->_dateFormat($date[1])
        );
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
                $table = Program::selectRaw('*, (SELECT SUM(nominal) FROM program_donasis WHERE program_donasis.program_id = id AND DATE_FORMAT(program_donasis.date_donasi, "%Y-%m-%d") BETWEEN "'.$dStart.'" AND "'.$dEnd.'") as total_donasi');
            }else{
                $table = Program::selectRaw('*, (SELECT SUM(nominal) FROM program_donasis WHERE program_donasis.program_id = id) as total_donasi');
            }
        }else{
            if($req->dates){
                $table = Program::selectRaw('*, (SELECT SUM(nominal) FROM program_donasis WHERE program_donasis.program_id = id AND DATE_FORMAT(program_donasis.date_donasi, "%Y-%m-%d") BETWEEN "'.$dStart.'" AND "'.$dEnd.'") as total_donasi')
                            ->where('id', $program);
            }else{
                $table = Program::selectRaw('*, (SELECT SUM(nominal) FROM program_donasis WHERE program_donasis.program_id = id) as total_donasi')
                            ->where('id', $program);
            }
            
        }

        
        
        return DataTables::eloquent($table)
            ->addIndexColumn()
            ->make();
    }
}
