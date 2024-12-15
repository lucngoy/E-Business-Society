@extends('layouts.dashboard-layout')
@section('title', 'Users')
@section('content')
    @if ($userRole === 'admin')
        <!-- Affichage du message de succès -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <form method="GET" action="{{ route('dashboard.users') }}">
                            <div class="mb-3">
                            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search by name, email or role" class="form-control" id="search" aria-describedby="searchHelp">
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">List of Registered Users</h5>
                        
                        @if ($users->isEmpty())
                            <div class="alert alert-warning" role="alert">
                                No businesses found.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Id</h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Name</h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Role</h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Email</h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Businesses</h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Actions</h6>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $user->id }}</h6></td>
                                                
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1">{{ $user->name }}</h6>
                                                    <!-- <span class="fw-normal">Web Designer</span> -->
                                                </td>

                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $user->role }}</p>
                                                </td>

                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $user->email }}</p>
                                                </td>

                                                <td class="border-bottom-0">
                                                    <a href="" class="mb-0 fw-normal">Google</a>,
                                                    <a href="" class="mb-0 fw-normal">Facebook</a>,
                                                    <a href="" class="mb-0 fw-normal">Whatsapp</a>,
                                                    <a href="" class="mb-0 fw-normal">Pizza Pizza...</a>
                                                </td>

                                                <td class="border-bottom-0">
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDeletion(event);">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                    <script>
                                                        function confirmDeletion(event) {
                                                            // Affiche une boîte de confirmation
                                                            if (!confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
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
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    @else
        <div class="alert alert-danger" role="alert">
            Acces Denied
        </div>
    @endif
@endsection