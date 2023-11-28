    <!-- Favicon and Touch Icons-->
    <meta charset="utf-8">
    <title>Around | Multipurpose Bootstrap Template</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Around - Multipurpose Bootstrap HTML Template">
    <meta name="keywords" content="bootstrap, business, corporate, coworking space, services, creative agency, dashboard, e-commerce, mobile app showcase, saas, multipurpose, product landing, shop, software, ui kit, web studio, landing, dark mode, html5, css3, javascript, gallery, slider, touch, creative">
    <meta name="author" content="Createx Studio">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets1/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets1/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets1/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets1/favicon/site.webmanifest')}}">
    <link rel="mask-icon" color="#6366f1" href="{{asset('assets1/favicon/safari-pinned-tab.svg')}}">
    <meta name="msapplication-config" content="{{asset('assets1/favicon/browserconfig.xml')}}">
    <link href="https:/fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet" id="google-font">
    <!-- Vendor styles-->
    <link rel="stylesheet" media="screen" href="{{asset('assets1/vendor/aos/dist/aos.css')}}"/>
    <link rel="stylesheet" media="screen" href="{{asset('assets1/vendor/img-comparison-slider/dist/styles.css')}}"/>
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="{{asset('assets1/css/theme.min.css')}}">
    <meta name="theme-color" content="white">
    <!-- Theme mode-->
    <script>
      let mode = window.localStorage.getItem('mode'),
          root = document.getElementsByTagName('html')[0];
      if (mode !== undefined && mode === 'dark') {
        root.classList.add('dark-mode');
      } else {
        root.classList.remove('dark-mode');
      }


    </script>
    <!-- Scroll down animated button-->
    <style>
      .scroll-down-btn {
        display: inline-block;
        text-decoration: none;
      }
      .scroll-down-btn p {
        margin-top: 1.25rem;
        color: white;
        font-size: .875rem;
        font-weight: 500;
        letter-spacing: .375rem;
        text-indent: .375rem;
        animation: colorText 5s ease-out infinite, nudgeText 5s ease-out infinite;
      }
      .mouse {
        background: #2c333e linear-gradient(transparent 0%, transparent 50%, white 50%, white 100%);
        position: relative;
        width: 38px;
        height: 65px;
        margin: 0 auto;
        border-radius: 6rem;
        background-size: 100% 200%;
        animation: colorSlide 5s linear infinite, nudgeMouse 5s ease-out infinite;
      }
      .mouse:before, .mouse:after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        margin: auto;
      }
      .mouse:before {
        width: 34px;
        height: 61px;
        background-color: #121519;
        border-radius: 6rem;
      }
      .mouse:after {
        background-color: white;
        width: .375rem;
        height: .375rem;
        border-radius: 100%;
        animation: trackBallSlide 5s linear infinite;
      }
      @keyframes colorSlide {
        0% { background-position: 0% 100%; }
        20% { background-position: 0% 0%; }
        21% { background-color: #2c333e; }
        29.99% {
          background-color: white;
          background-position: 0% 0%;
        }
        30% {
          background-color: #2c333e;
          background-position: 0% 100%;
        }
        50% { background-position: 0% 0%; }
        51% { background-color: #2c333e; }
        59% {
          background-color: white;
          background-position: 0% 0%;
        }
        60% {
          background-color: #2c333e;
          background-position: 0% 100%;
        }
        80% { background-position: 0% 0%; }
        81% { background-color: #2c333e; }
        90%, 100% {
          background-color: white;
        }
      }
      @keyframes trackBallSlide {
        0% {
          opacity: 1;
          transform: scale(1) translateY(-20px);
        }
        6% {
          opacity: 1;
          transform: scale(0.9) translateY(5px);
        }
        14% {
          opacity: 0;
          transform: scale(0.4) translateY(40px);
        }
        15%, 19% {
          opacity: 0;
          transform: scale(0.4) translateY(-20px);
        }
        28%, 29.99% {
          opacity: 1;
          transform: scale(1) translateY(-20px);
        }
        30% {
          opacity: 1;
          transform: scale(1) translateY(-20px);
        }
        36% {
          opacity: 1;
          transform: scale(0.9) translateY(5px);
        }
        44% {
          opacity: 0;
          transform: scale(0.4) translateY(40px);
        }
        45%, 49% {
          opacity: 0;
          transform: scale(0.4) translateY(-20px);
        }
        58%, 59.99% {
          opacity: 1;
          transform: scale(1) translateY(-20px);
        }
        60% {
          opacity: 1;
          transform: scale(1) translateY(-20px);
        }
        66% {
          opacity: 1;
          transform: scale(0.9) translateY(5px);
        }
        74% {
          opacity: 0;
          transform: scale(0.4) translateY(40px);
        }
        75%, 79% {
          opacity: 0;
          transform: scale(0.4) translateY(-20px);
        }
        88%, 100% {
          opacity: 1;
          transform: scale(1) translateY(-20px);
        }
      }
      @keyframes nudgeMouse {
        0%, 30%, 60%, 90% { transform: translateY(0); }
        20%, 50%, 80% { transform: translateY(8px); }
      }
      @keyframes nudgeText {
        0%, 30%, 60%, 90% { transform: translateY(0); }
        20%, 50%, 80% { transform: translateY(2px); }
      }
      @keyframes colorText {
        21%, 51%, 81% { color: #2c333e; }
        30%, 60%, 90% { color: white; }
      }

    </style>
    <!-- Page loading styles-->
    <style>
      .page-loading {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        -webkit-transition: all .4s .2s ease-in-out;
        transition: all .4s .2s ease-in-out;
        background-color: #fff;
        opacity: 0;
        visibility: hidden;
        z-index: 9999;
      }
      .dark-mode .page-loading {
        background-color: #121519;
      }
      .page-loading.active {
        opacity: 1;
        visibility: visible;
      }
      .page-loading-inner {
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        text-align: center;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        -webkit-transition: opacity .2s ease-in-out;
        transition: opacity .2s ease-in-out;
        opacity: 0;
      }
      .page-loading.active > .page-loading-inner {
        opacity: 1;
      }
      .page-loading-inner > span {
        display: block;
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        font-weight: normal;
        color: #6f788b;
      }
      .dark-mode .page-loading-inner > span {
        color: #fff;
        opacity: .6;
      }
      .page-spinner {
        display: inline-block;
        width: 2.75rem;
        height: 2.75rem;
        margin-bottom: .75rem;
        vertical-align: text-bottom;
        background-color: #d7dde2;
        border-radius: 50%;
        opacity: 0;
        -webkit-animation: spinner .75s linear infinite;
        animation: spinner .75s linear infinite;
      }
      .dark-mode .page-spinner {
        background-color: rgba(255,255,255,.25);
      }
      @-webkit-keyframes spinner {
        0% {
          -webkit-transform: scale(0);
          transform: scale(0);
        }
        50% {
          opacity: 1;
          -webkit-transform: none;
          transform: none;
        }
      }
      @keyframes spinner {
        0% {
          -webkit-transform: scale(0);
          transform: scale(0);
        }
        50% {
          opacity: 1;
          -webkit-transform: none;
          transform: none;
        }
      }

    </style>
    <!-- Page loading scripts-->
    <script>
      (function () {
        window.onload = function () {
          const preloader = document.querySelector('.page-loading');
          preloader.classList.remove('active');
          setTimeout(function () {
            preloader.remove();
          }, 1500);
        };
      })();

    </script>
    <!-- Import Google Font-->
    <link rel="preconnect" href="https:/fonts.googleapis.com">
    <link rel="preconnect" href="https:/fonts.gstatic.com" crossorigin>
    <link href="https:/fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet" id="google-font">
