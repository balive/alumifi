

<?php $__env->startSection('styles'); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!--begin::Subheader-->
    <div class="subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center mr-1">

                <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                    <span></span>
                </button>
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h2 class="d-flex align-items-center <?php if(auth()->user()->type == 'client'): ?> text-white <?php else: ?> text-dark <?php endif; ?> font-weight-bold my-1 mr-3">User Details</h2>
                    <!--end::Page Title-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center flex-wrap">
                <!--begin::Button-->

            <?php echo $__env->make('layouts.profile_button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



            <!--end::Button-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="h3 text-center">

                <?php if($errors->any()): ?>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="text-danger" role="alert">
                        <strong style="font-size: 13px; font-weight: 400;"><?php echo e($error); ?></strong><br>
                    </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <!--begin::Profile Account Information-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8">
                    <!--begin::Card-->
                    <div class="card-custom">
                        <!--begin::Form-->
                        <!--begin::Body-->
                        <?php if(auth()->user()->subscribed()): ?>
                            <div class="card mb-3 mb-lg-5">
                            <!-- Header -->
                            <div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
                                <h5 class="card-header-title">Overview</h5>
                                <?php if(isset($currentSubscription->ends_at) && $currentSubscription->ends_at < Carbon\Carbon::now()  ): ?>
                                    <span class="badge btn btn-danger  ">Inactive</span>
                                <?php else: ?>
                                    <span class="badge btn btn-success  ">Active</span>
                                <?php endif; ?>
                            </div>
                            <!-- End Header -->
                            <!-- Body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md mb-4 mb-md-0">
                                        <div class="mb-4">
                                            <span class="card-subtitle">Your plan (Billed):</span>
                                            <h5><?php echo e($plan_info['name']); ?></h5>
                                        </div>
                                        <div>
                                            <span class="card-subtitle">Plan Price</span>
                                            <h3 class="text-primary">
                                                <?php if($currentSubscription->plan_type == "monthly"): ?>
                                                    $<?php echo e($plan_info['price_monthly']); ?> <?php echo e($currentSubscription->plan_type); ?>

                                                <?php elseif($currentSubscription->plan_type == "yearly"): ?>
                                                    $<?php echo e($plan_info['price_yearly']); ?> <?php echo e($currentSubscription->plan_type); ?>

                                                <?php else: ?>
                                                    $<?php echo e($plan_info['price_monthly']); ?> <?php echo e($currentSubscription->plan_type); ?>

                                                <?php endif; ?>
                                            </h3>
                                        </div>

                                        <?php if($currentSubscription): ?>
                                                <div>
                                                    <span class="card-subtitle">Started At</span>
                                                    <h3 class="text-primary">
                                                        <?php echo e($started_at); ?>

                                                    </h3>
                                                </div>

                                            <?php if(!$onGracePeriod && $currentSubscription->type !== "free"): ?>
                                                <div>
                                                    <span class="card-subtitle">Next Billing Cycle</span>
                                                    <h3 class="text-primary">
                                                        <?php echo e($nextBillingDate); ?>

                                                    </h3>
                                                </div>
                                                <div>
                                                    <span class="card-subtitle">Billed At</span>
                                                    <h3 class="text-primary">
                                                        <?php echo e($subscriptionStartDate); ?>

                                                    </h3>
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(isset($nextBillingDate)): ?>
                                                <div>
                                                    <span class="card-subtitle">Subscription Ends</span>
                                                    <h3 class="text-primary">
                                                        <?php echo e($nextBillingDate); ?>

                                                    </h3>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if($paymentMethod): ?>
                                            <div>
                                                <span class="card-subtitle">Payment Method</span>
                                                <span class="">
                                                    <p><strong><?php echo e($paymentMethod->card->brand); ?> **** **** **** <?php echo e($paymentMethod->card->last4); ?> - <?php echo e($paymentMethod->card->exp_month); ?>/<?php echo e($paymentMethod->card->exp_year); ?> </strong> </p>

                                                    <!-- Add form for changing payment method -->
                                                    <a href="#" data-toggle="modal" data-target="#update_item"  class="btn-success btn-sm">
                                                        Update Payment Method
                                                    </a>
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <!-- End Col -->
                                    <div class="col-md-auto">
                                        <div class="d-grid d-md-flex gap-3">
                                            <?php if($currentSubscription->type !== "free"): ?>
                                                <?php if(!$onGracePeriod): ?>
                                                    <a id="btn-cancel-subscription" class="btn-danger btn-sm mr-2" href="#">Cancel subscription</a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(route('subscription.resume' , auth()->user()->id)); ?>" class="btn-warning text-white btn-sm mr-2" >Resume subscription</a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <a href="#plans-section" id="btn-upgrade" class="btn btn-dark btn-sm btn-transition">Update plan</a>
                                        </div>
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Row -->
                            </div>
                            <!-- End Body -->
                            <hr class="my-3">
                            <!-- Body -->
                            <div class="card-body">

                                <?php

                                $usedWords = $currentSubscription->quantity;
                                $totalWords = $plan_info['access_no'];

                                if($totalWords <= 0 ){
                                    $totalWords = 1;
                                }
                                $percenatege = $usedWords/$totalWords * 100;

                                ?>
                                <div class="row align-items-center flex-grow-1 mb-2">
                                    <div class="col">
                                        <h4 class="card-header-title">Remaining Credits</h4>
                                    </div>
                                    <!-- End Col -->
                                    <div class="col-auto">
                                        <span class="text-dark fw-semibold"><?php echo e(auth()->user()->remaining_credits); ?> prompts</span>
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Row -->
                                <!-- Progress -->
                                
                                    
                                
                                <!-- End Progress -->
                                <!-- Legend Indicators -->
                                
                                    
                                        
                                    
                                    
                                        
                                    
                                

                            </div>
                            <!-- End Body -->
                        </div>
                        <?php endif; ?>

                        <!--end::Form-->
                    </div>
                    <br>
                    <br>

                    <div id="plans-section" class="card" <?php if(auth()->user()->subscribed()): ?> style="display: none;" <?php endif; ?>>
                        <!-- begin: custom background-->
                        <div class="position-absolute w-100 h-50 rounded-card-top" style="background-color: #22B9FF"></div>
                        <!-- end: custom background-->

                        <div class="card-body position-relative">
                            <h3 class="7 text-white text-center my-10 my-lg-15">Transparent &amp; Simple Pricing</h3>
                            <!-- begin: Tabs-->
                            <div class="d-flex justify-content-center">
                                <ul class="nav nav-pills nav-primary mb-10 mb-lg-20 bg-white rounded" id="pills-tab" role="tablist">
                                    <li class="nav-item p-0 m-0">
                                        <a style="background:#000" class="nav-link  font-weight-bolder rounded-right-0 px-8 py-5" id="pills-tab-1" data-toggle="pill" href="#kt-pricing-2_content1" aria-expanded="true" aria-controls="kt-pricing-2_content1">Pricing Plans</a>
                                    </li>

                                </ul>
                            </div>
                            <!-- end: Tabs-->
                            <div class="tab-content">
                                <!-- begin: Tab pane-->
                                <div class="tab-pane show active row text-center" id="kt-pricing-2_content1" role="tabpanel" aria-labelledby="pills-tab-1">
                                    <div class="card-body  col-11 col-lg-12 col-xxl-10 mx-auto">
                                        <div class="row">
                                            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-md-4">
                                                    <div class="pt-30 pt-md-25 pb-15 px-5 text-center">
                                                        <!--begin::Icon-->
                                                        <div class="d-flex flex-center position-relative mb-25">
                                                            <span class="svg svg-fill-dark-25 opacity-4 position-absolute">
                                                                <svg width="175" height="200">
                                                                    <polyline points="87,0 174,50 174,150 87,200 0,150 0,50 87,0" />
                                                                </svg>
                                                            </span>
                                                            <span class="svg-icon svg-icon-5x svg-icon-dark-75">
                                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Flower3.svg-->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                                            <path d="M1.4152146,4.84010415 C11.1782334,10.3362599 14.7076452,16.4493804 12.0034499,23.1794656 C5.02500006,22.0396582 1.4955883,15.9265377 1.4152146,4.84010415 Z" fill="#000000" opacity="0.3" />
                                                                            <path d="M22.5950046,4.84010415 C12.8319858,10.3362599 9.30257403,16.4493804 12.0067693,23.1794656 C18.9852192,22.0396582 22.5146309,15.9265377 22.5950046,4.84010415 Z" fill="#000000" opacity="0.3" />
                                                                            <path d="M12.0002081,2 C6.29326368,11.6413199 6.29326368,18.7001435 12.0002081,23.1764706 C17.4738192,18.7001435 17.4738192,11.6413199 12.0002081,2 Z" fill="#000000" opacity="0.3" />
                                                                        </g>
                                                                    </svg>
                                                <!--end::Svg Icon-->
                                                                </span>
                                                        </div>
                                                        <!--end::Icon-->
                                                        <!--begin::Content-->
                                                        <h4 class="font-size-h3 mb-10"><?php echo e($plan['name']); ?><br>
                                                            <span style="font-size: 15px" class="text-muted">Unlock advanced features and priority support.</span>
                                                        </h4>
                                                        <div class="d-flex flex-column line-height-xl pb-10">
                                                            <span>Monthly score </span>
                                                            <span>Access to all tools</span>
                                                            <span>Product support</span>
                                                            <span>Free Assets</span>
                                                        </div>
                                                        <span class="font-size-h1 d-block font-weight-boldest text-dark">

                                                            <?php if($plan['type'] == 'monthly'): ?>
                                                                <?php echo e($plan['price_monthly']); ?>

                                                            <?php elseif($plan['type'] == 'yearly'): ?>
                                                                <?php echo e($plan['price_yearly']); ?>

                                                            <?php else: ?>
                                                                <?php echo e($plan['price_monthly']); ?>

                                                            <?php endif; ?>
                                                            <sup class="font-size-h3 font-weight-normal pl-1">$</sup></span>
                                                            <div class="mt-7">
                                                                <?php if(isset($currentSubscription) && $currentSubscription->plan_id ==  $plan['id'] && !auth()->user()->exceeded_subscription()): ?>
                                                                    <a type="button"  href="#" class=" btn btn-success text-uppercase font-weight-bolder px-15 py-3">Subscribed</a>
                                                                <?php elseif(isset($currentSubscription) && $currentSubscription->plan_id == $plan['id'] && auth()->user()->exceeded_subscription()): ?>
                                                                    <a href="<?php echo e(route('subscribe' , [$plan['id'], 'trial'])); ?>"  class="btn btn-dark text-uppercase font-weight-bolder px-15 py-3">Renew</a>
                                                                <?php else: ?>
                                                                    <a style="background: #000" type="button"  href="<?php echo e(route('subscribe' , [$plan['id'] , "trial"])); ?>" class=" btn  text-uppercase font-weight-bolder px-15 py-3">Subscribe</a>
                                                                <?php endif; ?>



                                                            </div>
                                                        <!--end::Content-->
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <!-- begin: Pricing-->

                                        </div>
                                    </div>
                                </div>
                                <!-- end: Tab pane-->
                                <!-- begin: Tab pane-->
                                <!-- end: Tab pane-->
                            </div>
                        </div>
                    </div>
                    <!--end::Card-->


                </div>
                <!--end::Content-->
            </div>
            <!--end::Profile Account Information-->
        </div>
        <!--end::Container-->
    </div>



    <!--end::Entry-->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        // cancel subscription
        $("body").on('click' , '#btn-cancel-subscription', function () {
            Swal.fire({
                text: "You are canceling your subscription. Please confirm.",
                icon: "success",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, submit!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-primary",
                    cancelButton: "btn font-weight-bold btn-default"
                }
            }).
            then(function (result) {
                if (result.value) {

                    $.ajax({
                        url: "<?php echo e(route('subscription.cancel' , auth()->user()->id)); ?>",
                        method: "GET",
                        success: function (data) {
                            if(data == "SUCCESS" ){

                               window.location.href="";

                            }
                        }

                    });

                }
                else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been submitted!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-primary"
                        }
                    });
                }

            });
        })

        $("body").on('click' , '#btn-upgrade', function () {
            $('#plans-section').toggle();
        })

    </script>
    <!--end::Page Scripts-->
   <script>

       $(document).ready(function(){


           $('.navi-link').click(function(){

               $('.navi-link').removeClass('active')

               $(this).addClass('active')
           })
       })

   </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel pros\gptBot\resources\views/dashboard/subscription.blade.php ENDPATH**/ ?>