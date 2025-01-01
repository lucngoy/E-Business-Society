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
                        <h5 class="card-title fw-semibold mb-4">Businesses Filter</h5>

                        <form id="filterForm" method="GET" action="{{ route('businesses.index') }}">
                            <div class="mb-3">
                                <select class="form-control" name="status" onchange="applyFilter()">
                                    <option value="">All Businesses</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Businesses</option>
                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved Businesses</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected Businesses</option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive Businesses</option>
                                </select>
                            </div>
                        </form>
                        <script>
                            function applyFilter() {
                                document.getElementById('filterForm').submit();
                            }
                        </script>
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
                            <div class="table-responsive"><!-- table-responsive -->
                                <table id="myTable" class="table table-bordered table-striped mb-0" style="width:100%"><!-- text-nowrap  -->
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

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Status</h6>
                                        </th>

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
                                                <p class="mb-0 fw-normal">{{ Str::limit($business->description, 50) }}</p>
                                            </td>

                                            <td class="border-bottom-0">
                                                <a href="" class="mb-0 fw-normal">{{ Str::limit($business->address, 50) }}</a>
                                            </td>

                                            <td class="border-bottom-0">
                                                <a href="{{ $business->website }}" target="_blank" class="mb-0 fw-normal">Visit Website</a>
                                            </td>

                                            <td class="border-bottom-0">
                                                <a href="tel:{{ $business->phone }}" class="mb-0 fw-normal">Call Now</a>
                                            </td>

                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $business->status }}</p>
                                            </td>

                                            <td class="border-bottom-0">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a href="{{ route('businesses.show', $business) }}" class="dropdown-item">View</a>
                                                        <a href="{{ route('businesses.edit', $business) }}" class="dropdown-item">Edit</a>

                                                        <!-- Si l'admin peut approver ou rejeter la demande -->
                                                        @if($user->isAdmin())
                                                            <div class="dropdown-divider"></div>

                                                            @if($business->status != 'approved')
                                                            <form action="{{ route('businesses.changeStatus', $business) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="approved">
                                                                <button type="submit" class="dropdown-item">Set Approve</button>
                                                            </form>
                                                            @endif

                                                            @if($business->status != 'rejected')
                                                            <form action="{{ route('businesses.changeStatus', $business) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="rejected">
                                                                <button type="submit" class="dropdown-item">Set Reject</button>
                                                            </form>
                                                            @endif

                                                            @if($business->status != 'pending')
                                                            <form action="{{ route('businesses.changeStatus', $business) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="pending">
                                                                <button type="submit" class="dropdown-item">Set Pending</button>
                                                            </form>
                                                            @endif

                                                            <div class="dropdown-divider"></div>
                                                        @endif

                                                        <!-- <form action="{{ route('businesses.changeStatus', $business) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="inactive">
                                                            <button type="submit" class="dropdown-item">Set Inactive</button>
                                                        </form> -->

                                                        <form action="{{ route('businesses.destroy', $business) }}" method="POST" style="display:inhirit;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="confirmDeletion(event)" class="dropdown-item text-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>

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
            {{ $businesses->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
        </div>
    @else
        <div class="alert alert-danger" role="alert">
            Acces Denied
        </div>
    @endif
@endsection