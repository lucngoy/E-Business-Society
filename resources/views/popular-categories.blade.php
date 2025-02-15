<!-- <div class="site-section">
    <div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-7 text-center border-primary">
        <h2 class="font-weight-light text-primary">Popular Categories</h2>
        <p class="color-black-opacity-5">Find the best local businesses in each category.</p>
        </div>
    </div>

    <div class="row align-items-stretch">
        <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
        <a href="#" class="popular-category h-100">
            <span class="icon mb-3"><span class="flaticon-hotel"></span></span>
            <span class="caption mb-2 d-block">Hotels</span>
            <span class="number">4,89</span>
        </a>
        </div>
        <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
        <a href="#" class="popular-category h-100">
            <span class="icon mb-3"><span class="flaticon-microphone"></span></span>
            <span class="caption mb-2 d-block">Events</span>
            <span class="number">482</span>
        </a>
        </div>
        <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
        <a href="#" class="popular-category h-100">
            <span class="icon mb-3"><span class="flaticon-flower"></span></span>
            <span class="caption mb-2 d-block">Spa</span>
            <span class="number">194</span>
        </a>
        </div>
        <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
        <a href="#" class="popular-category h-100">
            <span class="icon mb-3"><span class="flaticon-restaurant"></span></span>
            <span class="caption mb-2 d-block">Stores</span>
            <span class="number">1,472</span>
        </a>
        </div>
        <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
        <a href="#" class="popular-category h-100">
            <span class="icon mb-3"><span class="flaticon-cutlery"></span></span>
            <span class="caption mb-2 d-block">Restaurants</span>
            <span class="number">439</span>
        </a>
        </div>
        <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
        <a href="#" class="popular-category h-100">
            <span class="icon mb-3"><span class="flaticon-bike"></span></span>
            <span class="caption mb-2 d-block">Other</span>
            <span class="number">692</span>
        </a>
        </div>
    </div>

    <div class="row mt-5 justify-content-center tex-center">
        <div class="col-md-4"><a href="#" class="btn btn-block btn-outline-primary btn-md px-5">View All Categories</a></div>
    </div>
    </div>
</div> -->

<div class="site-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center border-primary">
                <h2 class="font-weight-light text-primary">Popular Categories</h2>
                <p class="color-black-opacity-5">Find the best local businesses in each category.</p>
            </div>
        </div>

        <div class="row align-items-stretch">
            @foreach($topCategories as $category)
                <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
                    <a href="{{ route('business.search', ['category' => $category->id]) }}" class="popular-category h-100">
                        <span class="icon mb-3">
                            <span class="flaticon-{{ $category->icon ?? 'hotel'}}"></span>
                        </span>
                        <span class="caption mb-2 d-block">{{ $category->category_name }}</span>
                        <span class="number">{{ number_format($category->businesses_count) }}</span>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- <div class="row mt-5 justify-content-center tex-center">
            <div class="col-md-4">
                <a href="" class="btn btn-block btn-outline-primary btn-md px-5">View All Categories</a>
            </div>
        </div> -->
    </div>
</div>
