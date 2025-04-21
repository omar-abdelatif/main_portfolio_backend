<div class="sidebar-wrapper" data-sidebar-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a class="fw-bold fs-5" href="<?php echo e(route('dashboard')); ?>">
                Omar Abdelatif
            </a>
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="grid"></i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="<?php echo e(route('dashboard')); ?>">
                <img class="img-fluid" src="<?php echo e(asset('assets/images/logo/logo-icon.png')); ?>" alt="">
            </a>
        </div>
        <nav class="sidebar-main">
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('dashboard')); ?>">
                            <svg class="stroke-icon">
                                <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#stroke-home')); ?>"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#fill-home')); ?>"></use>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('categories.index')); ?>">
                            <svg class="stroke-icon">
                                <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#stroke-home')); ?>"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#fill-home')); ?>"></use>
                            </svg>
                            <span>Categories</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('projects.index')); ?>">
                            <svg class="stroke-icon">
                                <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#stroke-home')); ?>"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#fill-home')); ?>"></use>
                            </svg>
                            <span>Projects</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('skills.index')); ?>">
                            <svg class="stroke-icon">
                                <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#stroke-home')); ?>"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#fill-home')); ?>"></use>
                            </svg>
                            <span>Skills</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('pricing.index')); ?>">
                            <svg class="stroke-icon">
                                <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#stroke-home')); ?>"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#fill-home')); ?>"></use>
                            </svg>
                            <span>Pricing</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('settings.index')); ?>">
                            <svg class="stroke-icon">
                                <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#stroke-home')); ?>"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#fill-home')); ?>"></use>
                            </svg>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<?php /**PATH D:\html-css-js\Laravel-Projects\Not_Yet\portfolio\resources\views/layouts/components/sidebar.blade.php ENDPATH**/ ?>