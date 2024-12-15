@extends('layouts.dashboard-layout')
@section('title', 'Categories')
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

            <!-- Form for add new category -->
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
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

        <!-- Table -->

        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">List of categories</h5>

                        @if ($categories->isEmpty())
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
                                            <h6 class="fw-semibold mb-0">Actions</h6>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td class="border-bottom-0">{{ $category->id }}</td>
                                                
                                                <td class="border-bottom-0">
                                                    {{ $category->category_name }}
                                                    <!-- <span class="fw-normal">Web Designer</span> -->
                                                </td>

                                                <td class="border-bottom-0">

                                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDeletion(event);">
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
        <div class="pagination">
            
                {{ $categories->links('pagination::bootstrap-4') }}
            
        </div>

    
    @else
        <div class="alert alert-danger" role="alert">
            Acces Denied
        </div>
    @endif
@endsection