<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
    <div class="site-blocks-cover overlay" style="background-image: url(images/hero_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">

                <div class="col-md-10">
                
                
                    <div class="row justify-content-center mb-4">
                        <div class="col-md-10 text-center">
                        <h1 data-aos="fade-up">Find near you the best local <span class="typed-words">business</span></h1>
                        <!-- <p data-aos="fade-up" data-aos-delay="100">Handcrafted free templates by <a href="https://free-template.co/" target="_blank">Free-Template.co</a></p> -->
                        </div>
                    </div>

                    <!-- ############### Search -->
                    <div class="form-search-wrap p-2" data-aos="fade-up" data-aos-delay="200">
                      <form action="<?php echo e(route('business.search')); ?>" method="GET">
                        <div class="row align-items-center">
                          <div class="col-lg-12 col-xl-4 no-sm-border border-right">
                            <input type="text" class="form-control" name="name" placeholder="Search by business name">
                          </div>

                          <div class="col-lg-12 col-xl-3 no-sm-border border-right">
                            <div class="wrap-icon">
                                <span class="icon icon-room"></span>
                                <input type="text" class="form-control" name="location" placeholder="Search by location">
                            </div>
                          </div>

                          <div class="col-lg-12 col-xl-3">
                            <div class="select-wrap">
                              <span class="icon">
                                <span class="icon-keyboard_arrow_down"></span>
                              </span>

                              <select class="form-control" name="category">
                                <option value="">Select category</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-lg-12 col-xl-2 ml-auto text-right">
                            <input type="submit" class="btn text-white btn-primary" value="Search">
                          </div>
                        </div>
                      </form>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
    </div>
    

    <!-- Inclure section popular categories -->
    <?php echo $__env->make('popular-categories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      
    
    <div class="site-section" data-aos="fade">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Featured Companies</h2>
            <p class="color-black-opacity-5">The must-sees in your region</p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-4 mb-lg-4 col-lg-4">
            
            <div class="listing-item">
              <div class="listing-image">
                <img src="images/img_1.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid">
              </div>
              <div class="listing-item-content">
                <a href="listings-single.html" class="bookmark" data-toggle="tooltip" data-placement="left" title="Bookmark"><span class="icon-heart"></span></a>
                <a class="px-3 mb-3 category" href="#">Hotels</a>
                <h2 class="mb-1"><a href="listings-single.html">Luxe Hotel</a></h2>
                <span class="address">West Orange, New York</span>
              </div>
            </div>

          </div>
          <div class="col-md-6 mb-4 mb-lg-4 col-lg-4">
            
            <div class="listing-item">
              <div class="listing-image">
                <img src="images/img_2.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid">
              </div>
              <div class="listing-item-content">
                <a href="listings-single.html" class="bookmark"><span class="icon-heart"></span></a>
                <a class="px-3 mb-3 category" href="#">Restaurants</a>
                <h2 class="mb-1"><a href="listings-single.html">Jones Grill &amp; Restaurants</a></h2>
                <span class="address">Brooklyn, New York</span>
              </div>
            </div>

          </div>
          <div class="col-md-6 mb-4 mb-lg-4 col-lg-4">
            
            <div class="listing-item">
              <div class="listing-image">
                <img src="images/img_3.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid">
              </div>
              <div class="listing-item-content">
                <a href="listings-single.html" class="bookmark"><span class="icon-heart"></span></a>
                <a class="px-3 mb-3 category" href="#">Events</a>
                <h2 class="mb-1"><a href="listings-single.html">Live Band</a></h2>
                <span class="address">West Orange, New York</span>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    
    

    <div class="site-section bg-light">
      <div class="container">

        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Recent reviews</h2>
          </div>
        </div>
        

        <div class="slide-one-item home-slider owl-carousel">
          <div>
            <div class="testimonial">
              <figure class="mb-4">
                <img src="images/person_3_sq.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid mb-3">
                <p>Willie Smith</p>
              </figure>
              <blockquote>
                <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
              </blockquote>
              <a href=""><b>Google</b></a>
            </div>
          </div>
          <div>
            <div class="testimonial">
              <figure class="mb-4">
                <img src="images/person_2_sq.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid mb-3">
                <p>Robert Jones</p>
              </figure>
              <blockquote>
                <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
              </blockquote>
              <a href=""><b>Google</b></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <br>
    <div class="map-section" data-aos="fade">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Find businesses near you</h2>
            <p class="color-black-opacity-5">Locate local services with our interactive map</p>
          </div>
        </div>
        <!-- La carte doit avoir un conteneur avec une hauteur définie -->
        <div id="map"></div>
        
        <div class="business-list" id="businessList"></div>
      </div>

      <!-- Leaflet JS - IMPORTANT: le charger APRÈS la définition du div map -->
      <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
              integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
              crossorigin=""></script>

      <script>
          // Attendez que tout soit chargé
          document.addEventListener('DOMContentLoaded', function() {
              // Données des entreprises
              const businesses = [
                  {
                      name: "Siège Paris",
                      address: "123 Avenue des Champs-Élysées, Paris",
                      coordinates: [48.8566, 2.3522]
                  },
                  {
                      name: "Bureau Lyon",
                      address: "456 Rue de la République, Lyon",
                      coordinates: [45.7578, 4.8320]
                  }
              ];

              // Initialiser la carte au centre de la France
              const map = L.map('map').setView([46.603354, 1.888334], 6);

              // Ajouter la couche OpenStreetMap
              L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                  attribution: '© OpenStreetMap contributors'
              }).addTo(map);

              // Ajouter les marqueurs et la liste
              const businessList = document.getElementById('businessList');
              businesses.forEach(business => {
                  // Ajouter le marqueur
                  const marker = L.marker(business.coordinates)
                      .bindPopup(`
                          <strong>${business.name}</strong><br>
                          ${business.address}
                      `)
                      .addTo(map);

                  // Créer l'élément de liste
                  const item = document.createElement('div');
                  item.className = 'business-item';
                  item.innerHTML = `
                      <strong>${business.name}</strong><br>
                      ${business.address}
                  `;
                  
                  // Ajouter l'interaction avec la carte
                  item.onclick = () => {
                      map.setView(business.coordinates, 13);
                      marker.openPopup();
                  };
                  
                  businessList.appendChild(item);
              });
          });
      </script>
    </div>
    
    <!-- Inclure la section appel a l'action -->
    <?php echo $__env->make('call-to-action', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/home.blade.php ENDPATH**/ ?>