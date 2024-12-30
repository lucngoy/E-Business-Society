<?php $__env->startSection('title', 'Reviews'); ?>
<?php $__env->startSection('content'); ?>
  <?php if($userRole === 'admin' || $userRole === 'business_owner'): ?>
    <!-- Affichage du message de succès -->
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <form method="GET" action="<?php echo e(route('dashboard.reviews')); ?>">
                        <div class="mb-3">
                            <input type="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search by business name, rating or comment" class="form-control" id="search" aria-describedby="searchHelp">
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

                    <?php if($reviews->isEmpty()): ?>
                        <div class="alert alert-warning" role="alert">
                            No businesses found.
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
                                        <h6 class="fw-semibold mb-0">Rating</h6>
                                    </th>

                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Comment</h6>
                                    </th>

                                    <?php if($user->isAdmin()): ?>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Actions</h6>
                                    </th>
                                    <?php endif; ?>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>

                                        <td class="border-bottom-0">
                                            <a href="<?php echo e(route('business.show', $review->business->id)); ?>" class="mb-0 fw-normal"><?php echo e($review->business->business_name ?? 'No Business'); ?></a>
                                        </td>

                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">
                                                <?php for($i = 0; $i < 5; $i++): ?>
                                                    <span class="star <?php echo e($i < $review->rating ? 'active' : ''); ?>">
                                                        <i class="ti ti-star"></i>
                                                    </span>
                                                <?php endfor; ?>
                                            </p>
                                        </td>

                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal"><?php echo e(Str::limit($review->comment, 100)); ?></p>
                                        </td>

                                        <?php if($user->isAdmin()): ?>
                                            <td class="border-bottom-0">
                                                <form action="<?php echo e(route('reviews.destroy', $review->id)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirmDeletion(event);">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>

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
                                        <?php endif; ?>
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

  <?php else: ?>
      <div class="alert alert-danger" role="alert">
          Acces Denied
      </div>
  <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/dashboard/reviews.blade.php ENDPATH**/ ?>