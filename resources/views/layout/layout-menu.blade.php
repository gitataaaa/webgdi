<a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
<ul class="main-menu__list">
    @php 
        $menu = Helper::displayMenu();
    @endphp

    @if($menu)
        @foreach($menu as $dt)
            @php
                $menuActive = 'menu'.$dt['id'];
            @endphp
            @if($dt['submenu'])
                <li class="dropdown {{ @$$menuActive }}">
                    <a href="#">{{ $dt['title'] }}</a>
                    <ul class="shadow-box">
                        @foreach($dt['submenu'] as $c)
                            <li><a href="/{{ $c['url'] }}">{{ $c['title'] }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="{{ @$$menuActive }}"><a href="/{{ $dt['url'] }}">{{ $dt['title'] }}</a></li>
            @endif
        @endforeach
    @endif

    <li class="button">
        <button type="button" class="thm-btn" style="border: none" onclick="zakat()">Zakat Sekarang</button>
    </li>
</ul>

<script>
    function zakat(){
        window.location.href = '/app/zakat';
    }
</script>