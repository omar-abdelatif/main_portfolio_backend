<?php $__env->startSection('title'); ?>
    Settings
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-title'); ?>
    <h3>Settings</h3>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item active">Settings</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/select/bootstrap-select.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/bootstrap-multiselectsplitter.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom-setting.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                sweetalertError($error);
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <div class="container-fluid main-setting">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Dashboard Settings</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-lg-3 g-4">
                            <div class="col-lg-3 col-12">
                                <div class="nav flex-lg-column nav-pills nav-primary" id="ver-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="ver-pills-api-tab" data-bs-toggle="pill" href="#ver-pills-api" aria-selected="true" role="tab">Api</a>
                                    <a class="nav-link" id="ver-pills-social-tab" data-bs-toggle="pill" href="#ver-pills-social" aria-selected="false" role="tab">Social Links</a>
                                    <a class="nav-link" id="ver-pills-payment-tab" data-bs-toggle="pill" href="#ver-pills-payment" aria-selected="false" role="tab">Payment Methods</a>
                                    <a class="nav-link" id="ver-pills-about-tab" data-bs-toggle="pill" href="#ver-pills-about" aria-selected="false" role="tab">About</a>
                                </div>
                            </div>
                            <div class="col-lg-9 col-12">
                                <div class="tab-content" id="ver-pills-tabContent">
                                    <div class="tab-pane fade show active" id="ver-pills-api">
                                        <div class="row mb-0">
                                            <label class="col-md-3 mt-2 mb-0">Api Key</label>
                                            <div class="col-md-9">
                                                <form action="<?php echo e(route('settings.api.update')); ?>" method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="id" value="<?php echo e($apiKey->id); ?>">
                                                    <input class="form-control" type="text" name="api_key" placeholder="Create Api Key" value="<?php echo e($apiKey->key); ?>" readonly>
                                                    <button type="submit" class="btn btn-primary mt-3 w-100 fw-bold fs-6">Generate New Api Key</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="ver-pills-about">
                                        <form action="<?php echo e(route('about.update')); ?>" method="post" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-group mb-3">
                                                <label for="developer_name" class="form-label">Developer Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Developer Name" value="<?php echo e($aboutdata->name); ?>"/>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="developer_email" class="form-label">Developer Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Developer Email" value="<?php echo e($aboutdata->email); ?>"/>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="developer_position" class="form-label">Developer Position</label>
                                                <input type="text" name="position" id="postion" class="form-control" placeholder="Developer Position" value="<?php echo e($aboutdata->position); ?>">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="developer_nationality" class="form-label">Developer Nationality</label>
                                                <input type="text" name="nationality" id="nationality" class="form-control" placeholder="Developer Nationality" value="<?php echo e($aboutdata->nationality); ?>">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="developer_phone" class="form-label">Developer Phone</label>
                                                <input type="number" name="phone" id="phone" class="form-control" placeholder="Developer Phone" value="<?php echo e($aboutdata->phone); ?>">
                                            </div>
                                            <?php if(isset($aboutdata->about_img)): ?>
                                                <div class="view-img text-center mb-3">
                                                    <img src="<?php echo e(asset($aboutdata->about_img)); ?>" class="img-fluid" width="80" alt="<?php echo e($aboutdata->name); ?> Image">
                                                </div>
                                            <?php endif; ?>
                                            <div class="form-group mb-3">
                                                <label for="aboutt-img" class="form-label fw-bold">About Image</label>
                                                <input type="file" name="about_img" id="about-img" class="form-control" accept="image/*" value="<?php echo e($aboutdata->about_img); ?>">
                                            </div>
                                            <?php if(isset($aboutdata->about_cv)): ?>
                                                <div class="pdf-view my-3 text-center">
                                                    <a href="<?php echo e($aboutdata->about_cv); ?>" target="blank">
                                                        <img src="<?php echo e(asset('assets/images/pdf.png')); ?>" width="100" height="100" alt="pdf image">
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <div class="form-group mb-3">
                                                <label for="about-cv" class="form-label fw-bold">Developer CV</label>
                                                <input type="file" name="about_cv" id="about-cv" class="form-control" accept="application/pdf" value="<?php echo e($aboutdata->about_cv); ?>">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="about-desc" class="form-label fw-bold">Developer Description</label>
                                                <textarea name="description" class="form-control" id="about-desc" cols="30" rows="10"><?php echo e($aboutdata->description); ?></textarea>
                                            </div>
                                            <div class="form-footer">
                                                <button type="submit" class="btn btn-primary mt-3 w-100 fw-bold fs-6">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="ver-pills-social">
                                        <form action="<?php echo e(route('social.update')); ?>" method="POST" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <?php
                                                $socialLinks = ['facebook', 'github', 'linkedin', 'whatsapp'];
                                            ?>
                                            <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $data = $platforms[$platform] ?? null;
                                                ?>
                                                <div class="form-group mb-3">
                                                    <label for="<?php echo e($platform); ?>_url" class="form-label"><?php echo e(ucfirst($platform)); ?> URL</label>
                                                    <input type="text" class="form-control" id="<?php echo e($platform); ?>_url" name="social_<?php echo e($platform); ?>" placeholder="Enter <?php echo e(ucfirst($platform)); ?> URL" value="<?php echo e(old('social_'.$platform, $data->url ?? '')); ?>"/>
                                                </div>
                                                <?php if(isset($data) && $data->platform_icon): ?>
                                                    <div class="mb-2 text-center">
                                                        <label class="form-label">الصورة الحالية:</label><br>
                                                        <img src="<?php echo e($data->platform_icon); ?>" alt="<?php echo e($platform); ?> icon" style="height: 60px;">
                                                    </div>
                                                <?php endif; ?>
                                                <div class="form-group mb-3">
                                                    <label for="<?php echo e($platform); ?>_image" class="form-label"><?php echo e(ucfirst($platform)); ?> Image</label>
                                                    <input type="file" name="<?php echo e($platform); ?>_image" id="<?php echo e($platform); ?>_image" value="<?php echo e(isset($data) && $data->platform_icon ? $data->platform_icon : ''); ?>" class="form-control" accept="image/*">
                                                </div>
                                                <div class="form-check form-switch mb-1">
                                                    <label class="form-check-label" for="<?php echo e($platform); ?>_switch">
                                                        Active <?php echo e(ucfirst($platform)); ?>

                                                    </label>
                                                    <input class="form-check-input" type="checkbox" id="<?php echo e($platform); ?>_switch" name="<?php echo e($platform); ?>_status" <?php echo e((isset($data) && $data->status == 'active') ? 'checked' : ''); ?>/>
                                                </div>
                                                <hr class="rounded-pill" style="border-width: 5px; border-color: #f1f1f1"/>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <button type="submit" class="btn btn-primary mt-3 w-100 fw-bold fs-6">Save</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="ver-pills-payment">
                                        <form action="<?php echo e(route('payment.update')); ?>" method="POST" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <?php
                                                $payments = ['paypal', 'instapay', 'vfCash', 'paymob', 'fawry'];
                                            ?>
                                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $data = $paymentMethods[$payment] ?? null;
                                                ?>
                                                <div class="form-group mb-3">
                                                    <label for="<?php echo e($payment); ?>" class="form-label"><?php echo e(ucfirst($payment)); ?></label>
                                                    <input type="text" class="form-control" id="<?php echo e($payment); ?>" name="payment_<?php echo e($payment); ?>" placeholder="Enter <?php echo e(ucfirst($payment)); ?> Value"  value="<?php echo e(old('payment_'.$payment, $data->methods_value ?? '')); ?>"/>
                                                </div>
                                                <?php if(isset($data) && $data->methods_icon): ?>
                                                    <div class="mb-2 text-center">
                                                        <label class="form-label">الصورة الحالية:</label><br>
                                                        <img src="<?php echo e($data->methods_icon); ?>" alt="<?php echo e($payment); ?> icon" style="height: 60px;">
                                                    </div>
                                                <?php endif; ?>
                                                <div class="form-group mb-3">
                                                    <label for="<?php echo e($payment); ?>_image" class="form-label"><?php echo e(ucfirst($payment)); ?> Image</label>
                                                    <input type="file" name="<?php echo e($payment); ?>_image" id="<?php echo e($payment); ?>_image" value="<?php echo e(isset($data) && $data->methods_icon ? $data->methods_icon : ''); ?>" class="form-control" accept="image/*">
                                                </div>
                                                <div class="form-check form-switch mb-1">
                                                    <label class="form-check-label" for="<?php echo e($payment); ?>_switch">
                                                        Activate
                                                    </label>
                                                    <input class="form-check-input" type="checkbox" id="<?php echo e($payment); ?>_switch" name="active_<?php echo e($payment); ?>" <?php echo e((isset($data) && $data->methods_status == 'active') ? 'checked' : ''); ?>/>
                                                </div>
                                                <hr class="rounded-pill" style="border-width: 5px; border-color: #f1f1f1"/>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <button type="submit" class="btn btn-primary mt-3 w-100 fw-bold fs-6">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH D:\html-css-js\Laravel-Projects\Not_Yet\portfolio\resources\views/pages/settings/settings.blade.php ENDPATH**/ ?>