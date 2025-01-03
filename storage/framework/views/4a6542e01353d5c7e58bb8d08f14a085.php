<?php $__env->startSection('title', 'Users'); ?>
<?php $__env->startSection('content'); ?>
    <?php if($userRole === 'admin'): ?>
        <!-- Affichage du message de succès -->
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <form method="GET" action="<?php echo e(route('dashboard.users')); ?>">
                            <div class="mb-3">
                            <input type="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search by name, email or role" class="form-control" id="search" aria-describedby="searchHelp">
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
                        <h5 class="card-title fw-semibold mb-4">List of Registered Users</h5>
                        
                        <?php if($users->isEmpty()): ?>
                            <div class="alert alert-warning" role="alert">
                                No businesses found.
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-striped mb-0" style="width:100%">
                                    <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Id</h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Name</h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Role</h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Email</h6>
                                        </th>

                                        <!-- <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Businesses</h6>
                                        </th> -->

                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Actions</h6>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-normal mb-0"><?php echo e($user->id); ?></h6>
                                                </td>
                                                
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-normal mb-0"><?php echo e($user->name); ?></h6>
                                                    <!-- <span class="fw-normal">Web Designer</span> -->
                                                </td>

                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($user->role); ?></p>
                                                </td>

                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?php echo e($user->email); ?></p>
                                                </td>

                                                <!-- <td class="border-bottom-0">
                                                    <a href="" class="mb-0 fw-normal">Google</a>,
                                                    <a href="" class="mb-0 fw-normal">Facebook</a>,
                                                    <a href="" class="mb-0 fw-normal">Whatsapp</a>,
                                                    <a href="" class="mb-0 fw-normal">Pizza Pizza...</a>
                                                </td> -->

                                                <td class="border-bottom-0">
                                                    <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirmDeletion(event);">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                    <script>
                                                        function confirmDeletion(event) {
                                                            // Affiche une boîte de confirmation
                                                            if (!confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                                                                event.preventDefault(); // Empêche l'envoi du formulaire si l'utilisateur clique sur "Annuler"
                                                                return false;
                                                            }
                                                            return true; // Permet l'envoi du formulaire si l'utilisateur clique sur "OK"
                                                        }
                                                    </script>
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
        <!-- Pagination -->
        <div class="pagination">
            <?php echo e($users->links('pagination::bootstrap-4')); ?>

        </div>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            Acces Denied
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/dashboard/users.blade.php ENDPATH**/ ?>