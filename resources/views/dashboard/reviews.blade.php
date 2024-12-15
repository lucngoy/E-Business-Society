@extends('layouts.dashboard-layout')
@section('title', 'Reviews')
@section('content')
  @if ($userRole === 'admin' || $userRole === 'business_owner')
    <!-- Affichage du message de succès -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <form method="GET" action="{{ route('dashboard.reviews') }}">
                        <div class="mb-3">
                            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search by business name, rating or comment" class="form-control" id="search" aria-describedby="searchHelp">
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
                    <h5 class="card-title fw-semibold mb-4">Reviews List</h5>

                    @if ($reviews->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            No businesses found.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
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

                                    @if($user->isAdmin())
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Actions</h6>
                                    </th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($reviews as $review)
                                    <tr>

                                        <td class="border-bottom-0">
                                            <a href="{{ route('business.show', $review->business->id) }}" class="mb-0 fw-normal">{{ $review->business->business_name ?? 'No Business' }}</a>
                                        </td>

                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <span class="star {{ $i < $review->rating ? 'active' : '' }}">
                                                        <i class="ti ti-star"></i>
                                                    </span>
                                                @endfor
                                            </p>
                                        </td>

                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ Str::limit($review->comment, 100) }}</p>
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
                                            @if($user->isAdmin())
                                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDeletion(event);">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            @endif

                                            <script>
                                                function confirmDeletion(event) {
                                                    // Affiche une boîte de confirmation
                                                    if (!confirm('Are you sure you want to delete this review? This action cannot be undone.')) {
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

  @else
      <div class="alert alert-danger" role="alert">
          Acces Denied
      </div>
  @endif
@endsection