<?php $__env->startSection('title', 'Notifications'); ?>
<?php $__env->startSection('content'); ?>
    
    <!-- Affichage du message de succès -->
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <!-- Research form -->

    <div class="row">
        <div class="col-lg d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <form method="GET" action="<?php echo e(route('notifications.index')); ?>">
                        <div class="mb-3">
                        <input type="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search" class="form-control" id="search" aria-describedby="searchHelp">
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->

    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="mb-4" style="display: flex; align-items: center; justify-content: space-between;">
                        <h5 class="card-title fw-semibold mb-0">List of notifications</h5>

                        <?php if($totalNotifications > 0): ?>
                            <form method="POST" action="<?php echo e(route('notifications.markAllAsRead')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-primary">Mark All as Read</button>
                            </form>
                        <?php endif; ?>
                    </div>

                    <?php if($notifications->isEmpty()): ?>
                        <div class="alert alert-warning" role="alert">
                            No notifications found.
                        </div>
                    <?php else: ?>
                    <div class="table-responsive">

                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($notification->data['message']); ?></td>
                                        <td><?php echo e($notification->created_at->diffForHumans()); ?></td>
                                        <td>
                                            <?php if(isset($notification->data['url'])): ?>
                                                <a href="<?php echo e($notification->data['url']); ?>" class="btn btn-sm btn-primary">View</a>
                                            <?php else: ?>
                                                <span>No link available</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                        <?php if($notification->read_at): ?>
                                            <!-- La notification a été lue -->
                                            <span>Notification Read</span>
                                        <?php else: ?>
                                            <!-- Option pour marquer la notification comme lue -->
                                            <form action="<?php echo e(route('notifications.markAsRead', $notification->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <button type="submit" class="btn btn-sm btn-primary">Mark as Read</button>
                                            </form>
                                        <?php endif; ?>

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
    <div class="pagination">
        <?php echo e($notifications->links('pagination::bootstrap-4')); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/dashboard/notifications/index.blade.php ENDPATH**/ ?>