<div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
    <header class="site-navbar" role="banner">

      <div class="container">
        <div class="row align-items-center">
          
          <div class="col-11 col-xl-2">
            <h1 class="mb-0 site-logo"><a href="{{ route('home') }}" class="text-white h2 mb-0">
              <img src="{{ asset('images/logo-1.png') }}" alt="E-Business Logo">
            </a></h1>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ route('home') }}"><span>Home</span></a></li>

                <!-- <li class="has-children">
                    <a href="#"><span>Businesses</span></a>
                    <ul class="dropdown arrow-top">
                        <li><a href="#">Restaurants</a></li>
                        <li><a href="#">Professional Services</a></li>
                        <li><a href="#">Amenities</a></li>
                        <li><a href="#">Health and Wellness</a></li>
                        <li class="has-children">
                            <a href="#">Shopping</a>
                            <ul class="dropdown">
                                <li><a href="#">Clothing</a></li>
                                <li><a href="#">Electronics</a></li>
                                <li><a href="#">Furniture</a></li>
                                <li><a href="#">Jewelry</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Education</a></li>
                        <li><a href="#">Transport and Travel</a></li>
                        <li><a href="#">Arts and Leisure</a></li>
                        <li><a href="#">Technology</a></li>
                        <li><a href="#">Construction and Home</a></li>
                    </ul>
                </li> -->

                <li class="has-children">
                    <a><span>Businesses</span></a>
                    <ul class="dropdown">
                        @foreach($categories as $category)
                          <li>
                              <a href="{{ route('business.search', ['category' => $category->id]) }}">{{ $category->category_name }}</a>
                          </li>
                        @endforeach
                    </ul>
                </li>



                <li class="{{ request()->is('listings') ? 'active' : '' }}"><a href="{{ route('listings') }}"><span>Listings</span></a></li>
                <li class="{{ request()->is('about') ? 'active' : '' }}"><a href="{{ route('about') }}"><span>About</span></a></li>
                <li class="{{ request()->is('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}"><span>Contact</span></a></li>
                @guest
                    <li class="{{ request()->is('login') ? 'active' : '' }}">
                        <a href="{{ route('login') }}"><span>Login</span></a>
                    </li>
                @endguest
                
                @auth
                <li class="has-children">
                    @if ($userRole === 'admin' || $userRole === 'business_owner')
                    <a href="{{ route('dashboard.overview') }}">
                        <span>{{ Auth::user()->name }}</span> <!-- Affiche le nom de l'utilisateur -->
                    </a>
                    @else
                    <a href="{{ route('dashboard.settings') }}">
                        <span>{{ Auth::user()->name }}</span> <!-- Affiche le nom de l'utilisateur -->
                    </a>
                    @endif

                    <ul class="dropdown arrow-top">
                        @if ($userRole === 'admin' || $userRole === 'business_owner')
                          <li><a href="{{ route('dashboard.overview') }}">Dashboard</a></li>
                        @else
                          <li><a href="{{ route('dashboard.settings') }}">Settings</a></li>
                        @endif
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth

                <!-- <li class="has-children">
                  <a href="about.html"><span>Luck Shawn</span></a>
                  <ul class="dropdown arrow-top">
                    <li><a href="#">Rent Cars</a></li>
                    <li><a href="#">Rent Two</a></li>
                    <li><a href="#">Rent Three</a></li>
                    <li class="has-children">
                      <a href="#">Dropdown</a>
                      <ul class="dropdown">
                        <li><a href="#">Menu One</a></li>
                        <li><a href="#">Menu Two</a></li>
                        <li><a href="#">Menu Three</a></li>
                        <li><a href="#">Menu Four</a></li>
                      </ul>
                    </li>
                  </ul>
                </li> -->

              </ul>
            </nav>
          </div>


          <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

          </div>

        </div>
      </div>
      
    </header>