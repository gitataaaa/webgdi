<div class="mobile-nav__overlay mobile-nav__toggler"></div>
    <!-- /.mobile-nav__overlay -->
    @php
        $contact = App\Helper::displayContact();
    @endphp
    <div class="mobile-nav__content">
        <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

        <div class="logo-box">
            <a href="index.html" aria-label="logo image"><img src="{{ asset('website/assets/images/custom/logo_gdi_long.png') }}" width="143"
                    alt="" /></a>
        </div>
        <!-- /.logo-box -->
        <div class="mobile-nav__container"></div>
        <!-- /.mobile-nav__container -->

        <ul class="mobile-nav__contact list-unstyled">
            <li>
                <i class="fa fa-envelope"></i>
                <a href="mailto:{{ $contact['inst_email'] }}">{{ $contact['inst_email'] }}</a>
            </li>
            <li>
                <i class="fa fa-phone-alt"></i>
                <a href="tel:{{ $contact['inst_telp'] }}">{{ $contact['inst_telp'] }}</a>
            </li>
        </ul><!-- /.mobile-nav__contact -->
        @php
            $socialMedia = App\Helper::displaySocialMedia();
        @endphp
        @if($socialMedia)
        <div class="mobile-nav__top">
            <div class="mobile-nav__social">

            @foreach($socialMedia as $dt)
                <a href="{{ $dt->url }}"><i class="{{ $dt->classname }}"></i></a>
            @endforeach
            </div>
        </div>
        @endif

    </div>
    <!-- /.mobile-nav__content -->