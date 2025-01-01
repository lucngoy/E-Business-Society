<?php $__env->startSection('title', 'Research'); ?>

<?php $__env->startSection('content'); ?>
    <!-- #################################### -->
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('<?php echo e(asset('images/hero_1.jpg')); ?>');" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">

                <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">

                    <!-- ############### Search -->
                    <div class="form-search-wrap p-2" data-aos="fade-up" data-aos-delay="200">
                        <form action="<?php echo e(route('business.search')); ?>" method="GET">
                            <div class="row align-items-center">
                                <div class="col-lg-12 col-xl-4 no-sm-border border-right">
                                    <input type="text" class="form-control" name="name" value="<?php echo e(request('name')); ?>" placeholder="Search by business name">
                                </div>

                                <div class="col-lg-12 col-xl-3 no-sm-border border-right">
                                    <div class="wrap-icon">
                                        <span class="icon icon-room"></span>
                                        <input type="text" class="form-control" name="location" value="<?php echo e(request('location')); ?>" placeholder="Search by adress">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-xl-3">
                                    <div class="select-wrap">
                                        <span class="icon">
                                            <span class="icon-keyboard_arrow_down"></span>
                                        </span>

                                        <select class="form-control" name="category">
                                            <option value="">Select category</option>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->id); ?>" <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>><?php echo e($category->category_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-xl-2 ml-auto text-right">
                                    <input type="submit" class="btn text-white btn-primary" value="Search">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--  -->
                
                </div>
            </div>
        </div>
    </div>

    <!-- -------------------------------- -->




    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <?php if($businesses->isEmpty()): ?>
                <div class="alert alert-warning" role="alert">
                    No businesses found matching your search criteria.
                </div>
            <?php else: ?>
                <?php $__currentLoopData = $businesses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $business): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-block d-md-flex listing-horizontal">

                        <a href="<?php echo e(route('business.show', $business->id)); ?>" class="img d-block" style="background-image: url('<?php echo e($business->image ? asset('storage/' . $business->image) : asset('images/default-img.png')); ?>')">
                            <span class="category"><?php echo e($business->category->category_name ?? 'Uncategorized'); ?></span>
                        </a>

                        <div class="lh-content">
                            <!-- <a href="" class="bookmark"><span class="icon-heart"></span></a> -->
                            <h3><a href="<?php echo e(route('business.show', $business->id)); ?>"><?php echo e($business->business_name); ?></a></h3>
                            <p><?php echo e($business->address); ?></p>
                            
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
          <!-- <div class="col-lg-3 ml-auto">

            <div class="mb-5">
              <h3 class="h5 text-black mb-3">Filters</h3>
              <form action="#" method="post">
                <div class="form-group">
                  <input type="text" placeholder="What are you looking for?" class="form-control">
                </div>
                <div class="form-group">
                  <div class="select-wrap">
                      <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
                      <select class="form-control" name="" id="">
                        <option value="">All Categories</option>
                        <option value="">Appartment</option>
                        <option value="">Restaurant</option>
                        <option value="">Eat &amp; Drink</option>
                        <option value="">Events</option>
                        <option value="">Fitness</option>
                        <option value="">Others</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                  
                  <div class="wrap-icon">
                    <span class="icon icon-room"></span>
                    <input type="text" placeholder="Location" class="form-control">
                  </div>
                </div>
              </form>
            </div>
            
            <div class="mb-5">
              <form action="#" method="post">
                <div class="form-group">
                  <p>Radius around selected destination</p>
                </div>
                <div class="form-group">
                  <input type="range" min="0" max="100" value="20" data-rangeslider>
                </div>
              </form>
            </div>

            <div class="mb-5">
              <form action="#" method="post">
                <div class="form-group">
                  <p>Category 'Restaurant' is selected</p>
                  <p>More filters</p>
                </div>
                <div class="form-group">
                  <ul class="list-unstyled">
                    <li>
                      <label for="option1">
                        <input type="checkbox" id="option1">
                        Coffee
                      </label>
                    </li>
                    <li>
                      <label for="option2">
                        <input type="checkbox" id="option2">
                        Vegetarian
                      </label>
                    </li>
                    <li>
                      <label for="option3">
                        <input type="checkbox" id="option3">
                        Vegan Foods
                      </label>
                    </li>
                    <li>
                      <label for="option4">
                        <input type="checkbox" id="option4">
                        Sea Foods
                      </label>
                    </li>
                  </ul>
                </div>
              </form>
            </div>

          </div> -->

        </div>
      </div>
    </div>

    <!-- Inclure la section categorie populaire -->
    <?php echo $__env->make('popular-categories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Inclure la section appel a l'action -->
    <?php echo $__env->make('call-to-action', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/business/search.blade.php ENDPATH**/ ?>