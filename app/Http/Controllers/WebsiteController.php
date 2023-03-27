<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Program;
use App\Models\ProgramRealisasi;
use App\Models\Blog;
use App\Models\Message;
use App\Models\Widget;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; 
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
                $parentID = $detail ? ($detail->parent_id == 0 ? $detail->id : $detail->parent_id) : null;
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
                        $kategori = Blog::selectRaw('DISTINCT(kategori) as kategori')->get();
                        $blog = Blog::where('status', 'publish')->orderBy('date_publish', 'desc')->get();
                        return view('website.page-blog', [
                            'pageTitle' => $detail->title,
                            'detail' => $detail,
                            'blog' => $blog,
                            'category' => $kategori,
                            'active' => ['menu'.$parentID => 'current']
                        ]);
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
                            'program' => $program,
                        ]);
                        break;
    
                    case 'gallery':
                        $files = File::files(public_path('images/gallery/'));
                        return view('website.page-gallery', [
                            'pageTitle' => $detail->title,
                            'detail' => $detail,
                            'active' => ['menu'.$parentID => 'current'],
                            'files' => $files
                        ]);
                        break;
    
                    case 'contact':
                        return view('website.page-contact', [
                            'pageTitle' => $detail->title,
                            'detail' => $detail,
                            'active' => ['menu'.$parentID => 'current'],
                            'slug' => $slug
                        ]);
                        break;
                }
            }else{
                return view('404');
                /* return 404 */
            }
            
        }else{
            $slider = Widget::where([
                'type' => 'slider',
                'status' => 'A'
            ])->get();
            $program = Program::selectRaw('*, (SELECT SUM(nominal) FROM program_donasis WHERE program_id = programs.id) as donasi')->where([
                'status' => 'publish',
                'program_type' => 'donation'
            ])->limit(3)->get();
            $blog = Blog::where('status', 'publish')->orderBy('date_publish', 'desc')->limit(3)->get();
            $ads = Widget::where([
                'type' => 'ads',
                'status' => 'A'
            ])->first();
            $info = Widget::where([
                'type' => 'general',
                'status' => 'A'
            ])->first();
            $about = Widget::where([
                'type' => 'about',
                'status' => 'A'
            ])->first();
            return view('website.homepage', [
                'pageTitle' => 'Yayasan Graha Dhuafa Indonesia',
                'slider' => $slider,
                'program' => $program,
                'blog' => $blog,
                'ads' => $ads,
                'info' => $info,
                'about' => $about
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

    public function index_blog($slug){
        $menu = Menu::where([
            'page_type' => 'blog_list',
        ])->first();
        $parentID = $menu->parent_id ? $menu->parent_id : $menu->id;

        $detail = Blog::where('slug', $slug)->first();
        $blog = Blog::where('id', '<>', $detail->id)->where('status', 'publish')->orderBy('date_publish', 'desc')->get();
        $kategori = Blog::selectRaw('DISTINCT(kategori) as kategori')->get();
        return view('website.page-blog-detail', [
            'pageTitle' => $detail->title,
            'parent' => $menu->title,
            'detail' => $detail,
            'category' => $kategori,
            'active' => ['menu'.$parentID => 'current'],
            'blog' => $blog
        ]);
    }

    public function index_blog_category($category){
        $menu = Menu::where([
            'page_type' => 'blog_list',
        ])->first();
        $parentID = $menu->parent_id ? $menu->parent_id : $menu->id;

        $blog = Blog::where([
            'status' => 'publish',
            'kategori' => $category
        ])->get();
        $blogLatest = Blog::where('status', 'publish')->orderBy('date_publish', 'desc')->get();
        $kategori = Blog::selectRaw('DISTINCT(kategori) as kategori')->get();
        return view('website.page-blog', [
            'pageTitle' => $menu->title,
            'category' => $kategori,
            'active' => ['menu'.$parentID => 'current'],
            'blog' => $blog,
            'blogLatest' => $blogLatest,
            'categoryKey' => $category
        ]);
    }

    public function store_message(Request $req){
        $dataInput = [
            'sender' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'subject' => $req->subject,
            'content' => $req->message,
            'date_send' => date('Y-m-d H:i:s'),
            'status' => 'new'
        ];

        Message::create($dataInput);
        return redirect('/'.$req->slug)->with('success', true);
    }

    public function index_calc_zakat(){
        return view('website.page-form-zakat');
    }
}
