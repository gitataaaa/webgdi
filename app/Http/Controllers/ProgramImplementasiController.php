<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\ProgramImplementasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramImplementasiController extends Controller
{
    public function index()
    {
        return view('program_implementasi.list', [
            'pageTitle' => 'Program: Program Implementasi',
            'active' => ['ProgActive' => 'active', 'ProgImplActive' => 'active'],
        ]);
    }

    public function table()
    {
        return DataTables::eloquent(ProgramImplementasi::query())
            ->addIndexColumn()
            ->addColumn('logo', function (ProgramImplementasi $row) {
                if ($row->logo_image && file_exists(public_path($row->logo_image))) {
                    return '<img src="' . asset($row->logo_image) . '" width="60"/>';
                }
                return '<img src="' . asset('admin/assets/img/setting/_img.jpg') . '" width="60"/>';
            })
            ->addColumn('dokumentasi', function (ProgramImplementasi $row) {
                $slug = strtolower(trim($row->nama_program));
                $slug = trim(preg_replace('/[^a-z0-9]+/', '-', $slug), '-');
                $url  = url('/admin/program/dokumentasi') . '?program=' . urlencode($slug);

                return '<a href="' . $url . '" class="btn btn-sm btn-outline-success btn-docs" title="Kelola Dokumentasi"><i class="bi-list-ul"></i></a>';
            })
            ->rawColumns(['logo', 'dokumentasi'])
            ->make();
    }

    public function form($id = null)
    {
        $detail = [];
        if ($id) {
            $mode = 'Ubah Data';
            $detail = ProgramImplementasi::findOrFail($id);
        } else {
            $mode = 'Tambah';
        }

        return view('program_implementasi.form', [
            'pageTitle' => $mode . ' Program Implementasi',
            'active' => ['ProgActive' => 'active', 'ProgImplActive' => 'active'],
            'mode' => $mode,
            'detail' => $detail,
        ]);
    }

    public function store(Request $req)
    {
        $req->validate([
            'nama_program' => ['required', 'string', 'max:255'],
            'url_program' => ['nullable', 'string', 'max:255'],
            'logo_image' => ['image', 'mimes:jpg,png,jpeg,gif,svg,webp', 'max:2048'],
        ]);

        $user = Auth::user();

        $dataInput = [
            'nama_program' => $req->nama_program,
            'url_program' => $req->url_program ? trim($req->url_program) : null,
        ];

        /* upload logo: hanya menimpa kalau admin upload file baru */
        if ($req->file('logo_image')) {
            $file      = $req->file('logo_image');
            $filename  = time() . '_' . preg_replace('/[^A-Za-z0-9\-\._]/', '', $file->getClientOriginalName());
            $file->move(public_path('images/program-implementasi'), $filename);
            $dataInput['logo_image'] = 'images/program-implementasi/' . $filename;
        }

        if ($req->id) {
            /* UPDATE */
            $dataInput['update_user'] = $user ? $user->name : null;
            $dataInput['update_date'] = now();
            ProgramImplementasi::where('id', $req->id)->update($dataInput);
        } else {
            /* CREATE */
            $dataInput['create_user'] = $user ? $user->name : null;
            $dataInput['create_date'] = now();
            ProgramImplementasi::create($dataInput);
        }

        return redirect('/admin/program/implementasi');
    }

    public function delete($id)
    {
        ProgramImplementasi::findOrFail($id)->delete();
    }
}
