<?php

/* Terjemahan pesan validasi ke Bahasa Indonesia (hanya baris yang dipakai CMS ini).
   Format & frasa mengikuti sumber resmi: github.com/caouecs/Laravel-lang */

return [

    /* pesan validasi umum */
    'accepted'        => ':attribute harus diterima.',
    'active_url'      => ':attribute bukan URL yang valid.',
    'after'           => ':attribute harus ber tanggal setelah :date.',
    'alpha'           => ':attribute hanya boleh berisi huruf.',
    'alpha_dash'      => ':attribute hanya boleh berisi huruf, angka, strip, dan garis bawah.',
    'alpha_num'       => ':attribute hanya boleh berisi huruf dan angka.',
    'array'           => ':attribute harus berupa array.',
    'between'         => [
        'numeric' => ':attribute harus di antara :min - :max.',
        'file'    => ':attribute harus di antara :min - :max kilobita.',
        'string'  => ':attribute harus di antara :min - :max karakter.',
        'array'   => ':attribute harus memiliki :min - :max item.',
    ],
    'boolean'         => ':attribute harus true atau false',
    'confirmed'       => 'Konfirmasi :attribute tidak cocok.',
    'date'            => ':attribute bukan tanggal yang valid.',
    'different'       => ':attribute dan :other harus berbeda.',
    'digits'          => ':attribute harus terdiri dari :digits angka.',
    'digits_between'  => ':attribute harus terdiri dari :min hingga :max angka.',
    'email'           => ':attribute bukan alamat email yang valid.',
    'exists'          => ':attribute yang dipilih tidak valid.',
    'image'           => ':attribute harus berupa gambar.',
    'in'              => ':attribute yang dipilih tidak valid.',
    'integer'         => ':attribute harus berupa angka.',
    'ip'              => ':attribute harus berupa alamat IP yang valid.',
    'max'             => [
        'numeric' => ':attribute maksimal :max.',
        'file'    => ':attribute maksimal :max kilobita.',
        'string'  => ':attribute maksimal :max karakter.',
        'array'   => ':attribute maksimal :max item.',
    ],
    'mimes'           => ':attribute harus berjenis berkas: :values.',
    'min'             => [
        'numeric' => ':attribute minimal :min.',
        'file'    => ':attribute minimal :min kilobita.',
        'string'  => ':attribute minimal :min karakter.',
        'array'   => ':attribute minimal :min item.',
    ],
    'not_in'          => ':attribute yang dipilih tidak valid.',
    'numeric'         => ':attribute harus berupa angka.',
    'required'        => ':attribute wajib diisi.',
    'required_if'     => ':attribute wajib diisi apabila :other adalah :value.',
    'same'            => ':attribute dan :other harus sama.',
    'size'            => [
        'numeric' => ':attribute harus berukuran :size.',
        'file'    => ':attribute harus berukuran :size kilobita.',
        'string'  => ':attribute harus berukuran :size karakter.',
        'array'   => ':attribute harus memuat :size item.',
    ],
    'string'          => ':attribute harus berupa string.',
    'timezone'        => ':attribute harus berupa zona waktu yang valid.',
    'unique'          => ':attribute sudah digunakan. Silakan pilih yang lain.',
    'uploaded'        => ':attribute gagal diunggah.',

    /* nama field yang enak dibaca admin */
    'attributes' => [
        'slug'             => 'Halaman',
        'badge_text'       => 'Teks Kecil (badge)',
        'title'            => 'Judul',
        'tagline'          => 'Sub Judul (tagline)',
        'description'      => 'Deskripsi',
        'info_text'        => 'Teks Informasi',
        'status'           => 'Status',
        'logo_image'       => 'Logo',
        'background_image' => 'Background',
        'url_program'      => 'URL Program',
        'nama_program'     => 'Nama Program',
    ],

];
