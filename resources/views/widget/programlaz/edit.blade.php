@extends('layout.app')

@section('content')
<div class="container">
    <h4>Edit Program LAZ</h4>
    <a href="{{ route('admin.widget.programlaz.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">   
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<form action="{{ route('admin.widget.programlaz.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')  {{-- 🔥 WAJIB ADA INI untuk ubah POST jadi PUT --}}



        {{-- Nama Program --}}
        <div class="form-group mb-3">
            <label for="nama_program">Nama Program</label>
            <input type="text" name="nama_program" id="nama_program" class="form-control"
                   value="{{ old('nama_program', $data->nama_program) }}" required>
        </div>

        {{-- URL Program --}}
        <div class="form-group mb-3">
            <label for="url_program">URL Program</label>
            <input type="text" name="url_program" id="url_program" class="form-control"
                   value="{{ old('url_program', $data->url_program) }}">
        </div>

        {{-- Deskripsi --}}
        <div class="form-group mb-3">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="6" class="form-control">{{ old('description', $data->description) }}</textarea>
        </div>

        {{-- Gambar --}}
        <div class="form-group mb-3">
            <label>Gambar Saat Ini</label><br>
            @if($data->image_upload)
                <img src="{{ asset('uploads/programlaz/'.$data->image_upload) }}" alt="gambar" style="max-width:200px; display:block; margin-bottom:10px;">
            @else
                <div class="text-muted">Belum ada gambar</div>
            @endif
            <label for="image_upload">Ganti Gambar (opsional)</label>
            <input type="file" name="image_upload" id="image_upload" class="form-control-file">
        </div>

        {{-- Status --}}
        <div class="form-group mb-4">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="aktif" {{ old('status', $data->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="draft" {{ old('status', $data->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="nonaktif" {{ old('status', $data->status) == 'nonaktif' ? 'selected' : '' }}>Non aktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

{{-- Script untuk auto URL Program --}}
<script>
function slugify(text) {
    return text
        .toString()
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')
        .replace(/[^\w\-]+/g, '')
        .replace(/\-\-+/g, '-')
        .replace(/^-+/, '')
        .replace(/-+$/, '');
}

const namaProgram = document.getElementById('nama_program');
const urlInput = document.getElementById('url_program');

function updateUrlProgram() {
    const generatedSlug = slugify(namaProgram.value);
    urlInput.value = generatedSlug;
}

namaProgram.addEventListener('input', updateUrlProgram);
</script>
@endsection
