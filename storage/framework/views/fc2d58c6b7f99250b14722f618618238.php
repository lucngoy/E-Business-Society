<?php $__env->startSection('title', 'Listings'); ?>

<?php $__env->startSection('sub-title', 'Discover Local Businesses Tailored to Your Needs'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Inclure sub-header de la page -->
    <?php echo $__env->make('header-page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div id="results" class="col-lg-8">

            <?php if($businesses->isEmpty()): ?>
              <div class="alert alert-warning" role="alert">
                No businesses found matching your search criteria.
              </div>
            <?php else: ?>
              <?php $__currentLoopData = $businesses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $business): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="d-block d-md-flex listing-horizontal">

                      <a href="<?php echo e(route('business.search', ['category' => $business->category->id])); ?>" class="img d-block" style="background-image: url('<?php echo e($business->image ? asset('storage/' . $business->image) : asset('images/default-img.png')); ?>')">
                          <span class="category"><?php echo e($business->category->category_name); ?></span>
                      </a>

                      <div class="lh-content">
                          <!-- <a href="" class="bookmark"><span class="icon-heart"></span></a> -->
                          <h3><a href="<?php echo e(route('business.show', $business->id)); ?>"><?php echo e($business->business_name); ?></a></h3>
                          <p><?php echo e(Str::limit($business->address, 50)); ?></p>

                          <p>
                              <?php for($i = 0; $i < 5; $i++): ?>
                                  <span class="icon-star <?php echo e($i < (int)$business->reviews_avg_rating ? 'text-warning' : 'text-secondary'); ?>"></span>
                              <?php endfor; ?>
                              <span>(<?php echo e($business->reviews_count); ?> Reviews)</span>
                          </p>

                      </div>
                  </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <!-- Pagination -->
              <div class="pagination">
                <?php echo e($businesses->appends(request()->except('page'))->links('pagination::default')); ?>

              </div>
            <?php endif; ?>
          </div>

          <!-- Sidebar -->
          <!-- ############################### Filter Form -->
          <div class="col-lg-3 ml-auto">
            <div class="mb-5">
                <h3 class="h5 text-black mb-3">Filters</h3>
                <form id="filterForm" action="<?php echo e(route('listings')); ?>" method="GET">
                    <div class="form-group">
                        <input type="text" name="query" value="<?php echo e(request('query')); ?>" placeholder="What are you looking for?" class="form-control" oninput="applyFilter()">
                    </div>
                    <div class="form-group">
                        <div class="select-wrap">
                            <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
                            <select class="form-control" name="category" onchange="applyFilter()">
                                <option value="">All Categories</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>>
                                        <?php echo e($category->category_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="wrap-icon">
                            <span class="icon icon-room"></span>
                            <input type="text" name="location" value="<?php echo e(request('location')); ?>" placeholder="Location" class="form-control" oninput="applyFilter()">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                      <p>Radius around selected destination</p>
                      <input type="range" name="radius" min="0" max="100" value="<?php echo e(request('radius', 20)); ?>" data-rangeslider onchange="applyFilter()">
                    </div> -->
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Inclure la section categorie populaire -->
    <?php echo $__env->make('popular-categories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Inclure la section appel a l'action -->
    <?php echo $__env->make('call-to-action', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/listings.blade.php ENDPATH**/ ?>