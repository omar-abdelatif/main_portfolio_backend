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
        <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
            <div class="notification-slider">
                <div class="d-flex h-100">
                    <img src="<?php echo e(asset('assets/images/giftools.gif')); ?>" alt="gif">
                    <h6 class="mb-0 f-w-400">
                        <span class="font-primary">Don't Miss Out! </span>
                        <span class="f-light"> Out new update has been release.</span>
                    </h6>
                    <i class="icon-arrow-top-right f-light"></i>
                </div>
                <div class="d-flex h-100">
                    <img src="<?php echo e(asset('assets/images/giftools.gif')); ?>" alt="gif">
                    <h6 class="mb-0 f-w-400">
                        <span class="f-light">Something you love is now on sale! </span>
                    </h6>
                    <a class="ms-1" href="https://1.envato.market/3GVzd" target="_blank">Buy now !</a>
                </div>
            </div>
        </div>
        <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
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
                            <span>Emay Walter</span>
                            <p class="mb-0">
                                Admin
                                <i class="middle fa-solid fa-angle-down"></i>
                            </p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            <a href="javascript:void(0)">
                                <i data-feather="user"></i>
                                <span>Account </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i data-feather="settings"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i data-feather="log-in"> </i>
                                <span>Log out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH D:\html-css-js\Laravel-Projects\Not_Yet\portfolio\resources\views/layouts/header.blade.php ENDPATH**/ ?>