<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Neiber Cardenas" />
  <meta name="description" content="{{config('app.name')}}" />
  <meta name="keywords" content="Store">

  <title>{{config('app.name')}}</title>

  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">

  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/flaticon.css') }}" rel="stylesheet">
  <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
  <link id="effect" href="{{ asset('css/dropdown-effects/fade-down.css') }}" media="all" rel="stylesheet">
  <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">
  <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
</head>

<body>
  <div id="loading" class="skyblue-loading">
    <div id="loading-center">
      <div id="loading-center-absolute">
        <div class="object" id="object_one"></div>
        <div class="object" id="object_two"></div>
        <div class="object" id="object_three"></div>
        <div class="object" id="object_four"></div>
      </div>
    </div>
  </div>
  <div id="page" class="page">
    <header id="header" class="header white-menu navbar-dark">
      <div class="header-wrapper">
        <div class="wsmobileheader clearfix">
          <span class="smllogo"><img src="{{ asset('images/store.png') }}" alt="mobile-logo" /></span>
          <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
        </div>
        <div class="wsmainfull menu clearfix">
          <div class="wsmainwp clearfix">
            <div class="desktoplogo"><a href="{{ url('/') }}" class="logo-black"><img src="{{ asset('images/store.png') }}" alt="header-logo"></a></div>
            <div class="desktoplogo"><a href="{{ url('/') }}" class="logo-white"><img src="{{ asset('images/store.png') }}" alt="header-logo"></a></div>
            <nav class="wsmenu clearfix">
              <ul class="wsmenu-list nav-skyblue-hover">
                <li class="nl-simple" aria-haspopup="true"><a href="{{ url('/orders') }}">Mis órdenes</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </header>
    @yield('content')
    <footer id="footer-1" class="footer division">
      <div class="container">
        <div class="bottom-footer">
          <div class="row row-cols-1 row-cols-md-2 d-flex align-items-center">
          </div>
        </div>
      </div>
    </footer>
  </div>
  <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/modernizr.custom.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.js') }}"></script>
  <script src="{{ asset('js/jquery.appear.js') }}"></script>
  <script src="{{ asset('js/jquery.scrollto.js') }}"></script>
  <script src="{{ asset('js/menu.js') }}"></script>
  <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('js/quick-form.js') }}"></script>
  <script src="{{ asset('js/request-form.js') }}"></script>
  <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
  <script src="{{ asset('js/wow.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}" defer></script>
</body>

</html>