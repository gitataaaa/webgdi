@extends('layout.app')

@section('content')
<div class="container">
    <h4>Tambah Program LAZ</h4>
    <a href="{{ route('admin.widget.programlaz.index') }}">Kembali</a>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.widget.programlaz.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Nama Program --}}
        <div class="form-group mb-3">
            <label for="nama_program">Nama Program</label>
            <input type="text" name="nama_program" id="nama_program" class="form-control"
                   value="{{ old('nama_program') }}" required>
        </div>

        {{-- Slug (otomatis, tapi bisa diubah kalau mau) --}}
        <div class="form-group mb-3">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control"
                   value="{{ old('slug') }}" placeholder="Slug akan terisi otomatis">
        </div>

       

        {{-- Deskripsi --}}
        <div class="form-group mb-3">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="6" class="form-control">{{ old('description') }}</textarea>
        </div>

        {{-- Gambar --}}
        <div class="form-group mb-3">
            <label for="image_upload">Gambar Pendukung (opsional)</label>
            <input type="file" name="image_upload" id="image_upload" class="form-control-file">
        </div>

        {{-- Status --}}
        <div class="form-group mb-4">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Non aktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

{{-- Script untuk auto slug dan URL --}}
<script>
function slugify(text) {
    return text
        .toString()
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')      // ubah spasi jadi "-"
        .replace(/[^\w\-]+/g, '')  // hapus karakter aneh
        .replace(/\-\-+/g, '-')    // hapus duplikat "-"
        .replace(/^-+/, '')        // hapus "-" di awal
        .replace(/-+$/, '');       // hapus "-" di akhir
}

const namaProgram = document.getElementById('nama_program');
const slugInput = document.getElementById('slug');
const urlPreview = document.getElementById('url_preview');

function updateSlug() {
    const generatedSlug = slugify(namaProgram.value);
    slugInput.value = generatedSlug;
    urlPreview.value = "{{ url('programlaz') }}/" + generatedSlug;
}

namaProgram.addEventListener('input', updateSlug);
slugInput.addEventListener('input', function() {
    urlPreview.value = "{{ url('programlaz') }}/" + this.value;
});
</script>
@endsection
