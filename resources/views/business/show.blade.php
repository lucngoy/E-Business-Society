@extends('layouts.app')

@section('title', $business->business_name)

@section('sub-title', $business->address) <!-- Location -->

@section('content')

    <!-- Inclure sub-header de la page -->
    @include('header-page')
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" data-aos="fade" data-aos-delay="100">
                    <div class="mb-5 border-bottom pb-5">
                        <p><img src="{{ $business->image ? asset('storage/' . $business->image) : asset('images/default-img.png') }}" alt="Business Image" class="img-fluid mb-4"></p>
                        
                        <p>{{ $business->description }}</p>

                        <div class="review-container">
                            <div class="inner">
                                <!-- Note moyenne -->
                                <div class="rating">
                                    <span class="rating-num">{{ number_format($business->reviews->avg('rating'), 1) }}</span>
                                    <div class="rating-stars">
                                        @for ($i = 0; $i < 5; $i++)
                                            <span>
                                                <i class="icon-star {{ $i < number_format($business->reviews->avg('rating')) ? 'active' : '' }}"></i>
                                            </span>
                                        @endfor
                                    </div>
                                    <div class="rating-users">
                                        <i class="icon-user"></i> {{ $business->reviews->count() }} reviews
                                    </div>
                                </div>
                                
                                <!-- Histogramme de répartition des avis -->
                                <div class="histo">
                                    @php
                                        $totalReviews = $business->reviews->count();
                                        $ratingsCount = [
                                            5 => $business->reviews->where('rating', 5)->count(),
                                            4 => $business->reviews->where('rating', 4)->count(),
                                            3 => $business->reviews->where('rating', 3)->count(),
                                            2 => $business->reviews->where('rating', 2)->count(),
                                            1 => $business->reviews->where('rating', 1)->count(),
                                        ];
                                    @endphp

                                    @foreach ($ratingsCount as $rating => $count)
                                        <div class="rating-{{ $rating }} histo-rate">
                                            <span class="histo-star">
                                                <i class="active icon-star"></i> {{ $rating }}
                                            </span>
                                            <span class="bar-block">
                                                <span id="bar-{{ $rating }}" class="bar" style="width: {{ $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0 }}%">
                                                    <span>{{ $count }}</span>&nbsp;
                                                </span>
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <!-- Affichage des avis sur la page de l’entreprise -->

                        @if($reviews->count() > 0)
                            @foreach($reviews as $review)
                                <div class="reviews">
                                    <div class="header">
                                        <div class="picture">{{ Str::limit($review->user->name,1) }}</div>
                                        <strong>{{ $review->user->name }}</strong>
                                    </div>

                                    <small>
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="icon-star {{ $i < $review->rating ? 'active' : '' }}"></i>
                                        @endfor

                                        &nbsp;Reviewed on {{ $review->created_at->format('d M Y') }}
                                    </small>
                                    
                                    <p class="cmnt">{{ $review->comment }}</p>

                                    @if(auth()->check() && ($userRole === 'admin' || auth()->id() === $review->user_id))
                                        <form method="POST" action="{{ route('reviews.destroy', $review->id) }}" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach

                            <!-- Pagination -->
                            <div class="pagination">
                                {{ $reviews->links('pagination::bootstrap-4') }}
                            </div>

                        @else
                            <p>No reviews yet. Be the first to leave a review!</p>
                        @endif


                        <br>
                        <!-- Formulaire pour soumettre un avis -->
                        @if(auth()->check())
                            <form method="POST" action="{{ route('reviews.store', $business->id) }}">
                                @csrf
                                <div class="row form-group">
                
                                    <div class="col-md-12">
                                        <label class="text-black" for="Rating">Rating</label> 
                                        <select name="rating" id="rating" class="form-control" required>
                                            <option value="">Select a rating</option>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="row form-group">
                
                                    <div class="col-md-12">
                                        <label class="text-black" for="Comment">Comment</label> 
                                        <textarea name="comment" id="comment" class="form-control" rows="4" placeholder="Write your review here"></textarea>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <input type="submit" value="Submit Review" class="btn btn-primary btn-md text-white">
                                    </div>
                                </div>
                            </form>
                        @else
                            <p><a href="{{ route('login') }}">Log in</a> to leave a review.</p>
                        @endif
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade" data-aos-delay="100">
                
                    <div class="p-4 mb-3 bg-white">
                        <p class="mb-0 font-weight-bold">Address</p>
                        <p class="mb-4">{{ $business->address }}</p>

                        <p class="mb-0 font-weight-bold">Phone</p>
                        <p class="mb-4"><a href="tel:{{ $business->phone }}">{{ $business->phone }}</a></p>

                        <p class="mb-0 font-weight-bold">Website</p>
                        <p class="mb-0"><a href="{{ $business->website }}" target="_blank">Visit Website</a></p>
                    </div>
                    
                    <div class="p-4 mb-3 bg-white">
                        <h3 class="h5 text-black mb-3">Opening Hours</h3>
                        <p>{!! nl2br(e($business->opening_hours)) !!}</p>
                        <!-- <p><a href="#" class="btn btn-primary px-4 py-2 text-white">Learn More</a></p> -->
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection