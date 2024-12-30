<?php $__env->startSection('title', 'Reports'); ?>
<?php $__env->startSection('content'); ?>
  <?php if($userRole === 'admin' || $userRole === 'business_owner'): ?>
    <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Reports</h5>
            <p class="mb-0">This is a sample page </p>
          </div>
        </div>
    </div>
  <?php else: ?>
      <div class="alert alert-danger" role="alert">
          Acces Denied
      </div>
  <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/dashboard/reports.blade.php ENDPATH**/ ?>