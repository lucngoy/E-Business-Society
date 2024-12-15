@extends('layouts.dashboard-layout')
@section('title', 'Businesses')
@section('content')
    @if ($userRole === 'admin' || $userRole === 'business_owner')
        <!-- Affichage du message de succès -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <form method="GET" action="{{ route('businesses.index') }}">
                            <div class="mb-3">
                            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search by name, address and phone" class="form-control" id="exampleInputSearch1" aria-describedby="searchHelp">
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('businesses.create')}}" class="btn btn-outline-primary m-1">Add New Business</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Businesses List</h5>

                        @if ($businesses->isEmpty())
                            <div class="alert alert-warning" role="alert">
                                No businesses found.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Logo</h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Name</h6>
                                        </th>

                                        @if($user->isAdmin())
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Owner</h6>
                                        </th>
                                        @endif

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Category</h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Description</h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Address</h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Website</h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Phone</h6>
                                        </th>

                                        <!-- <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Hours</h6>
                                        </th> -->

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Actions</h6>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($businesses as $business)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <div class="pic-in-table" >
                                                    <img src="{{ $business->image ? asset('storage/' . $business->image) : asset('images/default-img.png') }}" alt="Business Image">
                                                </div>
                                            </td>

                                            <td class="border-bottom-0">
                                                <a href="{{ route('businesses.show', $business) }}" class="mb-0 fw-normal">{{ $business->business_name }}</a>
                                            </td>

                                            @if($user->isAdmin())
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-1">{{ $business->owner->name ?? 'N/A' }}</h6>
                                            </td>
                                            @endif

                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $business->category->category_name ?? 'N/A' }}</p>
                                            </td>

                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ Str::limit($business->description, 100) }}</p>
                                            </td>

                                            <td class="border-bottom-0">
                                                <a href="" class="mb-0 fw-normal">{{ Str::limit($business->description, 50) }}</a>
                                            </td>

                                            <td class="border-bottom-0">
                                                <a href="{{ $business->website }}" target="_blank" class="mb-0 fw-normal">Visit Website</a>
                                            </td>

                                            <td class="border-bottom-0">
                                                <a href="tel:{{ $business->phone }}" class="mb-0 fw-normal">Call Now</a>
                                            </td>

                                            <!-- <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">
                                                    dimanche	10:00–22:00
                                                    lundi	08:00–22:00
                                                    mardi	08:00–22:00
                                                    mercredi	08:00–22:00
                                                    jeudi	08:00–22:00
                                                    vendredi	08:00–22:00
                                                    samedi	10:00–22:00
                                                </p>
                                            </td> -->

                                            <td class="border-bottom-0">
                                                <a href="{{ route('businesses.show', $business) }}" class="btn btn-primary btn-sm">View</a>
                                                <a href="{{ route('businesses.edit', $business) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('businesses.destroy', $business) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDeletion(event);">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                                <script>
                                                    function confirmDeletion(event) {
                                                        // Affiche une boîte de confirmation
                                                        if (!confirm('Are you sure you want to delete this business? This action cannot be undone.')) {
                                                            event.preventDefault(); // Empêche l'envoi du formulaire si l'utilisateur clique sur "Annuler"
                                                            return false;
                                                        }
                                                        return true; // Permet l'envoi du formulaire si l'utilisateur clique sur "OK"
                                                    }
                                                </script>
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
        <!-- Pagination -->
        <div class="pagination">
            {{ $businesses->links('pagination::bootstrap-4') }}
        </div>
    @else
        <div class="alert alert-danger" role="alert">
            Acces Denied
        </div>
    @endif
@endsection