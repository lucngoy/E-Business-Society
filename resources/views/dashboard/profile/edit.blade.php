@extends('layouts.dashboard-layout')
@section('title', 'Settings')
@section('content')
  <div class="container-fluid">
    <div class="row">
      <!-- User Profile Update -->
      <div class="col-lg-6 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">User Profile</h5>

            <!-- Success Message -->
            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
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

            <form method="POST" action="{{ route('profile.update') }}">
              @csrf
              @method('PUT')

              <div class="mb-3">
                <label for="name" class="form-label">User Name</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" placeholder="Name" class="form-control" id="name" required>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" placeholder="Email" class="form-control" id="email" required>
              </div>

              <div class="mb-3">
                <label for="role" class="form-label">Change Profile Role</label>
                <select name="role" class="form-control" id="role" required>
                  @if(auth()->user()->role == 'admin')
                    <option value="admin">Admin</option>
                  @else
                    <option value="user" {{ auth()->user()->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="business_owner" {{ auth()->user()->role == 'business_owner' ? 'selected' : '' }}>Business Owner</option>
                  @endif
                </select>
              </div>

              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Password Update -->
      <div class="col-lg-6 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Change Password</h5>

            <form action="{{ route('password.update') }}" method="POST">
              @csrf
              @method('PUT')

              <div class="mb-3">
                <label for="currentPassword" class="form-label">Current Password</label>
                <input type="password" name="current_password" id="currentPassword" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <input type="password" name="new_password" id="newPassword" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                <input type="password" name="confirm_password" id="confirmPassword" class="form-control" required>
              </div>

              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
