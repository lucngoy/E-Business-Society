@extends('layouts.dashboard-layout')
@section('title', 'Reports')
@section('content')
  @if ($userRole === 'admin' || $userRole === 'business_owner')
    <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Reports</h5>
            <p class="mb-0">This is a sample page </p>
          </div>
        </div>
    </div>
  @else
      <div class="alert alert-danger" role="alert">
          Acces Denied
      </div>
  @endif
@endsection