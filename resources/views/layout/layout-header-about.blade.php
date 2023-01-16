<div class="main-header-two__top">
    <div class="main-header-two__top-inner">
        <div class="main-header-two__top-left">
            @php
                $contact = App\Helper::displayContact();
            @endphp
            <ul class="list-unstyled main-header-two__contact-list">
                @if($contact['inst_addr'])
                <li>
                    <div class="icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="text">
                        <p>{{$contact['inst_addr']}}</p>
                    </div>
                </li>
                @endif

                @if($contact['inst_email'])
                <li>
                    <div class="icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="text">
                        <p><a href="mailto:{{ $contact['inst_email'] }}">{{ $contact['inst_email'] }}</a></p>
                    </div>
                </li>
                @endif
            </ul>
        </div>
        <div class="main-header-two__top-right">
            @php
                $socialMedia = App\Helper::displaySocialMedia();
            @endphp

            @if($socialMedia)
            <div class="main-header-two__social">
                @foreach($socialMedia as $sm)
                    <a href="{{ $sm->url }}"><i class="{{ $sm->classname }}"></i></a>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
<nav class="main-menu main-menu-two">
    <div class="main-menu-two__wrapper">
        <div class="main-menu-two__wrapper-inner">
            <div class="main-menu-two__left">
                <div class="main-menu-two__logo">
                    <a href="index.html"><img src="{{ asset('website/assets/images/custom/logo_gdi_long.png') }}" alt=""></a>
                </div>
            </div>
            <div class="main-menu-two__main-menu-box">
                @include('layout.layout-menu');
            </div>
            <div class="main-menu-two__right">
                <!--
                <div class="main-menu-two__search-btn-box">
                    <div class="main-menu-two__search-box">
                        <a href="#" class="main-menu-two__search search-toggler icon-magnifying-glass"></a>
                    </div>
                    <div class="main-menu-two__btn-box">
                        <a href="project-details.html" class="thm-btn main-menu-two__btn"><i
                                class="icon-plus-symbol"></i>Add a Project</a>
                    </div>
                </div>
                -->
            </div>
        </div>
    </div>
</nav>