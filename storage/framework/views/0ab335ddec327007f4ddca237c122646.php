<?php $__env->startSection('title', 'Reset Password'); ?>
<?php $__env->startSection('content'); ?>
    <div class="login100-pic js-tilt" data-tilt>
        <img src="<?php echo e(asset('images/img-01.png')); ?>" alt="IMG">
    </div>

    

    <form method="POST" action="<?php echo e(route('password.email')); ?>">
        <?php echo csrf_field(); ?>
        <span class="login100-form-title">
            <?php echo e(__('Reset Password')); ?>

        </span>

        <!-- Session Status -->
        <?php if (isset($component)) { $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-session-status','data' => ['class' => 'mb-4','status' => session('status')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-session-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-4','status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('status'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $attributes = $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $component = $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>

        <!-- Email Address -->
        <div class="wrap-input100 validate-input <?php echo e($errors->has('email') ? 'alert-validate' : ''); ?>" data-validate="<?php echo e($errors->has('email') ? $errors->first('email') : 'Valid email is required: ex@abc.xyz'); ?>">
            <input class="input100" id="email" type="email" name="email" :value="old('email')" autofocus placeholder="<?php echo e(__('Email')); ?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
        </div>

        <!-- Submit Button -->
        <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn">
                <?php echo e(__('Email Password Reset Link')); ?>

            </button>
        </div>

        <div class="text-center p-t-136">
            <a class="txt2" href="<?php echo e(route('login')); ?>">
                <?php echo e(__('Go to login')); ?>

                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/auth/forgot-password.blade.php ENDPATH**/ ?>