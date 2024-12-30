<div class="col-lg-<?php echo e($colSize ?? '3'); ?>">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-start">
                <div class="col-10">
                    <h5 class="card-title mb-9 fs-4 fw-normal"><?php echo e($title); ?></h5>
                    <h4 class="fw-semibold mb-0"><?php echo e($value ?? 0); ?></h4>
                </div>

                <div class="col-2">
                    <div class="d-flex justify-content-end">
                        <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                            <i class="<?php echo e($icon); ?> fs-6"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/components/stat-card.blade.php ENDPATH**/ ?>