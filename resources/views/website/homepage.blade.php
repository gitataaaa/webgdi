@extends('layout.layout')

@section('title', $pageTitle)

@section('style')
<link rel="stylesheet" href="{{ asset('website/assets/css/custom.css') }}">
<style>
    .section-desc p{
        color: #fff;
        margin-bottom: 20px
    }
    .about-one__text > p{
        margin-bottom: 20px
    }

    /* Nonaktifkan sticky header agar tidak menimpa konten saat scroll */
    .stricky-header {
        display: none !important;
    }

    /* Jarak agar foto hero & kartu slider program turun dan tidak tertutup navbar.
       Pakai padding-top (bukan margin-top) agar margin tidak collapse menembus
       .page-wrapper yang memakai overflow:clip — margin collapse inilah yang
       membuat area putih kosong 100px di atas header. */
    .main-slider-two {
        margin-top: 0;
        padding-top: 100px;
    }

    /* Rapikan jarak section informasi/berita: padding bawaan template terlalu besar (120px/90px) */
    .news-one {
        padding: 45px 0 20px;
    }

    .news-one .section-title {
        margin-bottom: 35px;
    }
</style>
@endsection

@section('homeSlider')
<section class="main-slider-two clearfix">
    <div class="swiper-container thm-swiper__slider" data-swiper-options='{"slidesPerView": 1, "loop": true,
        "effect": "fade",
        "pagination": {
        "el": "#main-slider-pagination",
        "type": "bullets",
        "clickable": true
        },
        "navigation": {
        "nextEl": "#main-slider__swiper-button-next",
        "prevEl": "#main-slider__swiper-button-prev"
        },
        "autoplay": {
        "delay": 5000
        }}'>
        <div class="swiper-wrapper">
            @if(@$slider)
                @foreach($slider as $dt)
                    <div class="swiper-slide">
                    @php
                        $url = preg_replace('/\\\\/', '/', $dt->image_upload);
                    @endphp
                        <div class="image-layer-two"
                            
                         style="background-image: url('{{ $url }}');"></div>
                        <!-- /.image-layer -->

                        <div class="main-slider-two__shape-1">
                            <img src="{{ asset('website/assets/images/shapes/main-slider-two-shape-1.png') }}" alt="">
                        </div>
                        <div class="main-slider-two__shape-2">
                            <img src="{{ asset('website/assets/images/shapes/main-slider-two-shape-2.png') }}" alt="">
                        </div>
                        <div class="main-slider-two__shape-3">
                            <img src="{{ asset('website/assets/images/shapes/main-slider-two-shape-3.png') }}" alt="">
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="main-slider-two__content">
                                        <p class="main-slider-two__sub-title">{{ $dt->subtitle }}</p>
                                        <h2 class="main-slider-two__title">{{ $dt->title }}
                                        </h2>
                                        @php
                                            $btn = json_decode($dt->button);
                                        @endphp
                                        @if($btn)
                                        <div class="main-slider-two__btn-box">
                                            <a href="{{ $btn[0]->url }}" class="thm-btn main-slider-two__btn">{{ $btn[0]->text }}</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif



        </div>

        <!-- If we need navigation buttons -->
        <div class="main-slider-two__nav">
            <div class="swiper-button-prev" id="main-slider__swiper-button-next">
                <i class="icon-right-arrow"></i>
            </div>
            <div class="swiper-button-next" id="main-slider__swiper-button-prev">
                <i class="icon-right-arrow"></i>
            </div>
        </div>

    </div>
</section>
@endsection

@section('homeProgram')
<!--
<section class="project-two">
    <div class="project-two-shape-1 float-bob-x">
        <img src="{{ asset('website/assets/images/shapes/project-two-shape-1.png') }}" alt="">
    </div>
    <div class="container">
        <div class="section-title text-center">
            <span class="section-title__tagline">Program Yayasan</span>
            <h2 class="section-title__title">Telusuri program donasi</h2>
        </div>
        @if(@$program)
        <div class="row">
            @php
                $no = 0;
            @endphp
            @foreach($program as $pg)
            @php
                $no += 100;
                $percentage = ($pg->donasi / $pg->target_nominal) * 100;
                $days = Helper::totalDays($pg->date_end);
            @endphp
            <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="{{ $no.'ms'}}">
                <div class="project-one__single">
                    <div class="project-one__img-box">
                        <div class="project-one__img">
                            <img src="{{ asset($pg->image_upload) }}" alt="">
                        </div>
                        <div class="project-one__icon">
                            <i class="far fa-heart"></i>
                        </div>
                    </div>
                    <div class="project-one__content">
                        <div class="project-one__tag">
                            <p>{{ $pg->category }}</p>
                        </div>
                        <h3 class="project-one__title" style="height: 70px"><a href="/program/donasi/{{ $pg->slug }}">{{ $pg->title }}</a></h3>
                        <div class="project-one__remaing">
                            <div class="icon">
                                <i class="fa fa-clock"></i>
                            </div>
                            <div class="text">
                                <p>{{ $days >= 0 ? $days.' Hari Lagi' : 'Program Berakhir' }}</p>
                            </div>
                        </div>
                        <div class="progress-levels">
                            <div class="progress-box">
                                <div class="inner count-box">
                                    <div class="text">Target</div>
                                    <div class="bar">
                                        <div class="bar-innner">
                                            <div class="skill-percent">
                                                <span class="count-text" data-speed="3000"
                                                    data-stop="{{ $percentage }}">0</span>
                                                <span class="percent">%</span>
                                            </div>
                                            <div class="bar-fill" data-percent="{{ $percentage }}"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="project-one__goals">
                            <p class="project-one__goals-one" style="text-align: left">Terkumpul:<br/><span>Rp. {{ number_format($pg->donasi) }}</span></p>
                            <p class="project-one__goals-one" style="text-align: right">Target Pencapaian:<br/><span>Rp. {{ number_format($pg->target_nominal) }}</span></p>
                        </div>
                        <br/>
                        <a href="/program/donasi/{{ $pg->slug }}" class="thm-btn">Donasi Sekarang</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
