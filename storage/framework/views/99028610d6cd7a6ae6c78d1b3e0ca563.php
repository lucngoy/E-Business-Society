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
            <h1 class="mb-0 site-logo"><a href="<?php echo e(route('home')); ?>" class="text-white h2 mb-0">
              <img src="<?php echo e(asset('images/logo-1.png')); ?>" alt="E-Business Logo">
            </a></h1>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class="<?php echo e(request()->is('/') ? 'active' : ''); ?>"><a href="<?php echo e(route('home')); ?>"><span>Home</span></a></li>

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
                    <a href="#"><span>Businesses</span></a>
                    <ul class="dropdown">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li>
                              <a href="#"><?php echo e($category->category_name); ?></a>
                          </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>



                <li class="<?php echo e(request()->is('listings') ? 'active' : ''); ?>"><a href="<?php echo e(route('listings')); ?>"><span>Listings</span></a></li>
                <li class="<?php echo e(request()->is('about') ? 'active' : ''); ?>"><a href="<?php echo e(route('about')); ?>"><span>About</span></a></li>
                <li class="<?php echo e(request()->is('contact') ? 'active' : ''); ?>"><a href="<?php echo e(route('contact')); ?>"><span>Contact</span></a></li>
                <?php if(auth()->guard()->guest()): ?>
                    <li class="<?php echo e(request()->is('login') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('login')); ?>"><span>Login</span></a>
                    </li>
                <?php endif; ?>
                
                <?php if(auth()->guard()->check()): ?>
                <li class="has-children">
                    <?php if($userRole === 'admin' || $userRole === 'business_owner'): ?>
                    <a href="<?php echo e(route('dashboard.overview')); ?>">
                        <span><?php echo e(Auth::user()->name); ?></span> <!-- Affiche le nom de l'utilisateur -->
                    </a>
                    <?php else: ?>
                    <a href="<?php echo e(route('dashboard.settings')); ?>">
                        <span><?php echo e(Auth::user()->name); ?></span> <!-- Affiche le nom de l'utilisateur -->
                    </a>
                    <?php endif; ?>

                    <ul class="dropdown arrow-top">
                        <?php if($userRole === 'admin' || $userRole === 'business_owner'): ?>
                          <li><a href="<?php echo e(route('dashboard.overview')); ?>">Dashboard</a></li>
                        <?php else: ?>
                          <li><a href="<?php echo e(route('dashboard.settings')); ?>">Settings</a></li>
                        <?php endif; ?>
                        <li>
                            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

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
      
    </header><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/header.blade.php ENDPATH**/ ?>