<!DOCTYPE html>
<html>
    <head>
        <?php echo $__env->make('layouts.components.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('layouts.assets.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body>
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
                <main class="page-body">
                    <div class="container-fluid">
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <?php echo $__env->yieldContent('breadcrumb-title'); ?>
                                        <?php $__env->startSection('modals'); ?>
                                            <?php echo $__env->yieldContent('modals'); ?>
                                        <?php echo $__env->yieldSection(); ?>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <?php if (isset($component)) { $__componentOriginal269900abaed345884ce342681cdc99f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal269900abaed345884ce342681cdc99f6 = $attributes; } ?>
<?php $component = App\View\Components\Breadcrumb::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Breadcrumb::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                        <?php echo $__env->yieldContent('breadcrumb-items'); ?>
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal269900abaed345884ce342681cdc99f6)): ?>
<?php $attributes = $__attributesOriginal269900abaed345884ce342681cdc99f6; ?>
<?php unset($__attributesOriginal269900abaed345884ce342681cdc99f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal269900abaed345884ce342681cdc99f6)): ?>
<?php $component = $__componentOriginal269900abaed345884ce342681cdc99f6; ?>
<?php unset($__componentOriginal269900abaed345884ce342681cdc99f6); ?>
<?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php echo e($slot); ?>

                    </div>
                </main>
                <?php echo $__env->make('layouts.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <?php echo $__env->make('layouts.assets.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html>
<?php /**PATH D:\html-css-js\Laravel-Projects\Not_Yet\portfolio\resources\views/layouts/app.blade.php ENDPATH**/ ?>