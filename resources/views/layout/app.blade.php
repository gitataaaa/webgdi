<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('admin/assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/plugins/metismenu/metisMenu.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/plugins/scss/custom.css') }}" rel="stylesheet"/>

    <title>@yield('title')</title>
  </head>
  <body>
    <div class="loader">
        <div class="spin">Loading
            <div class="blink blink1">.</div>
            <div class="blink blink2">.</div>
            <div class="blink blink3">.</div>
        </div>
    </div>

    <header class="cs-header">
      <div class="cs-toggle" data-open="false" ><i class="bi-list"></i></div>
      <div class="cs-title">CMS</div>
    </header>

    <div class="cs-left-bar" id="slide">
      <nav>
        @include('layout.app-menu', $active)
      </nav>
    </div>

    <div class="cs-right-content">
      <div class="container">
        <!-- breadcrumbs -->
        <nav aria-label="breadcrumb">
          @yield('breadcrumb')
        </nav>

        <div class="cs-segment">
          @yield('content')
          
        </div>
      </div>
      
    </div>

    <script src="{{ asset('admin/assets/plugins/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- datatable -->
    <script src="{{ asset('admin/assets/plugins/datatable/datatables.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/metismenu/metismenu.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>
    
    @stack('scripts')

  </body>
</html>