<!DOCTYPE html>
<html lang="en" data-theme="dark">
    <head>
        <?php echo $__env->make('layouts.components.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('layouts.assets.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body class="dark-only">
        <div class="loader-wrapper">
            <div class="loader-index">
                <span></span>
            </div>
            <svg>
                <defs></defs>
                <filter id="goo">
                    <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                    <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
                </filter>
            </svg>
        </div>
        <div class="tap-top">
            <i data-feather="chevrons-up"></i>
        </div>
        <div class="page-wrapper compact-wrapper" id="pageWrapper">
            <?php echo $__env->make('layouts.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="page-body-wrapper horizontal-menu">
                <?php echo $__env->make('layouts.components.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="page-body">
                    <?php echo $__env->yieldContent('main_content'); ?>
                </div>
                <?php echo $__env->make('layouts.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <?php echo $__env->make('layouts.assets.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html>
<?php /**PATH D:\html-css-js\Laravel-Projects\Not_Yet\portfolio\resources\views/layouts/master.blade.php ENDPATH**/ ?>