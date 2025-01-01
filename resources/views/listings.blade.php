@extends('layouts.app')

@section('title', 'Listings')

@section('sub-title', 'Discover Local Businesses Tailored to Your Needs')

@section('content')
    <!-- Inclure sub-header de la page -->
    @include('header-page')

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div id="results" class="col-lg-8">

            @if($businesses->isEmpty())
              <div class="alert alert-warning" role="alert">
                No businesses found matching your search criteria.
              </div>
            @else
              @foreach ($businesses as $business)
                  <div class="d-block d-md-flex listing-horizontal">

                      <a href="{{ route('business.search', ['category' => $business->category->id]) }}" class="img d-block" style="background-image: url('{{ $business->image ? asset('storage/' . $business->image) : asset('images/default-img.png') }}')">
                          <span class="category">{{ $business->category->category_name }}</span>
                      </a>

                      <div class="lh-content">
                          <!-- <a href="" class="bookmark"><span class="icon-heart"></span></a> -->
                          <h3><a href="{{ route('business.show', $business->id) }}">{{ $business->business_name }}</a></h3>
                          <p>{{ Str::limit($business->address, 50) }}</p>

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
                {{ $businesses->appends(request()->except('page'))->links('pagination::default') }}
              </div>
            @endif
          </div>

          <!-- Sidebar -->
          <!-- ############################### Filter Form -->
          <div class="col-lg-3 ml-auto">
            <div class="mb-5">
                <h3 class="h5 text-black mb-3">Filters</h3>
                <form id="filterForm" action="{{ route('listings') }}" method="GET">
                    <div class="form-group">
                        <input type="text" name="query" value="{{ request('query') }}" placeholder="What are you looking for?" class="form-control" oninput="applyFilter()">
                    </div>
                    <div class="form-group">
                        <div class="select-wrap">
                            <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
                            <select class="form-control" name="category" onchange="applyFilter()">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="wrap-icon">
                            <span class="icon icon-room"></span>
                            <input type="text" name="location" value="{{ request('location') }}" placeholder="Adress" class="form-control" oninput="applyFilter()">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                      <p>Radius around selected destination</p>
                      <input type="range" name="radius" min="0" max="100" value="{{ request('radius', 20) }}" data-rangeslider onchange="applyFilter()">
                    </div> -->
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