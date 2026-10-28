<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\ProgramUtama;
use App\Models\ProgramDokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProgramUtamaController extends Controller
{
    public function index()
    {
        return view('program_utama.list', [
            'pageTitle' => 'Program: Program Utama',
            'active' => ['ProgActive' => 'active', 'ProgImplActive' => 'active'],
        ]);
    }

    public function table()
    {
        return DataTables::eloquent(ProgramUtama::query()->orderBy('id'))
            ->addIndexColumn()
            ->addColumn('logo', function (ProgramUtama $row) {
                if ($row->logo_image && file_exists(public_path($row->logo_image))) {
                    return '<img src="' . asset($row->logo_image) . '" class="program-utama-logo" alt="' . e($row->nama_program) . '"/>';
                }
                return '<img src="' . asset('admin/assets/img/setting/_img.jpg') . '" class="program-utama-logo" alt="logo"/>';
            })
            ->addColumn('action', function (ProgramUtama $row) {
                return '<div class="d-inline-flex gap-2 align-items-center">'
                    . '<a href="/admin/program/utama/' . $row->id . '/edit" class="text-primary" title="Ubah"><i class="bi-pencil-square"></i></a>'
                    . '<button type="button" class="btn btn-link p-0 text-danger btn-del" data-id="' . $row->id . '" title="Hapus"><i class="bi-trash"></i></button>'
                    . '</div>';
            })
            ->rawColumns(['logo', 'action'])
            ->make();
    }

    public function form($id = null)
    {
        $detail = null;
        if ($id) {
            $mode = 'Ubah';
            $detail = ProgramUtama::findOrFail($id);
        } else {
            $mode = 'Tambah';
        }

        return view('program_utama.form', [
            'pageTitle' => $mode . ' Program Utama',
            'active' => ['ProgActive' => 'active', 'ProgImplActive' => 'active'],
            'mode' => $mode,
            'detail' => $detail,
        ]);
    }

    public function store(Request $req)
    {
        $req->validate([
            'nama_program' => ['required', 'string', 'max:150'],
            'logo_image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg,webp', 'max:2048'],
        ]);

        $user = Auth::user();
        $now = now();

        $dataInput = [
            'nama_program' => trim($req->nama_program),
            'update_user' => $user ? $user->name : null,
            'update_date' => $now,
        ];

        if ($req->file('logo_image')) {
            $dir = public_path('images/program-utama');
            if (!File::isDirectory($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            $file = $req->file('logo_image');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-\._]/', '', $file->getClientOriginalName());
            $file->move($dir, $filename);
            $dataInput['logo_image'] = 'images/program-utama/' . $filename;
        }

        if ($req->id) {
            $detail = ProgramUtama::findOrFail($req->id);

            if (isset($dataInput['logo_image']) && $detail->logo_image && Str::startsWith($detail->logo_image, 'images/program-utama/')) {
                $oldLogo = public_path($detail->logo_image);
                if (file_exists($oldLogo)) {
                    File::delete($oldLogo);
                }
            }

            $detail->update($dataInput);
        } else {
            $base = Str::slug($req->nama_program);
            $slug = $base;
            $i = 2;
            while (ProgramUtama::where('slug', $slug)->exists()) {
                $slug = $base . '-' . $i++;
            }

            $dataInput['slug'] = $slug;
            $dataInput['create_user'] = $user ? $user->name : null;
            $dataInput['create_date'] = $now;

            ProgramUtama::create($dataInput);
        }

        return redirect('/admin/program/utama');
    }

    public function delete($id)
    {
        $detail = ProgramUtama::findOrFail($id);

        if ($detail->logo_image && Str::startsWith($detail->logo_image, 'images/program-utama/')) {
            $logo = public_path($detail->logo_image);
            if (file_exists($logo)) {
                File::delete($logo);
            }
        }

        ProgramDokumentasi::where('program', $detail->slug)->delete();

        $detail->delete();
    }
}
