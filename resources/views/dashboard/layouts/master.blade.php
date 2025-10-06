
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('adm/img/logos/logo.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('adm/img/logos/logo.png') }}">
  <title>
    MMB Agro Farm - Administration
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('adm/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('adm/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('adm/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('adm/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
  <style>
    /* Styles personnalisés pour l'avatar utilisateur */
    .avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      font-weight: 600;
      text-transform: uppercase;
    }

    .avatar-sm {
      width: 32px;
      height: 32px;
      font-size: 12px;
    }

    .bg-gradient-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Amélioration du dropdown utilisateur */
    .dropdown-menu {
      border: none;
      box-shadow: 0 10px 27px 0 rgba(0, 0, 0, 0.05);
      border-radius: 15px;
    }

    .dropdown-item {
      border-radius: 10px;
      margin: 2px 8px;
      transition: all 0.3s ease;
    }

    .dropdown-item:hover {
      background-color: #f8f9fa;
      transform: translateX(5px);
    }

    .dropdown-item.text-danger:hover {
      background-color: #fff5f5;
      color: #e53e3e !important;
    }

    /* Animation pour l'avatar */
    .avatar {
      transition: all 0.3s ease;
    }

    .avatar:hover {
      transform: scale(1.1);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    /* Avatar avec image */
    .avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }

    /* Avatar XL pour la page de profil */
    .avatar-xl {
      width: 120px;
      height: 120px;
    }

    /* Bouton caméra sur l'avatar */
    .avatar-camera-btn {
      transition: all 0.3s ease;
      opacity: 0.9;
      cursor: pointer;
      z-index: 10;
    }

    .avatar-camera-btn:hover {
      opacity: 1;
      transform: scale(1.1);
      background-color: #5a67d8 !important;
    }

    .avatar-camera-btn svg {
      pointer-events: none;
    }

    /* Amélioration de l'avatar */
    .avatar {
      border: 3px solid #fff;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .avatar:hover {
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    /* Logo de la sidebar */
    .sidenav-header .navbar-brand {
      padding: 1.5rem 0.5rem;
    }

    .sidenav-header .navbar-brand img {
      transition: all 0.3s ease;
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
      height: 80px !important;
      width: auto !important;
      max-height: none !important;
      max-width: none !important;
    }

    .sidenav-header .navbar-brand:hover img {
      transform: scale(1.05);
      filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.15));
    }

    /* Couleurs harmonieuses pour MMB Agro Farm */
    :root {
      --mmb-primary: #75cb0c;
      --mmb-primary-border: #5a9a0a;
      --mmb-primary-light: #8dd83c;
      --mmb-primary-dark: #4a7a08;
    }

    /* Bordures harmonieuses */
    .btn-primary {
      border-color: var(--mmb-primary-border) !important;
    }

    .btn-primary:hover {
      border-color: var(--mmb-primary-dark) !important;
    }

    .border-primary {
      border-color: var(--mmb-primary-border) !important;
    }

    .form-control:focus {
      border-color: var(--mmb-primary-border) !important;
      box-shadow: 0 0 0 0.2rem rgba(117, 203, 12, 0.25) !important;
    }

    /* Version mobile */
    @media (max-width: 576px) {
      .avatar-sm {
        width: 28px;
        height: 28px;
        font-size: 10px;
      }

      .dropdown-menu {
        min-width: 280px;
        margin-top: 10px;
      }
    }

    /* Animation d'entrée pour le dropdown */
    .dropdown-menu.show {
      animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    @include('dashboard.partials.sidebar')
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        @include('dashboard.partials.header')
      </div>
    </nav>
    <!-- End Navbar -->


    <div class="container-fluid py-4">

      @yield('content')

      <footer class="footer pt-3  ">
        <div class="container-fluid">
          @include('dashboard.partials.footer')
        </div>
      </footer>
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="{{ asset('adm/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('adm/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('adm/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('adm/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('adm/js/plugins/chartjs.min.js') }}"></script>
  <script>
    var ctx = document.getElementById("chart-bars");
    if (ctx) {
      ctx = ctx.getContext("2d");

      new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Sales",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#fff",
          data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
          maxBarThickness: 6
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 15,
              font: {
                size: 14,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false
            },
            ticks: {
              display: false
            },
          },
        },
      },
    });
    }


    var ctx2 = document.getElementById("chart-line");
    if (ctx2) {
      ctx2 = ctx2.getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Mobile apps",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#75cb0c",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6

          },
          {
            label: "Websites",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#3A416F",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            fill: true,
            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
            maxBarThickness: 6
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#b2b9bf',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#b2b9bf',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
    }
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('adm/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

</html>