-->
@include('website.partials.slider-pilar')

    


<section class="program-yayasan">
  <div class="container">
    <!-- Judul -->
    <div class="program-yayasan__title text-center">
      <p class="subtitle">PROGRAM YAYASAN</p>
      <h2>Telusuri Program Graha Dhuafa Indonesia</h2>
    </div>

    <!-- Isi Program -->
    <div class="row justify-content-center">
      <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
        <div class="program-card" onclick="link('/budaya')">
          <img src="{{ asset('website/assets/images/custom/budaya.png') }}" alt="Budaya"/>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
        <div class="program-card" onclick="link('/senyum')">
          <img src="{{ asset('website/assets/images/custom/senyum.png') }}" alt="Senyum"/>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
        <div class="program-card" onclick="link('/cinta')">
          <img src="{{ asset('website/assets/images/custom/cinta.png') }}" alt="Cinta"/>
        </div>
      </div>
    </div>
  </div>
</section>
<style>
.program-yayasan {
  padding: 60px 0;
  text-align: center;
}

.program-yayasan__title .subtitle {
  color: #ff6600; /* warna oranye mirip di ss */
  font-weight: bold;
  margin-bottom: 5px;
}

.program-yayasan__title h2 {
  font-size: 28px;
  font-weight: 700;
  color: #1a8b4c; /* hijau utama */
  margin-bottom: 40px;
}

.program-card {
  cursor: pointer;
  transition: transform 0.3s ease;
}

.program-card img {
  width: 80%;         /* biar gak full 100% dan lebih proporsional */
  max-width: 280px;   /* batas maksimal biar gak terlalu gede */
  margin: auto;
  display: block;
}

.program-card:hover {
  transform: scale(1.05);
}
</style>



@include('website.partials.program-unggulan')

<section class="faq-one">
    <div class="faq-one-bg" style="background-image: url('website/assets/images/backgrounds/faq-one-bg.png')"></div>
    <div class="container">
        <div class="section-title text-center">
            <span class="section-title__tagline">Peta Sebaran</span>
            <h2 class="section-title__title">Program Graha Dhuafa</h2>
        </div>
        <div class="row">
            <div class="col-12">
                <img src="{{ asset('website/assets/images/custom/peta_sebaran.svg') }}" width="100%"/>

                <div class="mt-5 text-center">
                    <p>Wilayah Sebaran Manfaat Graha Dhuafa Indonesia</p>
                    <h4>Jakarta, Jawa Barat, Jawa Tengah, Jawa Timur, NTB, NTT,<br/>Sulawesi Barat, Sumatra Barat, Bali, Kalimantan Selatan</h4>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section: Berdampak Lebih Luas (statistik donasi + peta oranye) --}}
@include('website.partials.peta-dampak')

@include('website.partials.timeline')

@endsection

@section('homeBlog')
<section class="news-one news-two">
    <div class="container">
        <div class="section-title text-center">
            <span class="section-title__tagline">Informasi Yayasan</span>
            <h2 class="section-title__title">Ikuti perkembangan informasi terkait<br/>program dan donasi</h2>
        </div>
        @if(@$blog)
        <div class="row">
            @php 
                $no = 0;
            @endphp
            @foreach($blog as $dt)
            @php 
                $no += 100;
                $tanggal = Helper::dateFormat(date('Y-m-d', strtotime($dt->date_publish)));
            @endphp
            <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="{{ $no.'ms'}}">
                <!--News One Single Start-->
                <div class="news-one__single">
                    <div class="news-one__img-box">
                        <div class="news-one__img">
                            <img src="{{ asset($dt->featured_img) }}" alt="" style="width: 100%; height: 250px; object-fit: cover">
                            <a href="/blog/{{ $dt->slug }}">
                                <span class="news-one__plus"></span>
                            </a>
                        </div>
                        <!--
                        <div class="news-one__date">
                            <p>28</p>
                            <span>july</span>
                        </div>
                        -->
                    </div>
                    <div class="news-one__content">
                        <ul class="news-one__meta list-unstyled">
                            <li>
                                <a href="/"><i class="fas fa-user-circle"></i>by {{ $dt->author }}</a>
                            </li>
                            <li>
                                <a href="/"><i class="fas fa-clock"></i>{{ $tanggal }}</a>
                            </li>
                        </ul>
                        <h3 class="news-one__title"><a href="/blog/{{ $dt->slug }}">{{ $dt->title }}</a></h3>
                        <p>{{ $dt->kategori }}</p>
                        <div class="news-one__bottom">
                            <div class="news-one__button">
                                <a href="/blog/{{ $dt->slug }}">Read more</a>
                            </div>
                            <div class="news-one__arrow">
                                <a href="/blog/{{ $dt->slug }}"><span class="icon-right-arrow"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--News One Single Start-->
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- Section Berita Baru --}}
@include('website.partials.berita')
@endsection








