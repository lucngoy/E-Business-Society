@extends('layouts.app')

@section('title', 'Home')

@section('content')
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
                      <form action="{{ route('business.search') }}" method="GET">
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
                                @if(isset($categories) && $categories->isNotEmpty())
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                @else
                                    <option disabled>No categories available</option>
                                @endif
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
    @include('popular-categories')
      
    
    <div class="site-section" data-aos="fade">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Featured Companies</h2>
            <p class="color-black-opacity-5">The must-rated in your region</p>
          </div>
        </div>

        <div class="row">
          @if(isset($topBusinesses) && $topBusinesses->isNotEmpty())
            @foreach($topBusinesses as $business)
              <div class="col-md-6 mb-4 mb-lg-4 col-lg-4">

                <div class="listing-item">
                  <div class="listing-image">
                    <img src="{{ $business->image ? asset('storage/' . $business->image) : asset('images/default-img.png') }}" alt="{{ $business->business_name }}" class="img-fluid">
                  </div>
                  <div class="listing-item-content">
                    <!-- <a href="listings-single.html" class="bookmark" data-toggle="tooltip" data-placement="left" title="Bookmark"><span class="icon-heart"></span></a> -->
                    <a class="px-3 mb-3 category" href="{{ route('business.search', ['category' => $business->category->id ?? '']) }}">{{ $business->category->category_name }}</a>
                    <h2 class="mb-1"><a href="{{ route('business.show', $business->id) }}">{{ $business->business_name }}</a></h2>
                    <span class="address">{{ Str::limit($business->address, 40) }}</span>
                    <br>
                    <span>
                      @for ($i = 0; $i < 5; $i++)
                          <span class="icon-star {{ $i < (int)$business->reviews_avg_rating ? 'text-warning' : 'text-secondary' }}"></span>
                      @endfor
                    </span>
                  </div>
                </div>

              </div>
            @endforeach
          @else
            <p class="text-center">No businesses available</p>
          @endif
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
          @if(isset($latestReviews) && $latestReviews->isNotEmpty())
            @foreach ($latestReviews as $latestReview)
              <div>
                <div class="testimonial">
                  <figure class="mb-4">
                    <img src="{{ asset('images/profile/user-1.jpg') }}" alt="Free Website Template by Free-Template.co" class="img-fluid mb-3">
                    <p>{{ $latestReview->user->name ?? 'Anonymous' }}</p>
                  </figure>
                  <blockquote>
                    <p>&ldquo;{{ Str::limit($latestReview->comment, 100) }}&rdquo;</p>
                  </blockquote>
                  <a href="{{ route('business.show', $latestReview->business->id ?? '#') }}">
                    <b>{{ $latestReview->business->business_name ?? 'No Business' }}</b>
                  </a>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>


    <br>
    <div class="map-section" data-aos="fade">
      <!-- Table et carte dans le HTML -->
      <div class="map-section" id="mapSection" data-aos="fade">
        <div class="container">
          <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center border-primary">
              <h2 class="font-weight-light text-primary">Find businesses near you</h2>
              <p class="color-black-opacity-5">Locate local services with our interactive map</p>
            </div>
          </div>

          <!-- Carte -->
          <div id="map" style="height: 400px;"></div> <!-- Carte ici -->


          <!-- Tableau des entreprises -->
          <table id="businessTable" class="table table-striped" style="width: 100%; margin-top: 20px;"></table>
        </div>
      </div>

      <!-- Leaflet JS -->
      <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          // Données des entreprises transmises depuis le contrôleur
          const businesses = @json($businesses);
          
          let map;
          const markers = []; // Pour stocker les marqueurs

          // Fonction pour initialiser la carte
          const initMap = (lat, lng, zoomLevel = 2) => {
            if (!map) {
              map = L.map('map').setView([lat, lng], zoomLevel);
              L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
              }).addTo(map);
            } else {
              map.setView([lat, lng], zoomLevel);
            }

            // Ajouter les marqueurs
            businesses.forEach(business => {
              const marker = L.marker([business.latitude, business.longitude])
                .bindPopup(`<strong>${business.business_name}</strong><br>${business.address}`)
                .addTo(map);

              markers.push({ marker, business });

              marker.on('click', () => {
                map.setView([business.latitude, business.longitude], 15);
                marker.openPopup();
              });
            });
          };

          // Géolocalisation pour centrer la carte
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
              position => {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;
                initMap(userLat, userLng, 12);
              },
              error => {
                console.error('Géolocalisation échouée, position par défaut utilisée.', error);
                initMap(0, 0);
              }
            );
          } else {
            console.warn('Géolocalisation non prise en charge.');
            initMap(0, 0);
          }

          // Initialisation de la DataTable
          const table = $('#businessTable').DataTable({
            data: businesses,
            paging: false,          // Désactive la pagination
            scrollCollapse: true,   // Permet de réduire la hauteur de la table si nécessaire
            scrollY: '50vh',      // Définit la hauteur de la table avec un défilement vertical
            columns: [
              { data: 'business_name', title: 'Business Name' },
              { data: 'address', title: 'Address' },
              { data: 'phone', title: 'Phone' },
              {
                data: null,
                title: 'Actions',
                render: function (data, type, row) {
                  return `<button class="btn btn-primary btn-zoom" data-lat="${row.latitude}" data-lng="${row.longitude}" data-business="${row.business_name}" data-address="${row.address}">Zoom on Map</button>`;
                }
              }
            ]
          });

          // Ajouter un événement pour zoomer sur la carte et aller à la section de la carte
          $('#businessTable').on('click', '.btn-zoom', function () {
            const lat = $(this).data('lat');
            const lng = $(this).data('lng');

            // Zoomer sur la carte
            map.setView([lat, lng], 15);

            // Trouver le marqueur correspondant à cette entreprise
            const markerData = markers.find(item => 
              Math.abs(item.business.latitude - lat) < 0.0001 && Math.abs(item.business.longitude - lng) < 0.0001
            );

            if (markerData) {
              if (markerData.marker.isPopupOpen()) {
                markerData.marker.closePopup();
              }
              markerData.marker.openPopup();
            } else {
              console.log("Aucun marqueur trouvé pour cette position");
            }

            // Faire défiler vers la section de la carte
            const mapSection = document.getElementById('mapSection');
            mapSection.scrollIntoView({ behavior: 'smooth' });
          });

        });
      </script>

    </div>


    
    <!-- Inclure la section appel a l'action -->
    @include('call-to-action')
@endsection