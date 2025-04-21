<!DOCTYPE html>
<html lang="en" <?php if(Route::currentRouteName() == 'rtl_layout'): ?> dir="rtl" <?php endif; ?>
<?php if(Route::currentRouteName() === 'layout_dark'): ?> data-theme="dark" <?php endif; ?>>
  <head>
    <?php echo $__env->make('layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </head>
  <?php switch(Route::currentRouteName()):
   
    case ('box_layout'): ?>
        <body class="box-layout">
        <?php break; ?>

    <?php case ('rtl_layout'): ?>
        <body class="rtl">
        <?php break; ?>

    <?php case ('layout_dark'): ?>
        <body class="dark-only">
        <?php break; ?>

    <?php default: ?>
         <body>
  <?php endswitch; ?>
    <!-- loader starts-->
    <div class="loader-wrapper">
      <div class="loader-index"> <span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
        </filter>
      </svg>
    </div>
    <!-- loader ends-->

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->

     <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">

      <!-- Page header start -->
      <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- Page header end-->

        <!-- Page Body Start-->
        <div class="page-body-wrapper horizontal-menu">

          <!-- Page sidebar start-->
          <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <div class="page-body">
            <?php echo $__env->yieldContent('main_content'); ?>
          </div>
          
          <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <?php echo $__env->make('layouts.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </body>
</html><?php /**PATH D:\starter-kit\resources\views/layouts/master.blade.php ENDPATH**/ ?>