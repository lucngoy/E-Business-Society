@extends('layouts.dashboard-layout')
@section('title', 'Edit Business')
@section('content')

    @if ($userRole === 'admin' || $userRole === 'business_owner')
        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Edit Business</h5>

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

                        <form action="{{ route('businesses.update', $business) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="business_name" class="form-label">Business Name</label>
                                <input type="text" name="business_name" id="business_name" class="form-control" value="{{ old('business_name', $business->business_name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" class="form-control" id="category_id">
                                    <option value="">Choose Category</option>
                                    @foreach($categories as $category)
                                        @if(is_null($category->parent_id)) <!-- Vérifie si parent_id est null -->
                                            <option value="{{ $category->id }}" {{ $business->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $business->address) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="latitude" class="form-label">latitude</label>
                                <input type="text" name="latitude" id="latitude" class="form-control" value="{{ old('latitude', $business->latitude) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="longitude" class="form-label">longitude</label>
                                <input type="text" name="longitude" id="longitude" class="form-control" value="{{ old('longitude', $business->longitude) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="map" class="form-label">Pick Where Your Business Is Located</label>
                                <div id="map" style="height: 400px;z-index: 9;"></div>
                            </div>

                            <div class="mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" name="website" class="form-control" id="website" value="{{ old('website', $business->website) }}">
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $business->phone) }}">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description', $business->description) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="opening_hours" class="form-label">Opening Hours</label>
                                <textarea name="opening_hours" placeholder="e.g: Monday 08:30Am-5:30PM, Tuesday 08:30Am-5:30PM, Wendnesday 08:30Am-5:30PM, ..." class="form-control" id="opening_hours" >{{ old('opening_hours', $business->opening_hours) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" id="image" accept="image/*">
                            </div>

                            <button type="submit" class="btn btn-primary">Update Business</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Leaflet JS - IMPORTANT: le charger APRÈS la définition du div map -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Récupérer les coordonnées du business depuis les variables PHP
                const businessLat = {{ $business->latitude }};
                const businessLng = {{ $business->longitude }};

                // Initialisation de la carte avec des coordonnées par défaut (si latitude et longitude sont nulles)
                const map = L.map("map").setView([businessLat !== 0 ? businessLat : 0, businessLng !== 0 ? businessLng : 0], businessLat !== 0 ? 13 : 2);

                // Ajouter une couche de tuiles
                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // Ajouter un marqueur à la carte
                const marker = L.marker([businessLat !== 0 ? businessLat : 0, businessLng !== 0 ? businessLng : 0], { draggable: true }).addTo(map);

                // Mettre à jour les champs latitude et longitude si le marqueur est déplacé
                marker.on("dragend", function () {
                    const lat = marker.getLatLng().lat.toFixed(6);
                    const lng = marker.getLatLng().lng.toFixed(6);

                    document.getElementById("latitude").value = lat;
                    document.getElementById("longitude").value = lng;
                });

                // Si les coordonnées sont 0, on demande la géolocalisation de l'utilisateur
                if (businessLat === 0 && businessLng === 0) {
                    function getLocation() {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function (position) {
                                const lat = position.coords.latitude;
                                const lng = position.coords.longitude;

                                // Centrer la carte sur la position de l'utilisateur
                                map.setView([lat, lng], 13);

                                // Déplacer le marqueur sur la position de l'utilisateur
                                marker.setLatLng([lat, lng]);

                                // Mettre à jour les champs latitude et longitude
                                document.getElementById("latitude").value = lat.toFixed(6);
                                document.getElementById("longitude").value = lng.toFixed(6);
                            }, function (error) {
                                console.warn("Geolocation error: " + error.message);
                            });
                        } else {
                            alert("Geolocation is not supported by this browser.");
                        }
                    }

                    // Appeler la fonction pour obtenir la géolocalisation de l'utilisateur
                    getLocation();
                }

                // Mettre à jour le marqueur en cliquant sur la carte
                map.on("click", function (e) {
                    const lat = e.latlng.lat.toFixed(6);
                    const lng = e.latlng.lng.toFixed(6);

                    marker.setLatLng([lat, lng]);

                    document.getElementById("latitude").value = lat;
                    document.getElementById("longitude").value = lng;
                });
            });

        </script>

    @else
        <div class="alert alert-danger" role="alert">
            Access Denied
        </div>
    @endif

@endsection
