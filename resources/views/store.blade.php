<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Neiber Cardenas" />
  <meta name="description" content="{{config('app.name')}}" />
  <meta name="keywords" content="Store">

  <title>{{config('app.name')}}</title>

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/flaticon.css" rel="stylesheet">
  <link href="css/menu.css" rel="stylesheet">
  <link id="effect" href="css/dropdown-effects/fade-down.css" media="all" rel="stylesheet">
  <link href="css/magnific-popup.css" rel="stylesheet">
  <link href="css/owl.carousel.min.css" rel="stylesheet">
  <link href="css/owl.theme.default.min.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
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
          <span class="smllogo"><img src="images/store.png" alt="mobile-logo" /></span>
          <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
        </div>
        <div class="wsmainfull menu clearfix">
          <div class="wsmainwp clearfix">
            <div class="desktoplogo"><a href="demo-1.html" class="logo-black"><img src="images/store.png" alt="header-logo"></a></div>
            <div class="desktoplogo"><a href="demo-1.html" class="logo-white"><img src="images/logo-white.png" alt="header-logo"></a></div>
            <nav class="wsmenu clearfix">
              <ul class="wsmenu-list nav-skyblue-hover">
                <li class="nl-simple" aria-haspopup="true"><a href="https://www.linkedin.com/in/rebienkrdns/">Linkedin</a></li>
                <li class="nl-simple" aria-haspopup="true"><a href="https://github.com/rebienkrdns">Github</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </header>

    <section id="pricing-2" class="bg-snow pb-60 inner-page-hero pricing-section division">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10 col-xl-8">
            <div class="section-title title-01 mb-40">
              <h2 class="h2-md">{{config('app.name')}}</h2>
            </div>
          </div>
        </div>
        <div class="pricing-2-row pc-25">
          <div class="row row-cols-1 row-cols-md-3">
            <div class="col-md-4 offset-md-4">
              <div class="pricing-2-table bg-white mb-40 wow fadeInUp">
                <div class="pricing-plan">
                  <div class="row">
                    <div class="col">
                      <img src="images/pc.png" class="img-fluid">
                    </div>
                  </div>
                  <div class="pricing-plan-title">
                    <h5 class="h5-xs">PC</h5>
                    <h6 class="h6-sm bg-lightgrey">Save 30%</h6>
                  </div>
                  <sup class="dark-color">$</sup>
                  <span class="dark-color">2</span>
                  <sup class="validity dark-color"><span>.000.000</span></sup>
                </div>
                <button type="button" class="btn btn-sm btn-tra-grey tra-skyblue-hover" data-bs-toggle="modal" data-bs-target="#client">Comprar</button>
              </div>
            </div>
            <div class="toast-container position-static">
              @if ($errors->any())
              @foreach ($errors->all() as $error)
              <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                  <strong class="me-auto">Información incorrecta</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">{{ $error }}</div>
              </div>
              @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
    <div id="client" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <form method="post" id="client-form">
          @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Ingrese sus datos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input class="form-control" type="text" id="name" name="name" required placeholder="Nombre" value="Neiber">
              </div>
              <div class="mb-3">
                <label for="name" class="form-label">Correo electrónico</label>
                <input class="form-control" type="email" id="email" name="email" required placeholder="Correo electrónico" value="neiber@neiber.com">
              </div>
              <div class="mb-3">
                <label for="name" class="form-label"># de celular</label>
                <input class="form-control" type="phone" id="phone" name="phone" required placeholder="# de celular" value="123123123">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <footer id="footer-1" class="footer division">
      <div class="container">
        <div class="bottom-footer">
          <div class="row row-cols-1 row-cols-md-2 d-flex align-items-center">
          </div>
        </div>
      </div>
    </footer>
  </div>
  <script src="js/jquery-3.6.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/modernizr.custom.js"></script>
  <script src="js/jquery.easing.js"></script>
  <script src="js/jquery.appear.js"></script>
  <script src="js/jquery.scrollto.js"></script>
  <script src="js/menu.js"></script>
  <script src="js/imagesloaded.pkgd.min.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/quick-form.js"></script>
  <script src="js/request-form.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/wow.js"></script>
  <script src="js/custom.js" defer></script>
</body>

</html>