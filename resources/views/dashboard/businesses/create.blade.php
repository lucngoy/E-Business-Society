@extends('layouts.dashboard-layout')
@section('title', 'Add Businesses')
@section('content')
    @if ($userRole === 'admin' || $userRole === 'business_owner')
        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Add Business</h5>

                        <!-- Affichage du message de succès -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Affichage des messages d'erreur -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Formulaire d'ajout d'entreprise -->
                        <form action="{{ route('businesses.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf  <!-- Protection CSRF -->

                            <div class="mb-3">
                                <label for="name" class="form-label">Business Name</label>
                                <input type="text" name="business_name" class="form-control" id="name" value="{{ old('business_name') }}">
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" class="form-control" id="category_id">
                                    <option value="">Choose Category</option>
                                    @foreach($categories as $category)
                                        @if(is_null($category->parent_id)) <!-- Vérifie si parent_id est null -->
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                            </div>

                            <div class="mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" name="website" class="form-control" id="website" value="{{ old('website') }}">
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" name="phone" class="form-control" id="phone" value="{{ old('phone') }}">
                            </div>

                            <div class="mb-3">
                                <label for="opening_hours" class="form-label">Opening Hours</label>
                                <textarea name="opening_hours" placeholder="e.g: Monday 08:30Am-5:30PM, Tuesday 08:30Am-5:30PM, Wendnesday 08:30Am-5:30PM, ..." class="form-control" id="opening_hours" >{{ old('opening_hours') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" id="image" accept="image/*">
                            </div>


                            <button type="submit" class="btn btn-primary">Add Business</button>
                            <button type="reset" class="btn btn-danger">Reset All</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger" role="alert">
            Access Denied
        </div>
    @endif
@endsection
