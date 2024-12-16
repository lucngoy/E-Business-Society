<?php $__env->startSection('title', 'About Us'); ?>

<?php $__env->startSection('sub-title', 'Our Story, Mission, and Commitment to Community'); ?>

<?php $__env->startSection('content'); ?>

    <!-- Inclure sub-header de la page -->
    <?php echo $__env->make('header-page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="site-section">
        <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
            <img src="images/img_1.jpg" alt="Free website template by Free-Template.co" class="img-fluid rounded">
            </div>
            <div class="col-md-5 ml-auto">
            <h2 class="text-primary mb-3">History</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam voluptates a explicabo delectus sed labore dolor enim optio odio at!</p>
            <p class="mb-4">Adipisci dolore reprehenderit est et assumenda veritatis, ex voluptate odio consequuntur quo ipsa accusamus dicta laborum exercitationem aspernatur reiciendis perspiciatis!</p>

            <ul class="ul-check list-unstyled success">
                <li>Adipisci dolore reprehenderit</li>
                <li>Accusamus dicta laborum</li>
                <li>Delectus sed labore</li>
            </ul>
            </div>
        </div>
        </div>
    </div>




    <div class="site-section "  data-aos="fade">
        <div class="container">
        <div class="row mb-5">
            <div class="col-md-8" >
            <h3>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</h3>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 mx-auto">
            <h3>Who We Are</h3>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-4 ml-auto">
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </div>
            <div class="col-md-4">
            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-4 text-left border-primary">
            <h2 class="font-weight-light text-primary">Our Team</h2>
            <p class="color-black-opacity-5">Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6 mb-4 mb-lg-5">
            <img src="images/person_1.jpg" alt="Free website template by Free-Template.co" class="img-fluid mb-3">
            <h3 class="h4">Susan Horton</h3>
            <p class="caption text-primary">Founder</p>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </div>
            <div class="col-md-6 col-lg-6 mb-4 mb-lg-5 mt-md-5">
            <img src="images/person_2.jpg" alt="Free website template by Free-Template.co" class="img-fluid mb-3">
            <h3 class="h4">Jonathan Kennedy</h3>
            <p class="caption text-primary">Founder</p>
            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
            </div>
            <div class="col-md-6 col-lg-6 mb-4 mb-lg-5">
            <img src="images/person_3.jpg" alt="Free website template by Free-Template.co" class="img-fluid mb-3">
            <h3 class="h4">Gordon Meyer</h3>
            <p class="caption text-primary">Lead Developer</p>
            </div>
            <div class="col-md-6 col-lg-6 mb-4 mb-lg-5 mt-md-5">
            <img src="images/person_4.jpg" alt="Free website template by Free-Template.co" class="img-fluid mb-3">
            <h3 class="h4">Doug Hale Kennedy</h3>
            <p class="caption text-primary">ProjectManager</p>
            </div>
        </div>

        </div>
    </div>



    <!-- Inclure FAQ -->
    <?php echo $__env->make('faq', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Inclure la section appel a l'action -->
    <?php echo $__env->make('call-to-action', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/about.blade.php ENDPATH**/ ?>