@extends('layouts.dashboard-layout')
@section('title', 'Notifications')
@section('content')
    @if ($userRole === 'admin' || $userRole === 'business_owner')
        <!-- Affichage du message de succès -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Research form -->

        <div class="row">
            <div class="col-lg d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <form method="GET" action="{{ route('categories.index') }}">
                            <div class="mb-3">
                            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search by name or id" class="form-control" id="search" aria-describedby="searchHelp">
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->

        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">List of notifications</h5>

                        @if ($notifications->isEmpty())
                            <div class="alert alert-warning" role="alert">
                                No businesses found.
                            </div>
                        @else
                            <ul>
                                @foreach($notifications as $notification)
                                    <li>{{ $notification->data['message'] }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination">
            {{ $categories->links('pagination::bootstrap-4') }}
        </div>

    @else
        <div class="alert alert-danger" role="alert">
            Acces Denied
        </div>
    @endif
@endsection