<?php $__env->startSection('title', 'Add Businesses'); ?>
<?php $__env->startSection('content'); ?>
    <?php if($userRole === 'admin' || $userRole === 'business_owner'): ?>
        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Add Business</h5>

                        <!-- Affichage du message de succès -->
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <!-- Affichage des messages d'erreur -->
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Formulaire d'ajout d'entreprise -->
                        <form action="<?php echo e(route('businesses.store')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>  <!-- Protection CSRF -->

                            <div class="mb-3">
                                <label for="name" class="form-label">Business Name</label>
                                <input type="text" name="business_name" class="form-control" id="name" value="<?php echo e(old('business_name')); ?>">
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" class="form-control" id="category_id">
                                    <option value="">Choose Category</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(is_null($category->parent_id)): ?> <!-- Vérifie si parent_id est null -->
                                            <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>><?php echo e($category->category_name); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control"><?php echo e(old('description')); ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" id="address" class="form-control" value="<?php echo e(old('address')); ?>">
                            </div>

                            <div class="mb-3">
                                <label for="latitude" class="form-label">latitude</label>
                                <input type="text" name="latitude" id="latitude" class="form-control" value="<?php echo e(old('latitude')); ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="longitude" class="form-label">longitude</label>
                                <input type="text" name="longitude" id="longitude" class="form-control" value="<?php echo e(old('longitude')); ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="map" class="form-label">Pick Where Your Business Is Located</label>
                                <div id="map" style="height: 400px;z-index: 9;"></div>
                            </div>

                            <div class="mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" name="website" class="form-control" id="website" value="<?php echo e(old('website')); ?>">
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" name="phone" class="form-control" id="phone" value="<?php echo e(old('phone')); ?>">
                            </div>

                            <div class="mb-3">
                                <label for="opening_hours" class="form-label">Opening Hours</label>
                                <textarea name="opening_hours" placeholder="e.g: Mon-Sun: 12:00 PM - 10:00 PM" class="form-control" id="opening_hours" ><?php echo e(old('opening_hours')); ?></textarea>
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

        <!-- Leaflet JS - IMPORTANT: le charger APRÈS la définition du div map -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Initialisation de la carte
                const map = L.map("map").setView([0, 0], 2); // Vue initiale sur le globe

                // Ajouter une couche de tuiles
                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // Ajouter un marqueur
                const marker = L.marker([0, 0], { draggable: true }).addTo(map);

                // Fonction pour obtenir la géolocalisation de l'utilisateur
                function getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;

                            // Centrer la carte sur la position de l'utilisateur
                            map.setView([lat, lng], 13); // Zoom à 13 pour une vue plus proche

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

                // Mettre à jour les champs lorsque le marqueur est déplacé
                marker.on("dragend", function () {
                    const lat = marker.getLatLng().lat.toFixed(6);
                    const lng = marker.getLatLng().lng.toFixed(6);

                    document.getElementById("latitude").value = lat;
                    document.getElementById("longitude").value = lng;
                });

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

    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            Access Denied
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/dashboard/businesses/create.blade.php ENDPATH**/ ?>