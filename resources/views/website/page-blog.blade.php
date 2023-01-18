@extends('layout.layout-page')
@section('title', $pageTitle)

@section('breadcrumb')
<ul class="thm-breadcrumb list-unstyled">
    <li><a href="/">Beranda</a></li>
    @if(@$parent)
    <li><span>/</span></li>
    <li><a href="/">{{ @$parent }}</a></li>
    @endif
    <li><span>/</span></li>
    <li>{{ @$detail->title ? @$detail->title : $pageTitle }}</li>
</ul>
<h2>{{ @$detail->title ? @$detail->title : $pageTitle }}</h2>
@endsection

@section('pageBlog')
<section class="news-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="blog-sidebar__left">
                    <div class="news-sidebar__content">
                        @if(@$blog)
                            @foreach($blog as $dt)
                                @php
                                    $date = App\Helper::dateFormat(date('Y-m-d', strtotime($dt->date_publish)));
                                    $slug = '/blog/'.$dt->slug;
                                @endphp
                                <div class="news-sidebar__single">
                                    <div class="news-sidebar__img">
                                        <img src="{{ asset($dt->featured_img) }}" alt="">
                                        <!--
                                        <div class="news-sidebar__date">
                                            <p>28</p>
                                            <span>july</span>
                                        </div>-->
                                    </div>
                                    <div class="news-sidebar__content-box">
                                        <ul class="list-unstyled news-sidebar__meta">
                                            <li><a href="/"><i class="fas fa-user-circle"></i>by
                                                    {{ $dt->author }}</a>
                                            </li>
                                            <li><a href="news-details.html"><i class="fas fa-clock"></i>{{ $date }}</a>
                                            </li>
                                        </ul>
                                        <h3 class="news-sidebar__title">
                                            <a href="{{ $slug }}">{{ $dt->title }}</a>
                                        </h3>
                                        <p class="news-sidebar__text" data-id="{{ $dt->id }}">
                                            @php
                                                $text = strip_tags($dt->content);
                                                echo substr($text, 0, 150).'...';
                                            @endphp
                                        </p>
                                        <div class="news-sidebar__bottom">
                                            <a href="{{ $slug }}" class="news-sidebar__read-more">Read More</a>
                                            <a href="{{ $slug }}" class="news-sidebar__arrow"><span
                                                    class="icon-right-arrow"></span></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-warning" style="border-radius: 0px">Kategori tidak ditemukan</div>
                        @endif
                    </div>
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
                        @php
                            $latestBlog = @$blogLatest ? @$blogLatest : @$blog;
                        @endphp
                        @if(@$latestBlog)
                        <ul class="sidebar__post-list list-unstyled">
                            @php
                                $no = 1;
                            @endphp
                            @foreach($latestBlog as $dt)
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
                            <li class="{{ @$categoryKey == 'Uncategorized' ? 'active' : ''}}"><a href="/blog/category/Uncategorized">Uncategorized<span
                                        class="icon-right-arrow"></span></a>
                            @foreach($category as $cat)
                            <li class="{{ @$categoryKey == $cat->kategori ? 'active' : ''}}"><a href="/blog/category/{{ $cat->kategori }}">{{ $cat->kategori }}<span
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