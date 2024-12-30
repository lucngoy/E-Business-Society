@extends('layouts.dashboard-layout')
@section('title', 'Notifications')
@section('content')
    
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
                    <form method="GET" action="{{ route('notifications.index') }}">
                        <div class="mb-3">
                        <input type="search" name="search" value="{{ request('search') }}" placeholder="Search" class="form-control" id="search" aria-describedby="searchHelp">
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
                    <div class="mb-4" style="display: flex; align-items: center; justify-content: space-between;">
                        <h5 class="card-title fw-semibold mb-0">List of notifications</h5>

                        @if($totalNotifications > 0)
                            <form method="POST" action="{{ route('notifications.markAllAsRead') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">Mark All as Read</button>
                            </form>
                        @endif
                    </div>

                    @if ($notifications->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            No notifications found.
                        </div>
                    @else
                    <div class="table-responsive">

                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notifications as $notification)
                                    <tr>
                                        <td>{{ $notification->data['message'] }}</td>
                                        <td>{{ $notification->created_at->diffForHumans() }}</td>
                                        <td>
                                            @if(isset($notification->data['url']))
                                                <a href="{{ $notification->data['url'] }}" class="btn btn-sm btn-primary">View</a>
                                            @else
                                                <span>No link available</span>
                                            @endif
                                        </td>
                                        <td>
                                        @if ($notification->read_at)
                                            <!-- La notification a été lue -->
                                            <span>Notification Read</span>
                                        @else
                                            <!-- Option pour marquer la notification comme lue -->
                                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-primary">Mark as Read</button>
                                            </form>
                                        @endif

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
    <div class="pagination">
        {{ $notifications->links('pagination::bootstrap-4') }}
    </div>
@endsection