@extends('layouts.dashboard-layout')
@section('title', 'Access Denied')
@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="alert alert-danger" role="alert">
                    You do not have permission to access this page.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection