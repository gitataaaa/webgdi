@php
    /* halaman yang sedang dibuka, dipakai agar Ganti Program tetap di section yang sama */
    $currentPageUrl = '/admin/program/dokumentasi';
    if ($activeTab === 'statistik') {
        $currentPageUrl = '/admin/program/statistik';
    } elseif ($activeTab === 'faq') {
        $currentPageUrl = '/admin/program/faq';
    } elseif ($activeTab === 'manfaat') {
        $currentPageUrl = '/admin/program/manfaat';
    } elseif ($activeTab === 'galeri') {
        $currentPageUrl = '/admin/program/galeri';
    }

    $dokumentasiLabel = $dokumentasiLabel ?? null;
@endphp

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <div>
        <h5 class="mb-0">{{ $heading }}</h5>
        <small class="text-muted">
            Program {{ $programLabel }}
            @if($dokumentasiLabel)
                &middot; Kegiatan: {{ $dokumentasiLabel }}
            @endif
        </small>
    </div>

    {{-- pindah program tanpa kehilangan section yang sedang dibuka --}}
    <div class="dropdown">
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi-arrow-left-right"></i> Ganti Program
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            @foreach($programs as $slug => $label)
                <li>
                    <a class="dropdown-item {{ $slug === $programSlug ? 'active' : '' }}"
                       href="{{ $currentPageUrl }}?program={{ urlencode($slug) }}">
                        {{ $label }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
