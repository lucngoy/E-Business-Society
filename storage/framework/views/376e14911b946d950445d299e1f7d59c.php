<?php $__env->startSection('title', 'Overview'); ?>
<?php $__env->startSection('content'); ?>
    <?php if($userRole === 'admin'): ?>
        <!--  Statistiques globales -->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                    <!-- Total Total Businesses -->
                    <?php $__env->startComponent('components.stat-card', [
                        'title' => 'Total Businesses',
                        'value' => $totalBusinesses,
                        'icon' => 'ti ti-building',
                        'colSize' => 3
                    ]); ?>
                    <?php echo $__env->renderComponent(); ?>

                    <!-- Total Total Reviews -->
                    <?php $__env->startComponent('components.stat-card', [
                        'title' => 'Total Reviews',
                        'value' => $totalReviews,
                        'icon' => 'ti ti-stars',
                        'colSize' => 3
                    ]); ?>
                    <?php echo $__env->renderComponent(); ?>

                    <!-- Total Total Users -->
                    <?php $__env->startComponent('components.stat-card', [
                        'title' => 'Total Users',
                        'value' => $totalUsers,
                        'icon' => 'ti ti-users',
                        'colSize' => 3
                    ]); ?>
                    <?php echo $__env->renderComponent(); ?>

                    <!-- Average Ratin -->
                    <?php $__env->startComponent('components.stat-card', [
                        'title' => 'Average Rating',
                        'value' => number_format($averageRating,1).'/5',
                        'icon' => 'ti ti-star',
                        'colSize' => 3
                    ]); ?>
                    <?php echo $__env->renderComponent(); ?>

                </div>
            </div>
        </div>


        <!-- Graphiques et tendances -->
        <div class="row">
            
            <!-- Graphique 1 : Nombre d’entreprises inscrites par mois (évolution sur les 12 derniers mois) -->
            <div class="col-lg-6 d-flex align-items-strech">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Businesses Overview</h5>
                            </div>
                            <!-- <div>
                                <select class="form-select">
                                <option value="1">March 2023</option>
                                <option value="2">April 2023</option>
                                <option value="3">May 2023</option>
                                <option value="4">June 2023</option>
                                </select>
                            </div> -->
                        </div>

                        <!-- Message -->
                        <?php if(empty($businessCountsByMonth)): ?>
                            <div class="alert alert-danger" id="BusinessesByCategoriesAlert">No Businesses found</div>
                        <?php else: ?>
                            <!-- Chart -->
                            <div id="chartBusinesses"></div>
                        <?php endif; ?>
                        
                        <script>
                            const businessCountsByMonth = <?php echo json_encode($businessCountsByMonth, 15, 512) ?>;
                            console.log("businessCountsByMonth : ", businessCountsByMonth);
                        </script>
                    </div>
                </div>
            </div>

            <!-- Graphique 2 : Nombre d’avis soumis par mois. -->
            <div class="col-lg-6 d-flex align-items-strech">
                <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Reviews Overview</h5>
                        </div>
                    </div>

                    <!-- Message -->
                    <?php if(empty($reviewsCountsByMonth)): ?>
                        <div class="alert alert-danger" id="BusinessesByCategoriesAlert">No Reviews found</div>
                    <?php else: ?>
                        <!-- Chart -->
                        <div id="chartReviews"></div>
                    <?php endif; ?>

                    <script>
                        const reviewsCountsByMonth = <?php echo json_encode($reviewsCountsByMonth, 15, 512) ?>;
                    </script>
                </div>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Graphique 3 : Catégories les plus populaires (distribution des entreprises par catégorie). -->
            <div class="col-lg-12 d-flex align-items-strech">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Businnesses By Categories</h5>
                            </div>
                        </div>
                        <!-- Message -->
                        <?php if(empty($categoriesData)): ?>
                            <div class="alert alert-danger" id="categoriesAlert">No Categories found</div>
                        <?php else: ?>
                            <!-- Chart -->
                            <div id="chartCategories"></div>
                        <?php endif; ?>
                        <script>
                            const businessCounts = <?php echo json_encode($businessCounts, 15, 512) ?>;
                            const categories = <?php echo json_encode($categories, 15, 512) ?>;
                        </script>
                    </div>
                </div>
            </div>

        </div>

        <!-- Quick Links -->
        <div class="row">
            <!-- Links -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Quick Actions</h5>
                        <a href="<?php echo e(route('businesses.create')); ?>" class="btn btn-light">Add New Business</a>
                        <a href="<?php echo e(route('dashboard.reviews')); ?>" class="btn btn-light">Moderate Reviews</a>
                        <a href="<?php echo e(route('dashboard.users')); ?>" class="btn btn-light">Manage Users</a>
                    </div>
                </div>
            </div>

            <!-- Form add category -->
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Add New Category</h5>
                        <form action="<?php echo e(route('categories.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <div class="mb-3">
                                <input type="text" name="category_name" placeholder="Category Name" id="category_name" class="form-control" value="<?php echo e(old('category_name')); ?>" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    <!-- ############################ Business Owner Overview -->
    <?php elseif($userRole === 'business_owner'): ?>

        <!--  Statistiques globales -->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                    <!-- Total Total Businesses -->
                    <?php $__env->startComponent('components.stat-card', [
                        'title' => 'My Businesses',
                        'value' => $myBusinesses,
                        'icon' => 'ti ti-building',
                        'colSize' => 4
                    ]); ?>
                    <?php echo $__env->renderComponent(); ?>

                    <!-- Total Reviews -->
                    <?php $__env->startComponent('components.stat-card', [
                        'title' => 'Total Reviews',
                        'value' => $totalReviews,
                        'icon' => 'ti ti-stars',
                        'colSize' => 4
                    ]); ?>
                    <?php echo $__env->renderComponent(); ?>

                    <!-- Average Rating -->
                    <?php $__env->startComponent('components.stat-card', [
                        'title' => 'Average Rating',
                        'value' => number_format($averageRating,1).'/5',
                        'icon' => 'ti ti-star',
                        'colSize' => 4
                    ]); ?>
                    <?php echo $__env->renderComponent(); ?>

                </div>
            </div>
        </div>


        <div class="row">
            <!-- Business performance -->
            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Business performance</h5>
                        
                        <?php if($businesses->isEmpty()): ?>
                            <div class="alert alert-warning" role="alert">
                                No reviews found.
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-striped mb-0" style="width:100%">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Business Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Reviews</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Average Rating</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Actions</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $businesses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $business): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($business->business_name); ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($business->reviews_count); ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e(number_format($business->reviews_avg_rating, 1)); ?>/5</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="<?php echo e(route('businesses.show', $business)); ?>" class="dropdown-item">View</a>
                                                            <a href="<?php echo e(route('businesses.edit', $business)); ?>" class="dropdown-item">Edit</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Reviews received recently -->
            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Recent Reviews</h5>

                        <?php if($reviews->isEmpty()): ?>
                            <div class="alert alert-warning" role="alert">
                                No reviews found.
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table  id="myTable2" class="table table-bordered table-striped mb-0" style="width:100%">
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
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">User</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($review->business->business_name); ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($review->rating); ?>/5</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e(Str::limit($review->comment, 100)); ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($review->user->name); ?></p>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        </div>

        <!-- ##################### -->

        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card col-md-12">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Quick Actions</h5>
                        <a href="<?php echo e(route('businesses.create')); ?>" class="btn btn-light">Add New Business</a>
                        <a href="<?php echo e(route('dashboard.reviews')); ?>" class="btn btn-light">Manage Reviews</a>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            Acces Denied
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/dashboard/overview.blade.php ENDPATH**/ ?>