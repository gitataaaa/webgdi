<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Program;
use App\Models\ProgramRealisasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function __construct(){

    }

    public function index($slug=null){
        $detail = [];
        if($slug){
            if($slug != 'donasi'){
                $detail = Menu::where('slug', $slug)->first();
                $parentID = $detail->parent_id == 0 ? $detail->id : $detail->parent_id;
            }
            if($detail){
                switch($detail->page_type){
                    case 'general':
                        return view('website.page-general', [
                            'pageTitle' => $detail->title,
                            'detail' => $detail,
                            'active' => ['menu'.$parentID => 'current']
                        ]);
                        break;
    
                    case 'blog_list':
                        break;
                    
                    case 'program_list':
                        $program = Program::selectRaw('*, (SELECT SUM(nominal) FROM program_donasis WHERE program_id = programs.id) as donasi')->where([
                            'status' => 'publish',
                            'program_type' => 'donation'
                        ])->get();
                        return view('website.page-program', [
                            'pageTitle' => $detail->title,
                            'detail' => $detail,
                            'active' => ['menu'.$parentID => 'current'],
                            'program' => $program
                        ]);
                        break;
    
                    case 'gallery':
                        break;
    
                    case 'contact':
                        break;
                }
            }else{
                return redirect('/'.$slug);
            }
            
        }else{
            return view('website.homepage', [
                'pageTitle' => 'Yayasan Graha Dhuafa Indonesia'
            ]);
        }
        
    }

    public function index_program($slug, $detailSlug=null){
        $detail = Menu::where('slug', 'program')->first();
        if($slug == 'donasi'){
            if($detailSlug){
                /* detail program donasi */
                $programDetail = Program::selectRaw('*, (SELECT SUM(nominal) FROM program_donasis WHERE program_id = programs.id) as donasi, (SELECT COUNT(donatur) FROM program_donasis WHERE program_id = programs.id) as donatur')
                                    ->where('slug', $detailSlug)->first();
                $programService = Program::where([
                    'status' => 'publish',
                    'program_type' => 'non-donation'
                ])->get();
                $programService = count($programService) > 0 ? $programService->random(1) : []; 

                $programRealisasi = ProgramRealisasi::where('program_id', $programDetail->id)->get();

                $programSuggest = Program::selectRaw('*, (SELECT SUM(nominal) FROM program_donasis WHERE program_id = programs.id) as donasi, (SELECT COUNT(donatur) FROM program_donasis WHERE program_id = programs.id) as donatur')
                            ->where('id', '<>', $programDetail->id)
                            ->where('program_type', 'donation')->get();
                $programSuggest = count($programSuggest) >= 3 ? $programSuggest->random(3): $programSuggest;

                return view('website.page-program-detail', [
                    'pageTitle' => $programDetail->title,
                    'active' => ['menu'.$detail->id => 'current'],
                    'parent' => 'Program',
                    'detail' => $programDetail,
                    'programService' => $programService,
                    'programRealisasi' => $programRealisasi,
                    'programSuggest' => $programSuggest
                ]);
            }else{
                $program = Program::selectRaw('*, (SELECT SUM(nominal) FROM program_donasis WHERE program_id = programs.id) as donasi')->where([
                    'status' => 'publish',
                    'program_type' => 'donation'
                ])->get();
                return view('website.page-program', [
                    'pageTitle' => 'Program Donasi',
                    'active' => ['menu'.$detail->id => 'current'],
                    'parent' => 'Program',
                    'program' => $program
                ]);
            }
            
        }else{
            /* detail program non donasi */
            $programDetail = Program::selectRaw('*, (SELECT SUM(nominal) FROM program_donasis WHERE program_id = programs.id) as donasi, (SELECT COUNT(donatur) FROM program_donasis WHERE program_id = programs.id) as donatur')
                                    ->where('slug', $slug)->first();
            $programService = Program::where([
                'status' => 'publish',
                'program_type' => 'non-donation'
            ])->get();
            $programService = count($programService) > 0 ? $programService->random(1) : []; 

            $programSuggest = Program::selectRaw('*, (SELECT SUM(nominal) FROM program_donasis WHERE program_id = programs.id) as donasi, (SELECT COUNT(donatur) FROM program_donasis WHERE program_id = programs.id) as donatur')
                        ->where('program_type', 'donation')->get();
            $programSuggest = count($programSuggest) >= 3 ? $programSuggest->random(3): $programSuggest;
            return view('website.page-program-detail', [
                'pageTitle' => $programDetail->title,
                'active' => ['menu'.$detail->id => 'current'],
                'parent' => 'Program',
                'detail' => $programDetail,
                'programService' => $programService,
                'programSuggest' => $programSuggest
            ]);
        }
    }


}
