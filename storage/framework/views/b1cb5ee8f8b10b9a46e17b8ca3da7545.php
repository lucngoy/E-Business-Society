<?php $__env->startSection('title', 'Settings'); ?>
<?php $__env->startSection('content'); ?>
  <div class="container-fluid">
    <!-- Success Message -->
    <?php if(session('success')): ?>
      <div class="alert alert-success">
        <?php echo e(session('success')); ?>

      </div>
    <?php endif; ?>

    <!-- Error Messages -->
    <?php if($errors->any()): ?>
      <div class="alert alert-danger">
        <ul>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>
    <div class="row">
      <!-- User Profile Update -->
      <div class="col-lg-6 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">User Profile</h5>

            <form method="POST" action="<?php echo e(route('dashboard.settings.updateProfile')); ?>">
              <?php echo csrf_field(); ?>
              <?php echo method_field('PUT'); ?>
              <!-- Champs pour mettre à jour le profil -->
              <div class="mb-3">
                  <label for="name" class="form-label">User Name</label>
                  <input type="text" name="name" value="<?php echo e(old('name', auth()->user()->name)); ?>" class="form-control" id="name" required>
              </div>
              <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" value="<?php echo e(old('email', auth()->user()->email)); ?>" class="form-control" id="email" required>
              </div>
              <div class="mb-3">
                  <label for="role" class="form-label">Role</label>
                  <select name="role" class="form-control" id="role" required>
                    <?php if(auth()->user()->role == 'admin'): ?>
                      <option value="admin">Admin</option>
                    <?php else: ?>
                      <option value="user" <?php echo e(auth()->user()->role == 'user' ? 'selected' : ''); ?>>User</option>
                      <option value="business_owner" <?php echo e(auth()->user()->role == 'business_owner' ? 'selected' : ''); ?>>Business Owner</option>
                    <?php endif; ?>
                  </select>
              </div>
              <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Password Update -->
      <div class="col-lg-6 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Change Password</h5>

            <form method="POST" action="<?php echo e(route('dashboard.settings.updatePassword')); ?>">
              <?php echo csrf_field(); ?>
              <?php echo method_field('PUT'); ?>
              <!-- Champs pour mettre à jour le mot de passe -->
              <div class="mb-3">
                  <label for="current_password" class="form-label">Current Password</label>
                  <input type="password" name="current_password" id="current_password" class="form-control" required>
              </div>
              <div class="mb-3">
                  <label for="new_password" class="form-label">New Password</label>
                  <input type="password" name="new_password" id="new_password" class="form-control" required>
              </div>
              <div class="mb-3">
                  <label for="confirm_password" class="form-label">Confirm New Password</label>
                  <input type="password" name="new_password_confirmation" id="confirm_password" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-primary">Update Password</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/dashboard/settings.blade.php ENDPATH**/ ?>