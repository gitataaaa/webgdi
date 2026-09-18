@extends('layout.app')

@section('content')
<div class="container">
    <h4>Daftar Program LAZ</h4>
    <a href="{{ route('admin.widget.programlaz.create') }}" class="btn btn-primary mb-3">+ Tambah Program</a>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama Program</th>
                <th>URL Program</th> {{-- 🔹 kolom baru --}}
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Tanggal Publish</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_program }}</td>
                <td>
                    {{-- 🔹 tampilkan URL Program --}}
                    <a href="{{ url('/program/' . $item->url_program) }}" target="_blank">
                        {{ $item->url_program }}
                    </a>
                </td>

                {{-- Deskripsi singkat --}}
                <td>{{ Str::limit($item->description, 50) }}</td>

                {{-- Gambar --}}
                <td>
                    @if($item->image_upload)
                        <img src="{{ asset('uploads/programlaz/'.$item->image_upload) }}" width="100" alt="gambar program">
                    @else
                        <span class="text-muted">Tidak ada</span>
                    @endif
                </td>

                {{-- Tanggal Publish --}}
                <td>{{ $item->date_publish ? $item->date_publish : '-' }}</td>

                {{-- Status --}}
                <td>
                    @if($item->status === 'aktif')
                        <span class="badge bg-success">Aktif</span>
                    @elseif($item->status === 'draft')
                        <span class="badge bg-secondary">Draft</span>
                    @else
                        <span class="badge bg-danger">Nonaktif</span>
                    @endif
                </td>

                {{-- Tombol Aksi --}}
                <td>
                    <a href="{{ route('admin.widget.programlaz.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.widget.programlaz.delete', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin mau hapus program ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach

            {{-- Kalau belum ada data --}}
            @if($data->isEmpty())
            <tr>
                <td colspan="8" class="text-center text-muted">Belum ada program yang ditambahkan.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
