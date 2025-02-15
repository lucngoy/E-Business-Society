<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $__env->yieldContent('title'); ?>  | E-Business Society</title>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Free-Template.co" />

    <link rel="shortcut icon" href="<?php echo e(asset('ftco-32x32.png')); ?>">

    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(asset('fonts/icomoon/style.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/magnific-popup.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/jquery-ui.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/owl.theme.default.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-datepicker.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('fonts/flaticon/font/flaticon.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/aos.css')); ?>">
    <!-- <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet"> -->

    <link rel="stylesheet" href="<?php echo e(asset('css/rangeslider.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

    <!-- Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>

    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    

    <style>

        .map-section .container {
            margin: 0 auto;
        }

        /* IMPORTANT: La carte doit avoir une hauteur définie */
        #map {
            height: 500px;
            width: 100%;
            border: 2px solid #ddd;
            margin-bottom: 20px;
        }

        .business-list {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
        }

        .business-item {
            background: white;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .business-item:hover {
            background: #f0f0f0;
        }

        /* dropdown btn */
      .dropdown-menu {
        display: none; /* Cache par défaut */
      }

      .dropdown-menu.show {
        display: block; /* Affiche lorsque la classe "show" est ajoutée */
        position: absolute; /* Maintient l'affichage dans la position correcte */
        will-change: transform; /* Optimisation des animations */
        top: 100%; /* Position sous le bouton */
        right: 0; /* Aligné à gauche */
        z-index: 1000; /* Assure la priorité d'affichage */
      }

      .dropdown-divider{
        border-top: solid 1px #e7e7e7;
      }
    </style>
    
</head>
<body>
    <div class="site-wrap">
        <!-- Inclure le header -->
        <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Contenu principal de la page -->
        <main>
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <!-- Inclure le footer -->
        <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <!-- Charger jQuery en premier -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts dépendants de jQuery -->
    <script src="<?php echo e(asset('js/jquery-ui.js')); ?>"></script>
    <script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.stellar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.countdown.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.magnific-popup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/rangeslider.min.js')); ?>"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Charger Popper.js et Bootstrap -->
    <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>

    <!-- Charger les animations (AOS) -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <!-- Votre fichier principal JavaScript -->
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('js/typed.js')); ?>"></script>

    <!-- Btn dropdown -->
    <script>
        $('.dropdown-toggle').on('click', function (event) {
        event.preventDefault(); // Empêche tout comportement par défaut (facultatif)
        $(this).next('.dropdown-menu').toggleClass('show');
        });
        
        $(document).on('click', function (event) {
        if (!$(event.target).closest('.btn-group').length) {
            $('.dropdown-menu').removeClass('show');
        }
        });
    </script>

    <!-- Script pour Typed.js -->
    <script>
        var typed = new Typed('.typed-words', {
            strings: ["Business", " Business", " Business", " Business"],
            typeSpeed: 80,
            backSpeed: 80,
            backDelay: 4000,
            startDelay: 1000,
            loop: true,
            showCursor: true
        });
    </script>

    <!-- Script pour le filtrage AJAX -->
    <script>
        $(document).ready(function() {
            $('#filterForm input, #filterForm select').on('change input', function() {
                const form = $('#filterForm');
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    beforeSend: function() {
                        $('#results').html('<p>Loading...</p>');
                    },
                    success: function(response) {
                        $('#results').html($(response).find('#results').html());
                    },
                    error: function() {
                        $('#results').html('<div class="alert alert-warning" role="alert">Something went wrong. Please try again.</div>');
                    }
                });
            });
        });
    </script>

</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/web/E-business-society/resources/views/layouts/app.blade.php ENDPATH**/ ?>