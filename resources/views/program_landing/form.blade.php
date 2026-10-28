@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS') . ' Hero Landing Program')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Program</a></li>
        <li class="breadcrumb-item"><a href="/admin/program/landing">Hero Landing</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $mode }}</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Form {{ $mode }} Hero Landing Program</h5>
        <a href="/admin/program/landing" class="btn btn-outline-secondary"><i class="bi-arrow-left"></i> Kembali</a>
    </div>
    <hr/>

    <div class="row">
        <div class="col-md-8">
            <form method="post" action="/admin/program/landing/add" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ @$detail->id }}"/>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong><i class="bi-exclamation-triangle"></i> Data gagal disimpan. Periksa kembali:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h6 class="text-muted mt-3">1. Informasi Utama</h6>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Halaman <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-control" required name="slug">
                            <option value="">- Pilih Halaman -</option>
                            @php $selectedSlug = old('slug', @$detail->slug); @endphp
                            @foreach($pages as $slug => $label)
                                @php $sudahDipakai = in_array($slug, $usedSlugs); @endphp
                                <option value="{{ $slug }}" {{ $selectedSlug == $slug ? 'selected' : '' }} {{ $sudahDipakai ? 'disabled' : '' }}>
                                    {{ $label }} (/{{ $slug }}){{ $sudahDipakai ? ' — sudah dipakai' : '' }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Pilih halaman program yang akan memakai hero ini.</small>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Judul <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" required name="title" value="{{ old('title', @$detail->title) }}" placeholder="eg. Budaya">
                        @if($errors->has('title'))<div class="invalid-feedback">{{ $errors->first('title') }}</div>@endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Deskripsi</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="description" rows="4" placeholder="eg. Merupakan program yang berkonsentrasi pada...">{{ old('description', @$detail->description) }}</textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="status">
                            @php $selectedStatus = old('status', @$detail->status ?: 'A'); @endphp
                            <option value="A" {{ $selectedStatus == 'A' ? 'selected' : '' }}>Aktif</option>
                            <option value="N" {{ $selectedStatus == 'N' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <h6 class="text-muted mt-4">2. Logo & Background</h6>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Logo <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <small class="text-muted d-block mb-2">Foto bulat program. Ukuran disarankan 280x280 px, format PNG transparan. Min 10KB, maks 2MB.</small>
                        <div class="d-flex align-items-center gap-3 mb-2">
                            @php
                                $logoUrl = @$detail->logo_image && file_exists(public_path(@$detail->logo_image)) ? asset(@$detail->logo_image) : asset('admin/assets/img/setting/_img.jpg');
                            @endphp
                            <img id="logo_image" src="{{ $logoUrl }}" style="max-width: 110px; border-radius: 50%; border: 1px solid #dee2e6;"/>
                            <div>
                                <input type="file" name="logo_image" accept="image/png,image/jpeg,image/jpg,image/gif,image/svg+xml,image/webp" style="display: none" id="logoImg"/>
                                <label class="btn btn-sm btn-outline-primary btn-upload" for="logoImg"><i class="bi-upload"></i> Pilih Logo</label>
                                <div class="form-text">PNG transparan agar tampil rapi di atas background.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Background</label>
                    <div class="col-sm-9">
                        <small class="text-muted d-block mb-2">Foto latar belakang hero. Ukuran disarankan 1920x1080 px. Kosongkan untuk memakai warna hijau bawaan.</small>
                        <div class="d-flex align-items-center gap-3 mb-2">
                            @php
                                $bgUrl = @$detail->background_image && file_exists(public_path(@$detail->background_image)) ? asset(@$detail->background_image) : asset('admin/assets/img/setting/_img.jpg');
                            @endphp
                            <img id="background_image" src="{{ $bgUrl }}" style="max-width: 200px; border: 1px solid #dee2e6;"/>
                            <div>
                                <input type="file" name="background_image" accept="image/png,image/jpeg,image/jpg,image/webp" style="display: none" id="bgImg"/>
                                <label class="btn btn-sm btn-outline-primary btn-upload" for="bgImg"><i class="bi-upload"></i> Pilih Background</label>
                                <div class="form-text">Opsional. Tanpa background, hero memakai gradient hijau bawaan.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <h6 class="text-muted mt-4">3. Detail Tambahan <span class="fw-normal text-muted">(opsional)</span></h6>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Teks Kecil<br/><span class="text-muted fw-normal">(badge)</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="badge_text" value="{{ old('badge_text', @$detail->badge_text) }}" placeholder="eg. 3 Program Unggulan">
                        <small class="text-muted">Teks kecil dengan titik hijau berkedip, di atas judul.</small>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Sub Judul<br/><span class="text-muted fw-normal">(tagline)</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="tagline" value="{{ old('tagline', @$detail->tagline) }}" placeholder="eg. Bangun Peradaban, Berakhlak &amp; Berkarya">
                        <small class="text-muted">Teks berwarna hijau di bawah judul besar.</small>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Teks Informasi</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="info_text" rows="3" placeholder="eg. Informasi tambahan mengenai program ini...">{{ old('info_text', @$detail->info_text) }}</textarea>
                        <small class="text-muted">Teks informasi yang tampil di bawah nama program pada halaman Atur Urutan.</small>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Kartu Tambahan</label>
                    <div class="col-sm-9">
                        <small class="text-muted d-block mb-2">Kartu kecil dengan ikon, judul, dan deskripsi — misalnya untuk menampilkan 3 poin unggulan program. Kosongkan bila tidak perlu.</small>
                        <div id="info-items-wrapper">
                            @php
                                /* nama field pakai index eksplisit agar ikon/judul/deskripsi
                                   satu kartu tetap dalam satu grup array */
                                $existingItems = old('info_items', @($detail->info_items) ?: []);
                                /* data lama bisa berupa JSON string (double encode), dekode dulu */
                                if (is_string($existingItems)) {
                                    $existingItems = json_decode($existingItems, true) ?: [];
                                }
                                if (!is_array($existingItems)) {
                                    $existingItems = [];
                                }
                                $itemIndex = 0;
                            @endphp
                            @foreach($existingItems as $item)
                                <div class="info-item-row border rounded p-2 mb-2">
                                    <div class="row g-2">
                                        <div class="col-md-3">
                                            <select class="form-control form-select form-control-sm" name="info_items[{{ $itemIndex }}][icon]">
                                                @foreach($icons as $key => $class)
                                                    <option value="{{ $key }}" {{ ($item['icon'] ?? '') == $key ? 'selected' : '' }}>{{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control form-control-sm" name="info_items[{{ $itemIndex }}][title]" value="{{ $item['title'] ?? '' }}" placeholder="Judul kartu" required/>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control form-control-sm" name="info_items[{{ $itemIndex }}][desc]" value="{{ $item['desc'] ?? '' }}" placeholder="Deskripsi kartu"/>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item" title="Hapus"><i class="bi-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @php $itemIndex++; @endphp
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="btn-add-item"><i class="bi-plus-square"></i> Tambah Kartu</button>
                        <template id="info-item-template">
                            <div class="info-item-row border rounded p-2 mb-2">
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <select class="form-control form-select form-control-sm" name="info_items[__IDX__][icon]">
                                            @foreach($icons as $key => $class)
                                                <option value="{{ $key }}">{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control form-control-sm" name="info_items[__IDX__][title]" placeholder="Judul kartu" required/>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control form-control-sm" name="info_items[__IDX__][desc]" placeholder="Deskripsi kartu"/>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item" title="Hapus"><i class="bi-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <hr class="mt-4"/>
                <button type="submit" class="btn btn-success"><i class="bi-save"></i> Simpan Hero Landing</button>
                <a href="/admin/program/landing" class="btn btn-outline-secondary ms-2">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        /* preview gambar saat memilih file (pola sama dengan form slider) */
        $('#logoImg').change(function(){
            const file = this.files[0];
            if(file){
                $('#logo_image').attr('src', URL.createObjectURL(file));
            }
        });

        $('#bgImg').change(function(){
            const file = this.files[0];
            if(file){
                $('#background_image').attr('src', URL.createObjectURL(file));
            }
        });

        /* tambah / hapus baris kartu isi tambahan (index eksplisit agar grup kartu utuh) */
        window.infoItemIndex = {{ $itemIndex ?? 0 }};
        $('#btn-add-item').click(function(){
            const tpl = document.getElementById('info-item-template');
            $('#info-items-wrapper').append(tpl.innerHTML.replaceAll('__IDX__', window.infoItemIndex++));
        });

        $(document).on('click', '.btn-remove-item', function(){
            $(this).closest('.info-item-row').remove();
        });
    </script>
@endpush