@section('homeAds')
@if(@$ads)
@php
    $btn = json_decode(@$ads->button);
    $image = preg_replace('/\\\\/', '/', @$ads->image_upload);
@endphp
<section class="ready-one">
    <div class="container">
        <div class="ready-one__inner" <?= @$ads->image_upload ? 'style="background-image: url('. $image .'); background-size: cover"' : '' ?>>
            <div class="ready-one-shape-1 float-bob-x">
                <img src="{{ asset('website/assets/images/shapes/ready-one-shape-1.png') }}" alt="">
            </div>
            <div class="ready-one__big-icon float-bob-y-2">
                <span class="icon-fundraiser"></span>
            </div>
            <div class="ready-one__left">
                <div class="icon">
                    <span class="icon-fundraiser"></span>
                </div>
                <div class="content">
                    <p>{{ @$ads->title }}</p>
                    <h3>{{ @$ads->subtitle }}</h3>
                </div>
            </div>
            @if($btn)
            <div class="ready-one__right">
                <a href="{{ @$btn[0]->url }}" class="thm-btn ready-one__btn">{{ @$btn[0]->text }}</a>
            </div>
            @endif
        </div>
    </div>
</section>
@endif
@endsection

@section('homeInfo')
@if(@$info)
@php
    $btn2 = json_decode(@$info->button);
    $imageGen = preg_replace('/\\\\/', '/', @$info->image_upload);
@endphp
<section class="every-step">
    <div class="every-step__wrap">
        <div class="every-step__left" style="min-height: 693px">
            <div class="every-step-shape-1 float-bob-x">
                <img src="{{ asset('website/assets/images/shapes/every-step-shape-1.png') }}" alt="">
            </div>
            <div class="every-step__content">
                <div class="section-title text-left">
                    <span class="section-title__tagline">{{ @$info->subtitle }}</span>
                    <h2 class="section-title__title">{{ @$info->title}}</h2>
                </div>
                
                <div class="section-desc">
                    {!! @$info->description !!}
                </div>

                @if($btn2)
                <div>
                    <a href="{{ @$btn2[0]->url }}" class="thm-btn ready-one__btn">{{ @$btn2[0]->text }}</a>
                </div>    
                @endif
            </div>
        </div>
        <div class="every-step__right">
            <div class="every-step__bg"
                style="background-image: url({{$imageGen}});">
            </div>
        </div>
    </div>
</section>
@endif
@endsection

@section('homeAbout')
@if(@$about)
@php
    $imageArr = json_decode($about->image_upload);
    $imgAbout1 = '';
    $imgAbout2 = '';
    if($imageArr){
        foreach($imageArr as $dt){
            if($dt->id == '1'){
                $imgAbout1 = preg_replace('/\\\\/', '/', $dt->path);
            }else{
                $imgAbout2 = preg_replace('/\\\\/', '/', $dt->path);
            }
        }
    }
@endphp
<section class="about-one">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="about-one__left">
                    <div class="about-one__img-box wow slideInLeft" data-wow-delay="100ms"
                        data-wow-duration="2500ms">
                        <div class="about-one__img-1">
                            <img src="{{ asset($imgAbout1) }}" alt="" style="width: 100%; height: 500px; object-fit: cover">
                        </div>
                        <div class="about-one__img-2">
                            <img src="{{ asset($imgAbout2) }}" alt="" style="width: 50%; float:right">
                        </div>
                        <!--
                        <div class="about-one__experience">
                            <div class="about-one__experience-inner">
                                <h3>30</h3>
                                <p>Years of <br> Experience</p>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="about-one__right">
                    <div class="section-title text-left">
                        <span class="section-title__tagline">Selayang Pandang</span>
                        <h2 class="section-title__title">{{ @$about->title }}</h2>
                    </div>
                    <div class="about-one__text">
                        {!! @$about->description !!}
                    </div>
                    <!--
                    <div class="about-one__person">
                        <div class="about-one__person-img">
                            <img src="{{ asset('website/assets/images/resources/about-1-3.jpg') }}" alt="">
                        </div>
                        <div class="about-one__person-content">
                            <p class="about-one__person-name">Kevin Martin</p>
                            <p class="about-one__person-foundation">CEO Foundation</p>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<script>
    function link(link){
        window.location.href = link
    }
</script>

@endsection

