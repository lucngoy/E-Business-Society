@extends('layouts.dashboard-layout')
@section('title', 'Settings')
@section('content')
  <div class="container-fluid">
    <!-- Success Message -->
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    @if (session('error'))
      <div class="alert alert-warning">
        {{ session('error') }}
      </div>
    @endif

    <!-- Error Messages -->
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <div class="row">
      <!-- User Profile Update -->
      <div class="col-lg-6 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">User Profile</h5>

            <form method="POST" action="{{ route('dashboard.settings.updateProfile') }}">
              @csrf
              @method('PUT')
              <!-- Champs pour mettre à jour le profil -->
              <div class="mb-3">
                  <label for="name" class="form-label">User Name</label>
                  <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control" id="name" required>
              </div>
              <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control" id="email" required>
              </div>
              <div class="mb-3">
                  <label for="role" class="form-label">Role</label>
                  <select name="role" class="form-control" id="role" required>
                    @if(auth()->user()->role == 'admin')
                      <option value="admin">Admin</option>
                    @else
                      <option value="user" {{ auth()->user()->role == 'user' ? 'selected' : '' }}>User</option>
                      <option value="business_owner" {{ auth()->user()->role == 'business_owner' ? 'selected' : '' }}>Business Owner</option>
                    @endif
                  </select>
              </div>
              <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Password Update -->
      <div class="col-lg-6 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Change Password</h5>

            <form method="POST" action="{{ route('dashboard.settings.updatePassword') }}">
              @csrf
              @method('PUT')
              <!-- Champs pour mettre à jour le mot de passe -->
              <div class="mb-3">
                  <label for="current_password" class="form-label">Current Password</label>
                  <input type="password" name="current_password" id="current_password" class="form-control" required>
              </div>
              <div class="mb-3">
                  <label for="new_password" class="form-label">New Password</label>
                  <input type="password" name="new_password" id="new_password" class="form-control" required>
              </div>
              <div class="mb-3">
                  <label for="confirm_password" class="form-label">Confirm New Password</label>
                  <input type="password" name="new_password_confirmation" id="confirm_password" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-primary">Update Password</button>
            </form>
          </div>
        </div>
      </div>
      @if(auth()->user()->role != 'admin')
        <div class="col-lg-12 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body p-4">
              <h5 class="card-title fw-semibold mb-4">Delete My Account</h5>
              <form action="{{ route('profile.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDeletion(event);">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>

              <script>
                function confirmDeletion(event) {
                    // Affiche une boîte de confirmation
                    if (!confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                        event.preventDefault(); // Empêche l'envoi du formulaire si l'utilisateur clique sur "Annuler"
                        return false;
                    }
                    return true; // Permet l'envoi du formulaire si l'utilisateur clique sur "OK"
                }
              </script>
            </div>
          </div>
        </div>
      @endif
    </div>
  </div>
@endsection
