<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <title> <?php echo $__env->yieldContent('title-page'); ?> | CS L'ile des Roses </title>

    <link rel="apple-touch-icon" href="<?php echo asset('/images/favicon.png'); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo asset('/images/favicon.png'); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/vendors.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/charts/apexcharts.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/extensions/toastr.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/tables/datatable/datatables.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css'); ?>">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/css/bootstrap-extended.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/css/colors.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/css/components.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/css/themes/dark-layout.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/css/themes/bordered-layout.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/css/themes/semi-dark-layout.min.css'); ?>">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/css/core/menu/menu-types/vertical-menu.min.css'); ?>">
    <?php echo $__env->yieldContent('styles-page'); ?>
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/app-assets/css/style.css'); ?>">
    <!-- END: Custom CSS-->

    <style>
      .sub-menu-item{
        width: 14px !important;
        height: 14px !important;
      }
    </style>

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">

    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- BEGIN: Content-->
    <div class="app-content content ">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper">
        
        <?php echo $__env->yieldContent('breadcrumb'); ?>

        <div id="showMsg"></div>

        <div class="content-body"><!-- Dashboard Analytics Start -->
          <section id="dashboard-analytics">

            <?php echo $__env->yieldContent('content-page'); ?>

          </section>
          <!-- Dashboard Analytics end -->

        </div>
      </div>
    </div>
    <!-- END: Content-->



    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- END: Footer-->

    <script>
      
    </script>
    <!-- BEGIN: Vendor JS-->
    <script src="<?php echo asset('/app-assets/vendors/js/vendors.min.js'); ?>"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <?php echo $__env->yieldContent('scripts-page-vendor'); ?>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?php echo asset('/app-assets/js/core/app-menu.min.js'); ?>"></script>
    <script src="<?php echo asset('/app-assets/js/core/app.min.js'); ?>"></script>
    <script src="<?php echo asset('/app-assets/js/scripts/customizer.min.js'); ?>"></script>
    <!-- END: Theme JS-->

    <script src="<?php echo asset('/js/functions.js'); ?>"></script>
    
    <?php echo $__env->make('layouts.js.functions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- BEGIN: Page JS-->
    <?php echo $__env->yieldContent('scripts-page'); ?>
    <!-- END: Page JS-->

  </body>
  <!-- END: Body-->
</html>
<?php /**PATH C:\wamp64\www\review\cspyramides\resources\views/layouts/master.blade.php ENDPATH**/ ?>