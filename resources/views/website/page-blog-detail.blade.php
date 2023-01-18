@extends('layout.layout-page')
@section('title', $pageTitle)

@section('style')
<style>
    .news-details__text p{
        margin-bottom: 40px;
    }
</style>
@endsection

@section('breadcrumb')
<ul class="thm-breadcrumb list-unstyled">
    <li><a href="/">Beranda</a></li>
    @if(@$parent)
    <li><span>/</span></li>
    <li><a href="/">{{ @$parent }}</a></li>
    @endif
</ul>
<h2>{{ @$detail->title ? @$detail->title : $pageTitle }}</h2>
@endsection

@section('pageBlog')
<section class="news-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="news-details__left">
                    <div class="news-details__img">
                        <img src="{{ asset(@$detail->featured_img) }}" alt="">
                        <!--
                        <div class="news-details__date">
                            <p>28</p>
                            <span>july</span>
                        </div>-->
                        @php
                            $date = App\Helper::dateFormat(date('Y-m-d', strtotime(@$detail->date_publish)));
                        @endphp
                    </div>
                    <div class="news-details__content">
                        <ul class="list-unstyled news-details__meta">
                            <li><a href="/blog/{{ @$detail->slug }}"><i class="fas fa-user-circle"></i> by {{ @$detail->author }}</a>
                            </li>
                            <li><a href="/blog/{{ @$detail->slug }}"><i class="fas fa-clock"></i> {{ $date }}</a>
                            </li>
                        </ul>
                        <h3 class="news-details__title">{{ @$detail->title }}</h3>
                        <div class="news-details__text">{!! @$detail->content !!}</div>
                    </div>
                    <!--
                    <div class="news-details__bottom">
                        <p class="news-details__tags">
                            <span>Tags</span>
                            <a href="#">Crowdfunding</a>
                            <a href="#">Technology</a>
                        </p>
                        <div class="news-details__social-list">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-pinterest-p"></i></a>
                        </div>
                    </div>-->
                    
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="sidebar">
                    <div class="sidebar__single sidebar__search">
                        <form action="#" class="sidebar__search-form">
                            <input type="search" placeholder="Search here">
                            <button type="submit"><i class="icon-magnifying-glass"></i></button>
                        </form>
                    </div>
                    <div class="sidebar__single sidebar__post">
                        <h3 class="sidebar__title">Latest Posts</h3>
                        @if(@$blog)
                        <ul class="sidebar__post-list list-unstyled">
                            @php
                                $no = 1;
                            @endphp
                            @foreach($blog as $dt)
                            @php
                                $tanggal = App\Helper::dateFormat(date('Y-m-d', strtotime($dt->date_publish)));
                            @endphp
                            <li>
                                <div class="sidebar__post-image">
                                    <img src="{{ asset($dt->featured_img) }}" alt="">
                                </div>
                                <div class="sidebar__post-content">
                                    <h3>
                                        <span class="sidebar__post-content-meta"><i class="fas fa-clock"></i>{{ $tanggal }}</span>
                                        <a href="/blog/{{ $dt->slug }}">{{ $dt->title }}</a>
                                    </h3>
                                </div>
                            </li>
                            @php
                                $no += 1;
                                if($no == 3){
                                    break;
                                }
                            @endphp
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    <div class="sidebar__single sidebar__category">
                        <h3 class="sidebar__title">Kategori</h3>
                        @if(@$category)
                        <ul class="sidebar__category-list list-unstyled">
                            <li><a href="/blog/category/Uncategorized">Uncategorized<span
                                        class="icon-right-arrow"></span></a>
                            </li>
                            @foreach($category as $cat)
                            <li><a href="/blog/category/{{ $cat->kategori }}">{{ $cat->kategori }}<span
                                        class="icon-right-arrow"></span></a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    $(document).ready(function(){
        $('.news-sidebar__text').next().text();
    })
</script>
@endpush