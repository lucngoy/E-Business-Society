<?php $__env->startSection('title', $business->business_name); ?>

<?php $__env->startSection('sub-title', $business->address); ?> <!-- Location -->

<?php $__env->startSection('content'); ?>

    <!-- Inclure sub-header de la page -->
    <?php echo $__env->make('header-page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" data-aos="fade" data-aos-delay="100">
                    <div class="mb-5 border-bottom pb-5">
                        <p><img src="<?php echo e($business->image ? asset('storage/' . $business->image) : asset('images/default-img.png')); ?>" alt="Business Image" class="img-fluid mb-4"></p>
                        
                        <p><?php echo e($business->description); ?></p>

                        <div class="review-container">
                            <div class="inner">
                                <!-- Note moyenne -->
                                <div class="rating">
                                    <span class="rating-num"><?php echo e(number_format($business->reviews->avg('rating'), 1)); ?></span>
                                    <div class="rating-stars">
                                        <?php for($i = 0; $i < 5; $i++): ?>
                                            <span>
                                                <i class="icon-star <?php echo e($i < number_format($business->reviews->avg('rating')) ? 'active' : ''); ?>"></i>
                                            </span>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="rating-users">
                                        <i class="icon-user"></i> <?php echo e($business->reviews->count()); ?> reviews
                                    </div>
                                </div>
                                
                                <!-- Histogramme de répartition des avis -->
                                <div class="histo">
                                    <?php
                                        $totalReviews = $business->reviews->count();
                                        $ratingsCount = [
                                            5 => $business->reviews->where('rating', 5)->count(),
                                            4 => $business->reviews->where('rating', 4)->count(),
                                            3 => $business->reviews->where('rating', 3)->count(),
                                            2 => $business->reviews->where('rating', 2)->count(),
                                            1 => $business->reviews->where('rating', 1)->count(),
                                        ];
                                    ?>

                                    <?php $__currentLoopData = $ratingsCount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="rating-<?php echo e($rating); ?> histo-rate">
                                            <span class="histo-star">
                                                <i class="active icon-star"></i> <?php echo e($rating); ?>

                                            </span>
                                            <span class="bar-block">
                                                <span id="bar-<?php echo e($rating); ?>" class="bar" style="width: <?php echo e($totalReviews > 0 ? ($count / $totalReviews) * 100 : 0); ?>%">
                                                    <span><?php echo e($count); ?></span>&nbsp;
                                                </span>
                                            </span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>


                        <?php if(session('success')): ?>
                            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                        <?php endif; ?>

                        <?php if(session('error')): ?>
                            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                        <?php endif; ?>

                        <!-- Affichage des avis sur la page de l’entreprise -->

                        <?php if($reviews->count() > 0): ?>
                            <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="reviews">
                                    <div class="header">
                                        <div class="picture"><?php echo e(Str::limit($review->user->name,1)); ?></div>
                                        <strong><?php echo e($review->user->name); ?></strong>
                                    </div>

                                    <small>
                                        <?php for($i = 0; $i < 5; $i++): ?>
                                            <i class="icon-star <?php echo e($i < $review->rating ? 'active' : ''); ?>"></i>
                                        <?php endfor; ?>

                                        &nbsp;Reviewed on <?php echo e($review->created_at->format('d M Y')); ?>

                                    </small>
                                    
                                    <p class="cmnt"><?php echo e($review->comment); ?></p>

                                    <?php if(auth()->check() && ($userRole === 'admin' || auth()->id() === $review->user_id)): ?>
                                        <form method="POST" action="<?php echo e(route('reviews.destroy', $review->id)); ?>" style="display:inline-block;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <!-- Pagination -->
                            <div class="pagination">
                                <?php echo e($reviews->links('pagination::bootstrap-4')); ?>

                            </div>

                        <?php else: ?>
                            <p>No reviews yet. Be the first to leave a review!</p>
                        <?php endif; ?>


                        <br>
                        <!-- Formulaire pour soumettre un avis -->
                        <?php if(auth()->check()): ?>
                            <form method="POST" action="<?php echo e(route('reviews.store', $business->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="row form-group">
                
                                    <div class="col-md-12">
                                        <label class="text-black" for="Rating">Rating</label> 
                                        <select name="rating" id="rating" class="form-control" required>
                                            <option value="">Select a rating</option>
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?> Star<?php echo e($i > 1 ? 's' : ''); ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row form-group">
                
                                    <div class="col-md-12">
                                        <label class="text-black" for="Comment">Comment</label> 
                                        <textarea name="comment" id="comment" class="form-control" rows="4" placeholder="Write your review here"></textarea>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <input type="submit" value="Submit Review" class="btn btn-primary btn-md text-white">
                                    </div>
                                </div>
                            </form>
                        <?php else: ?>
                            <p><a href="<?php echo e(route('login')); ?>">Log in</a> to leave a review.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade" data-aos-delay="100">
                
                    <div class="p-4 mb-3 bg-white">
                        <p class="mb-0 font-weight-bold">Address</p>
                        <p class="mb-4"><?php echo e($business->address); ?></p>

                        <p class="mb-0 font-weight-bold">Phone</p>
                        <p class="mb-4"><a href="tel:<?php echo e($business->phone); ?>"><?php echo e($business->phone); ?></a></p>

                        <p class="mb-0 font-weight-bold">Website</p>
                        <p class="mb-0"><a href="<?php echo e($business->website); ?>" target="_blank">Visit Website</a></p>
                    </div>
                    
                    <div class="p-4 mb-3 bg-white">
                        <h3 class="h5 text-black mb-3">Opening Hours</h3>
                        <p><?php echo nl2br(e($business->opening_hours)); ?></p>
                        <!-- <p><a href="#" class="btn btn-primary px-4 py-2 text-white">Learn More</a></p> -->
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/business/show.blade.php ENDPATH**/ ?>