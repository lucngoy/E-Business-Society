<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | E-Business Society</title>
    <link rel="shortcut icon" href="{{ asset('ftco-32x32.png') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.min.css')  }}" />
    <style>
      /* dropdown btn */
      .dropdown-menu {
        display: none; /* Cache par défaut */
      }

      .dropdown-menu.show {
        display: block; /* Affiche lorsque la classe "show" est ajoutée */
        position: absolute; /* Maintient l'affichage dans la position correcte */
        will-change: transform; /* Optimisation des animations */
        top: 100%; /* Position sous le bouton */
        right: 0; /* Aligné à gauche */
        z-index: 1000; /* Assure la priorité d'affichage */
      }

      .dropdown-divider{
        border-top: solid 1px #e7e7e7;
      }



      .star.active{
        color: #83D504;
      }
      .pic-in-table{
        height: 30px;
        width: 30px;
        min-width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: solid 1px #e7e7e7;
        overflow: hidden;
        background: #e7e7e7;
      }
      .pic-in-table img{
        height: 100%;
      }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> -->
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="{{ route('home') }}" class="text-nowrap logo-img">
            <img src="{{ asset('images/logo-2.png') }}" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>

            @if(isset($user) && ($user->isAdmin() || $user->isBusinessOwner()))

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.overview') }}" aria-expanded="false">
                    <span>
                    <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Overview</span>
                </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('businesses.index') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-building"></i>
                </span>
                <span class="hide-menu">Businesses</span>
              </a>
            </li>


            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('dashboard.reviews') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-stars"></i>
                </span>
                <span class="hide-menu">Reviews</span>
              </a>
            </li>
            @endif

            @if(isset($user) && $user->isAdmin())
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('categories.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-category"></i>
                </span>
                <span class="hide-menu">Categories</span>
              </a>
            </li>
            @endif

            @if(isset($user) && ($user->isAdmin()))
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('dashboard.users') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Users</span>
              </a>
            </li>
            @endif


            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('notifications.index') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-bell"></i>
                </span>
                <span class="hide-menu">
                  Notifications ({{ $totalNotifications ?? 0 }})
                </span>

                @if ($totalNotifications > 0)
                  <div class="notification bg-primary rounded-circle"></div>
                @endif
              </a>
            </li>

            @if(isset($user) && ($user->isAdmin()))
            <!-- <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('dashboard.reports') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-clipboard-data"></i>
                </span>
                <span class="hide-menu">Reports</span>
              </a>
            </li> -->
            @endif

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('dashboard.settings') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-settings-2"></i>
                </span>
                <span class="hide-menu">Settings</span>
              </a>
            </li>
            @auth
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">AUTH</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('logout') }}" aria-expanded="false" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span>
                  <i class="ti ti-logout"></i>
                </span>
                <span class="hide-menu">Logout</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </a>
            </li>
            @endauth
          </ul>

          <!-- <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
            <div class="d-flex">
              <div class="unlimited-access-title me-3">
                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Upgrade to pro</h6>
                <a href="https://adminmart.com/product/modernize-bootstrap-5-admin-template/" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
              </div>
              <div class="unlimited-access-img">
                <img src="{{ asset('images/backgrounds/rocket.png') }}" alt="" class="img-fluid">
              </div>
            </div>
          </div> -->
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->

    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item d-block d-xl-none">
                    <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="nav-item d-block">
                    <a class="nav-link" id="headerCollapse" href="{{ route('home') }}">
                        <i class="ti ti-home"></i>
                    </a>
                </li>

                <li class="nav-item d-block">
                    <a class="nav-link" id="headerCollapse" href="{{ route('notifications.index') }}">
                      <i class="ti ti-bell-ringing"></i>
                      @if ($totalNotifications > 0)
                        <div class="notification bg-primary rounded-circle"></div>
                      @endif
                    </a>
                </li>

            </ul>
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                    <li style="cursor:pointer;" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown">{{ Auth::user()->name }}</li> <!-- User Name -->
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                        aria-expanded="false">
                            <img src="{{ asset('images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                        </a>

                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            <div class="message-body">
                                <a href="{{ route('dashboard.settings') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-settings-2 fs-6"></i>
                                    <p class="mb-0 fs-3">Setting</p>
                                </a>

                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            </nav>
        </header>
        <!--  Header End -->
        <div class="container-fluid">
            <!-- Contenu du dashboard -->
            @yield('content')
        </div>
    </div>
  </div>

  <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('js/app.min.js') }}"></script>
  <script src="{{ asset('libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>

  <!-- Btn dropdown -->
  <script>
    $('.dropdown-toggle').on('click', function (event) {
      event.preventDefault(); // Empêche tout comportement par défaut (facultatif)
      $(this).next('.dropdown-menu').toggleClass('show');
    });
    
    $(document).on('click', function (event) {
      if (!$(event.target).closest('.btn-group').length) {
          $('.dropdown-menu').removeClass('show');
      }
    });
  </script>

  <script>
    $('#myTable').DataTable({
        responsive: true,
        paging: false,  // Désactive la pagination
        searching: false,  // Désactive la recherche
        order: []  // Aucun tri par défaut
    });

    $('#myTable2').DataTable({
        responsive: true,
        paging: false,  // Désactive la pagination
        searching: false,  // Désactive la recherche
        order: []  // Aucun tri par défaut
    });

  </script>

  <!-- <script>
    // Filter listing using ajax
    $(document).ready(function() {
        $('#filterForm input, #filterForm select').on('change input', function() {
            const form = $('#filterForm');
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize(),
                beforeSend: function() {
                    // Affichez un indicateur de chargement
                    $('#results').html('<p>Loading...</p>');
                },
                success: function(response) {
                    // Mettez à jour les résultats avec la réponse
                    $('#results').html($(response).find('#results').html());
                },
                error: function() {
                    $('#results').html('<div class="alert alert-warning" role="alert">Something went wrong. Please try again.</div>');
                }
            });
        });
    });
  </script> -->
</body>

</html>
