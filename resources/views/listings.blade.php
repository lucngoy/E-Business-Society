@extends('layouts.app')

@section('title', 'Listings')

@section('sub-title', 'Discover Local Businesses Tailored to Your Needs')

@section('content')
    <!-- Inclure sub-header de la page -->
    @include('header-page')

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            @foreach ($businesses as $business)
                <div class="d-block d-md-flex listing-horizontal">

                    <a href="#" class="img d-block" style="background-image: url('{{ $business->image ? asset('storage/' . $business->image) : asset('images/default-img.png') }}')">
                        <span class="category">{{ $business->category->category_name }}</span>
                    </a>

                    <div class="lh-content">
                        <!-- <a href="" class="bookmark"><span class="icon-heart"></span></a> -->
                        <h3><a href="{{ route('business.show', $business->id) }}">{{ $business->business_name }}</a></h3>
                        <p>{{ $business->address }}</p>
                        <!-- <p>
                            <span class="icon-star text-warning"></span>
                            <span class="icon-star text-warning"></span>
                            <span class="icon-star text-warning"></span>
                            <span class="icon-star text-warning"></span>
                            <span class="icon-star text-secondary"></span>
                            <span>(492 Reviews)</span>
                        </p> -->

                        <p>
                            @for ($i = 0; $i < 5; $i++)
                                <span class="icon-star {{ $i < (int)$business->reviews_avg_rating ? 'text-warning' : 'text-secondary' }}"></span>
                            @endfor
                            <span>({{ $business->reviews_count }} Reviews)</span>
                        </p>

                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="pagination">
                {{ $businesses->links('pagination::default') }}
            </div>
            
            <!-- <div class="col-12 mt-5 text-center">
              <div class="custom-pagination">
                <span>1</span>
                <a href="#">2</a>
                <a href="#">3</a>
                <span class="more-page">...</span>
                <a href="#">10</a>
              </div>
            </div> -->

          </div>
          <div class="col-lg-3 ml-auto">

            <div class="mb-5">
              <h3 class="h5 text-black mb-3">Filters</h3>
              <form action="#" method="post">
                <div class="form-group">
                  <input type="text" placeholder="What are you looking for?" class="form-control">
                </div>
                <div class="form-group">
                  <div class="select-wrap">
                      <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
                      <select class="form-control" name="" id="">
                        <option value="">All Categories</option>
                        <option value="">Appartment</option>
                        <option value="">Restaurant</option>
                        <option value="">Eat &amp; Drink</option>
                        <option value="">Events</option>
                        <option value="">Fitness</option>
                        <option value="">Others</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                  <!-- select-wrap, .wrap-icon -->
                  <div class="wrap-icon">
                    <span class="icon icon-room"></span>
                    <input type="text" placeholder="Location" class="form-control">
                  </div>
                </div>
              </form>
            </div>
            
            <div class="mb-5">
              <form action="#" method="post">
                <div class="form-group">
                  <p>Radius around selected destination</p>
                </div>
                <div class="form-group">
                  <input type="range" min="0" max="100" value="20" data-rangeslider>
                </div>
              </form>
            </div>

            <div class="mb-5">
              <form action="#" method="post">
                <div class="form-group">
                  <p>Category 'Restaurant' is selected</p>
                  <p>More filters</p>
                </div>
                <div class="form-group">
                  <ul class="list-unstyled">
                    <li>
                      <label for="option1">
                        <input type="checkbox" id="option1">
                        Coffee
                      </label>
                    </li>
                    <li>
                      <label for="option2">
                        <input type="checkbox" id="option2">
                        Vegetarian
                      </label>
                    </li>
                    <li>
                      <label for="option3">
                        <input type="checkbox" id="option3">
                        Vegan Foods
                      </label>
                    </li>
                    <li>
                      <label for="option4">
                        <input type="checkbox" id="option4">
                        Sea Foods
                      </label>
                    </li>
                  </ul>
                </div>
              </form>
            </div>

          </div>

        </div>
      </div>
    </div>

    <!-- Inclure la section categorie populaire -->
    @include('popular-categories')

    <!-- Inclure la section appel a l'action -->
    @include('call-to-action')
@endsection