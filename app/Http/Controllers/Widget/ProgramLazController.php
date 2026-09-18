<?php

namespace App\Http\Controllers\Widget;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgramLaz;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProgramLazController extends Controller
{
    public function index()
    {
        $data = ProgramLaz::latest()->get();
        $active = 'WidDescActive';
        return view('widget.programlaz.index', compact('data', 'active'));
    }

    public function create()
    {
        $active = 'WidDescActive';
        return view('widget.programlaz.create', compact('active'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'description' => 'required|string',
            'image_upload' => 'nullable|image|max:2048',
            'status' => 'nullable|in:aktif,draft,nonaktif',
        ]);

        $imageName = null;
        if ($request->hasFile('image_upload')) {
            $imageName = time() . '.' . $request->image_upload->extension();
            $request->image_upload->move(public_path('uploads/programlaz'), $imageName);
        }

        $datePublish = $request->status === 'aktif' ? now() : null;

        ProgramLaz::create([
            'nama_program' => $request->nama_program,
            'url_program' => Str::slug($request->nama_program), // 🔹 generate otomatis
            'description' => $request->description,
            'image_upload' => $imageName,
            'date_publish' => $datePublish,
            'status' => $request->status ?? 'aktif',
        ]);

        return redirect()->route('admin.widget.programlaz.index')
            ->with('success', 'Program LAZ berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = ProgramLaz::findOrFail($id);
        $active = 'WidDescActive';
        return view('widget.programlaz.edit', compact('data', 'active'));
    }

    public function update(Request $request, $id)
    {
        $data = ProgramLaz::findOrFail($id);

        $request->validate([
            'nama_program' => 'required|string|max:255',
            'description' => 'required|string',
            'image_upload' => 'nullable|image|max:2048',
            'status' => 'nullable|in:aktif,draft,nonaktif',
        ]);

        if ($request->hasFile('image_upload')) {
            if ($data->image_upload && File::exists(public_path('uploads/programlaz/' . $data->image_upload))) {
                File::delete(public_path('uploads/programlaz/' . $data->image_upload));
            }
            $imageName = time() . '.' . $request->image_upload->extension();
            $request->image_upload->move(public_path('uploads/programlaz'), $imageName);
            $data->image_upload = $imageName;
        }

        // Update tanggal publish
        if ($request->status === 'aktif') {
            $datePublish = $data->date_publish ?? now();
        } elseif ($request->status === 'draft') {
            $datePublish = null;
        } else {
            $datePublish = $data->date_publish;
        }

        $data->update([
            'nama_program' => $request->nama_program,
            'url_program' => Str::slug($request->nama_program), // 🔹 update otomatis
            'description' => $request->description,
            'date_publish' => $datePublish,
            'status' => $request->status ?? 'aktif',
        ]);

        return redirect()->route('admin.widget.programlaz.index')
            ->with('success', 'Program LAZ berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = ProgramLaz::findOrFail($id);

        if ($data->image_upload && File::exists(public_path('uploads/programlaz/' . $data->image_upload))) {
            File::delete(public_path('uploads/programlaz/' . $data->image_upload));
        }

        $data->delete();

        return redirect()->route('admin.widget.programlaz.index')
            ->with('success', 'Program LAZ berhasil dihapus!');
    }
}
