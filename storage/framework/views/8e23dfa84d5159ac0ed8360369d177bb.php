<a <?php echo e($attributes->class(['btn'])->merge(['id' => str_replace('.', '-', $route),'href' => isset($params) ? route($route, $params) : route($route) ])); ?>>
    <i class="<?php echo e($icon); ?>"></i>
</a><?php /**PATH E:\html-css-js\Web Projects\Laravel\Done\portfolio\resources\views/components/anchor.blade.php ENDPATH**/ ?>