@foreach($program as $item)
  <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
    <div class="project-one__single">
      <div class="project-one__img-box">
        <div class="project-one__img">
          <img src="{{ asset('uploads/programlaz/' . $item->image_upload) }}" alt="{{ $item->nama_program }}">
        </div>
      </div>
      <div class="project-one__content">
        <div class="project-one__tag">
          <p>{{ $item->category ?? 'Program' }}</p>
        </div>
        <h3 class="project-one__title" style="height: 70px">
          <a href="/program/{{ $item->slug }}">{{ $item->nama_program }}</a>
        </h3>
        <p class="text-muted small">{{ Str::limit($item->description, 80) }}</p>
        <a href="/program/{{ $item->slug }}" class="thm-btn mt-3">Lihat Detail</a>
      </div>
    </div>
  </div>
@endforeach
