<?php
    $user = Auth::user();
    $userId = $user->id;
?>
<!-- Page Header Start-->
<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper">
                <a href="<?php echo e(route('dashboard')); ?>">Omar Abdelatif</a>
            </div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
            </div>
        </div>
        <div class="left-header col-xxl-5 col-xl-10 col-md-9 col-sm-3 p-0">
            <div class="notification-slider"></div>
        </div>
        <div class="nav-right col-xxl-7 col-xl-2 col-md-3 col-8 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">
                <li>
                    <div class="mode">
                        <svg>
                            <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#moon')); ?>"></use>
                        </svg>
                    </div>
                </li>
                <li class="profile-nav onhover-dropdown pe-0 py-0">
                    <div class="d-flex profile-media">
                        <img class="b-r-10" src="<?php echo e(asset('assets/images/dashboard/profile.png')); ?>" alt="">
                        <div class="flex-grow-1">
                            <span><?php echo e($user->name); ?></span>
                            <p class="mb-0">
                                <i class="middle fa-solid fa-angle-down"></i>
                            </p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            <a href="<?php echo e(route('profile.edit')); ?>">
                                <i data-feather="user"></i>
                                <span>Profile </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i data-feather="log-in"> </i>
                                Logout
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH D:\html-css-js\Laravel-Projects\Not_Yet\portfolio\resources\views/layouts/components/header.blade.php ENDPATH**/ ?>