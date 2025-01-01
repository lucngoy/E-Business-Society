<?php $__env->startSection('title', 'Register'); ?>
<?php $__env->startSection('content'); ?>
    <div class="login100-pic js-tilt" data-tilt>
        <img src="<?php echo e(asset('images/img-01.png')); ?>" alt="IMG">
    </div>

    <form class="login100-form validate-form" method="POST" action="<?php echo e(route('register')); ?>">
        <a class="txt2" style="display: flex;align-items: center;justify-content: center;" href="<?php echo e(route('home')); ?>">
            Go to the home page
        </a>
        <br>
        <?php echo csrf_field(); ?>
        <span class="login100-form-title">
            <?php echo e(__('Register')); ?>

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

        <!-- Name -->
        <div class="wrap-input100 validate-input <?php echo e($errors->has('name') ? 'alert-validate' : ''); ?>" data-validate="<?php echo e($errors->has('email') ? $errors->first('name') : 'Name is required'); ?>">
            <input class="input100" id="name" class="block mt-1 w-full" type="text" name="name" value="<?php echo e(old('name')); ?>" required autofocus placeholder="<?php echo e(__('Full Name')); ?>" />
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-user" aria-hidden="true"></i>
            </span>
        </div>

        <!-- Email Address -->
        <div class="wrap-input100 validate-input <?php echo e($errors->has('email') ? 'alert-validate' : ''); ?>" data-validate="<?php echo e($errors->has('email') ? $errors->first('email') : 'Valid email is required: ex@abc.xyz'); ?>">
            <input class="input100" id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" autofocus placeholder="<?php echo e(__('Email')); ?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
        </div>


        <!-- Password -->
        <div class="wrap-input100 validate-input <?php echo e($errors->has('password') ? 'alert-validate' : ''); ?>" data-validate="<?php echo e($errors->has('password') ? $errors->first('password') : 'Valid password is required: ex@abc.xyz'); ?>">
            <input class="input100 password-field" id="password" type="password" name="password" placeholder="<?php echo e(__('Password')); ?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
            <!-- Icône pour afficher/masquer le mot de passe -->
            <span class="toggle-password">
                <i class="fa fa-eye-slash"></i>
            </span>
        </div>

        <!-- Confirm Password -->
        <div class="wrap-input100 validate-input <?php echo e($errors->has('password_confirmation') ? 'alert-validate' : ''); ?>" data-validate="<?php echo e($errors->has('password_confirmation') ? $errors->first('password_confirmation') : 'Valid password confirmation is required: ex@abc.xyz'); ?>">
            <input class="input100 password-field" id="password_confirmation" type="password" name="password_confirmation" placeholder="<?php echo e(__('Password confirmation')); ?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
            <!-- Icône pour afficher/masquer le mot de passe -->
            <span class="toggle-password">
                <i class="fa fa-eye-slash"></i>
            </span>
        </div>

        <!-- <label for="captcha" style="margin-bottom: 5px; display: block;">Solve: <?php echo e(session('captcha_question')); ?></label> -->
        <!-- Captcha Arithmétique -->
        <div class="wrap-input100 validate-input <?php echo e($errors->has('captcha') ? 'alert-validate' : ''); ?>" data-validate="<?php echo e($errors->has('captcha') ? $errors->first('captcha') : 'Correct answer is required'); ?>">
            <input class="input100" id="captcha" type="text" name="captcha" placeholder="Solve: <?php echo e(session('captcha_question')); ?>" required>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-calculator" aria-hidden="true"></i>
            </span>
        </div>


        <!-- Remember Me -->
        <!-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400"><?php echo e(__('Remember me')); ?></span>
            </label>
        </div> -->

        <!-- Submit Button -->
        <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn">
                <?php echo e(__('Register')); ?>

            </button>
        </div>

        <div class="text-center p-t-136">
            <a class="txt2" href="<?php echo e(route('login')); ?>">
                <?php echo e(__('Already registered?')); ?>

                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/auth/register.blade.php ENDPATH**/ ?>