@extends('layouts.dashboard-layout')
@section('title', 'Overview')
@section('content')
    @if ($userRole === 'admin')
        <!--  Statistiques globales -->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                    <!-- Total Total Businesses -->
                    @component('components.stat-card', [
                        'title' => 'Total Businesses',
                        'value' => $totalBusinesses,
                        'icon' => 'ti ti-building',
                        'colSize' => 3
                    ])
                    @endcomponent

                    <!-- Total Total Reviews -->
                    @component('components.stat-card', [
                        'title' => 'Total Reviews',
                        'value' => $totalReviews,
                        'icon' => 'ti ti-stars',
                        'colSize' => 3
                    ])
                    @endcomponent

                    <!-- Total Total Users -->
                    @component('components.stat-card', [
                        'title' => 'Total Users',
                        'value' => $totalUsers,
                        'icon' => 'ti ti-users',
                        'colSize' => 3
                    ])
                    @endcomponent

                    <!-- Average Ratin -->
                    @component('components.stat-card', [
                        'title' => 'Average Rating',
                        'value' => number_format($averageRating,1).'/5',
                        'icon' => 'ti ti-star',
                        'colSize' => 3
                    ])
                    @endcomponent

                </div>
            </div>
        </div>


        <!-- Graphiques et tendances -->
        <div class="row">
            
            <!-- Graphique 1 : Nombre d’entreprises inscrites par mois (évolution sur les 12 derniers mois) -->
            <div class="col-lg-6 d-flex align-items-strech">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Businesses Overview</h5>
                            </div>
                            <!-- <div>
                                <select class="form-select">
                                <option value="1">March 2023</option>
                                <option value="2">April 2023</option>
                                <option value="3">May 2023</option>
                                <option value="4">June 2023</option>
                                </select>
                            </div> -->
                        </div>

                        <!-- Message -->
                        @if(empty($businessCountsByMonth))
                            <div class="alert alert-danger" id="BusinessesByCategoriesAlert">No Businesses found</div>
                        @else
                            <!-- Chart -->
                            <div id="chartBusinesses"></div>
                        @endif
                        
                        <script>
                            const businessCountsByMonth = @json($businessCountsByMonth);
                            console.log("businessCountsByMonth : ", businessCountsByMonth);
                        </script>
                    </div>
                </div>
            </div>

            <!-- Graphique 2 : Nombre d’avis soumis par mois. -->
            <div class="col-lg-6 d-flex align-items-strech">
                <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Reviews Overview</h5>
                        </div>
                    </div>

                    <!-- Message -->
                    @if(empty($reviewsCountsByMonth))
                        <div class="alert alert-danger" id="BusinessesByCategoriesAlert">No Reviews found</div>
                    @else
                        <!-- Chart -->
                        <div id="chartReviews"></div>
                    @endif

                    <script>
                        const reviewsCountsByMonth = @json($reviewsCountsByMonth);
                    </script>
                </div>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Graphique 3 : Catégories les plus populaires (distribution des entreprises par catégorie). -->
            <div class="col-lg-12 d-flex align-items-strech">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Businnesses By Categories</h5>
                            </div>
                        </div>
                        <!-- Message -->
                        @if(empty($categoriesData))
                            <div class="alert alert-danger" id="categoriesAlert">No Categories found</div>
                        @else
                            <!-- Chart -->
                            <div id="chartCategories"></div>
                        @endif
                        <script>
                            const businessCounts = @json($businessCounts);
                            const categories = @json($categories);
                        </script>
                    </div>
                </div>
            </div>

        </div>

        <!-- Quick Links -->
        <div class="row">
            <!-- Links -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Quick Actions</h5>
                        <a href="{{ route('businesses.create') }}" class="btn btn-light">Add New Business</a>
                        <a href="{{ route('dashboard.reviews') }}" class="btn btn-light">Moderate Reviews</a>
                        <a href="{{ route('dashboard.users') }}" class="btn btn-light">Manage Users</a>
                    </div>
                </div>
            </div>

            <!-- Form add category -->
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Add New Category</h5>
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <input type="text" name="category_name" placeholder="Category Name" id="category_name" class="form-control" value="{{ old('category_name') }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    <!-- ############################ Business Owner Overview -->
    @elseif($userRole === 'business_owner')

        <!--  Statistiques globales -->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                    <!-- Total Total Businesses -->
                    @component('components.stat-card', [
                        'title' => 'My Businesses',
                        'value' => $myBusinesses,
                        'icon' => 'ti ti-building',
                        'colSize' => 4
                    ])
                    @endcomponent

                    <!-- Total Reviews -->
                    @component('components.stat-card', [
                        'title' => 'Total Reviews',
                        'value' => $totalReviews,
                        'icon' => 'ti ti-stars',
                        'colSize' => 4
                    ])
                    @endcomponent

                    <!-- Average Rating -->
                    @component('components.stat-card', [
                        'title' => 'Average Rating',
                        'value' => number_format($averageRating,1).'/5',
                        'icon' => 'ti ti-star',
                        'colSize' => 4
                    ])
                    @endcomponent

                </div>
            </div>
        </div>


        <div class="row">
            <!-- Business performance -->
            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Business performance</h5>
                        
                        @if ($businesses->isEmpty())
                            <div class="alert alert-warning" role="alert">
                                No reviews found.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-striped mb-0" style="width:100%">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Business Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Reviews</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Average Rating</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Actions</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($businesses as $business)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $business->business_name }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $business->reviews_count }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ number_format($business->reviews_avg_rating, 1) }}/5</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="{{ route('businesses.show', $business) }}" class="dropdown-item">View</a>
                                                            <a href="{{ route('businesses.edit', $business) }}" class="dropdown-item">Edit</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Reviews received recently -->
            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Recent Reviews</h5>

                        @if ($reviews->isEmpty())
                            <div class="alert alert-warning" role="alert">
                                No reviews found.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table  id="myTable2" class="table table-bordered table-striped mb-0" style="width:100%">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Business Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Rating</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Comment</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">User</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reviews as $review)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $review->business->business_name}}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $review->rating }}/5</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ Str::limit($review->comment, 100) }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $review->user->name }}</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>

        <!-- ##################### -->

        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card col-md-12">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Quick Actions</h5>
                        <a href="{{ route('businesses.create') }}" class="btn btn-light">Add New Business</a>
                        <a href="{{ route('dashboard.reviews') }}" class="btn btn-light">Manage Reviews</a>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="alert alert-danger" role="alert">
            Acces Denied
        </div>
    @endif
@endsection
