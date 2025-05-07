<a <?php echo e($attributes->class(['btn'])->merge(['id' => str_replace('.', '-', $route),'href' => isset($params) ? route($route, $params) : route($route) ])); ?>>
    <i class="<?php echo e($icon); ?>"></i>
</a><?php /**PATH D:\html-css-js\Laravel-Projects\Not_Yet\portfolio\resources\views/components/anchor.blade.php ENDPATH**/ ?>