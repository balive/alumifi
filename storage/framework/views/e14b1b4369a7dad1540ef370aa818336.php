
<div class="aside aside-left d-flex aside-fixed" id="kt_aside" style="z-index: 10000">
    <!--begin::Primary-->

    <!--end::Primary-->
    <!--begin::Secondary-->
    <div class="aside-secondary d-flex flex-row-fluid" <?php if(auth()->user()->type == 'client'): ?> style="background-color: #2f2f2f;" <?php endif; ?> >
        <!--begin::Workspace-->
        <div class="aside-workspace scroll scroll-push my-2">
            <!--begin::Tab Content-->
            <div class="tab-content">
                <!--begin::Tab Pane-->
                <!--end::Tab Pane-->
                <a href="<?php echo e(URL::to('/')); ?>">
                    
                </a>
                <!--begin::Tab Pane-->
                <div class="tab-pane fade show active" id="kt_aside_tab_2">
                    <!--begin::Aside Menu-->
                    <div class="aside-menu-wrapper flex-column-fluid px-10 py-5" id="kt_aside_menu_wrapper">
                        <!--begin::Menu Container-->
                        <div <?php if(auth()->user()->type == 'client'): ?> style="background-color: #2f2f2f;" <?php endif; ?> id="kt_aside_menu" class="aside-menu min-h-lg-800px" data-menu-vertical="1" data-menu-scroll="1">
                            <!--begin::Menu Nav-->
                            <ul class="menu-nav">

                                <li class="menu-item" aria-haspopup="true">
                                    <a  href="<?php echo e(route('dashboard')); ?>" class="text-muted   font-weight-bold side-link">
                                        <div <?php if(request()->segment(1)==''): ?> style="background: #fff; border-radius: 10px" <?php endif; ?>  class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 <?php if(request()->segment(1)==''): ?> active <?php endif; ?> ">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class=" symbol-40 symbol-light mr-7">
                                                    <span class="symbol-label ">

                                                        <?php if(auth()->user()->type == 'client'): ?>
                                                        <img alt="Logo" src="<?php echo e(asset('ai_white.png')); ?>" class="logo-default max-h-20px" />

                                                            <?php else: ?>

                                                                <span class="svg-icon svg-icon-xl  <?php if(request()->segment(1)=='' ): ?> svg-icon-success <?php endif; ?>">
                                                                <i style="font-size: 1.7rem" class=" <?php if(request()->segment(1)=='' ): ?> text-primary  <?php endif; ?> flaticon-squares"></i>

                                                                <!--end::Svg Icon-->
                                                                </span>
                                                        <?php endif; ?>

                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                                    <span class="<?php if(request()->segment(1)=='' ): ?> text-primary <?php endif; ?> font-size-h6 mb-0">
                                                    Anesthesia
                                                    </span>

                                                </div>
                                                <!--begin::End-->
                                            </div>
                                        </div>
                                        <!--end::Item-->
                                    </a>

                                </li>


                                <?php $__currentLoopData = auth()->user()->conversations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conversation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="menu-item" aria-haspopup="true">
                                        <a  href="<?php echo e(route('conversation.show' , $conversation['id'])); ?>" class="text-muted   font-weight-bold side-link">
                                            <div <?php if(request()->segment(3) == $conversation['id']): ?> style="color: #f4da3e" <?php endif; ?>  class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 <?php if(request()->segment(1)==''): ?> active <?php endif; ?> ">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class=" symbol-40 symbol-light mr-12">
                                                        <span class="symbol-label ">-</span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <span style="width: 72%;font-size: 12px !important;" class=" mb-0">
                                                        <?php echo e($conversation['name']); ?>

                                                        </span>

                                                    </div>
                                                    <!--begin::End-->
                                                </div>
                                            </div>
                                            <!--end::Item-->
                                        </a>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





                               <?php if(auth()->user()->type == 'admin'): ?>


                                    <li class="menu-item" aria-haspopup="true">
                                    <a <?php if(request()->segment(2)=='users'): ?> style="background: #fff; border-radius: 10px" <?php endif; ?> href="<?php echo e(route('users')); ?>" class="text-muted  font-weight-bold side-link">
                                        <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 <?php if(request()->segment(1)=='users'): ?> active <?php endif; ?> ">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class=" symbol-40 symbol-light mr-7">
                                                    <span class="symbol-label  ">
                                                        <span class="svg-icon svg-icon-xl  ">
                                                          <i style="font-size: 1.7rem"  class=" <?php if(request()->segment(2)=='users' ): ?> text-primary  <?php endif; ?> icon-xl fas fa-user"></i>                                             <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <span class="<?php if(request()->segment(2)=='users'): ?> text-primary <?php endif; ?> font-size-h6 mb-0">
                                                        Users

                                                        </span>

                                                </div>
                                                <!--begin::End-->
                                            </div>
                                        </div>
                                        <!--end::Item-->
                                    </a>
                                </li>

                                    <li class="menu-item" aria-haspopup="true">
                                        <a <?php if(request()->segment(2)=='users'): ?> style="background: #fff; border-radius: 10px" <?php endif; ?> href="<?php echo e(route('plans')); ?>" class="text-muted  font-weight-bold side-link">
                                            <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 <?php if(request()->segment(1)=='plans'): ?> active <?php endif; ?> ">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class=" symbol-40 symbol-light mr-7">
                                                        <span class="symbol-label  ">
                                                            <span class="svg-icon svg-icon-xl  ">
                                                              <i style="font-size: 1.7rem"  class=" <?php if(request()->segment(2)=='plans' ): ?> text-primary  <?php endif; ?> icon-xl flaticon-list	"></i>                                             <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <span class="<?php if(request()->segment(2)=='plans'): ?> text-primary <?php endif; ?> font-size-h6 mb-0">
                                                            Plans
                                                        </span>

                                                    </div>
                                                    <!--begin::End-->
                                                </div>
                                            </div>
                                            <!--end::Item-->
                                        </a>
                                    </li>

                                    <li class="menu-item" aria-haspopup="true">
                                        <a <?php if(request()->segment(2)=='users'): ?> style="background: #fff; border-radius: 10px" <?php endif; ?> href="<?php echo e(route('prompts')); ?>" class="text-muted  font-weight-bold side-link">
                                            <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 <?php if(request()->segment(1)=='prompts'): ?> active <?php endif; ?> ">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class=" symbol-40 symbol-light mr-7">
                                                        <span class="symbol-label  ">
                                                            <span class="svg-icon svg-icon-xl  ">
                                                              <i style="font-size: 1.7rem"  class=" <?php if(request()->segment(2)=='prompts' ): ?> text-primary  <?php endif; ?> icon-xl flaticon-folder-1"></i>                                             <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <span class="<?php if(request()->segment(2)=='prompts'): ?> text-primary <?php endif; ?> font-size-h6 mb-0">
                                                            Prompts
                                                        </span>

                                                    </div>
                                                    <!--begin::End-->
                                                </div>
                                            </div>
                                            <!--end::Item-->
                                        </a>
                                    </li>

                                    <li class="menu-item" aria-haspopup="true">
                                        <a <?php if(request()->segment(2)=='settings'): ?> style="background: #fff; border-radius: 10px" <?php endif; ?> href="<?php echo e(route('settings')); ?>" class="text-muted  font-weight-bold side-link">
                                            <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 <?php if(request()->segment(2)=='settings'): ?> active <?php endif; ?> ">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class=" symbol-40 symbol-light mr-7">
                                                    <span class="symbol-label  ">
                                                        <span class="svg-icon svg-icon-xl  ">
                                                          <i style="font-size: 1.7rem"  class=" <?php if(request()->segment(2)=='settings' ): ?> text-primary  <?php endif; ?> icon-xl fas fa-server"></i>                                             <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <span class="<?php if(request()->segment(2)=='settings'): ?> text-primary <?php endif; ?> font-size-h6 mb-0">
                                                        Settings

                                                        </span>

                                                    </div>
                                                    <!--begin::End-->
                                                </div>
                                            </div>
                                            <!--end::Item-->
                                        </a>
                                    </li>

                                <?php else: ?>



                                <?php endif; ?>



                            </ul>
                            <!--end::Menu Nav-->
                        </div>
                        <!--end::Menu Container-->
                    </div>
                    <!--end::Aside Menu-->
                </div>

                <!--end::Tab Pane-->

            </div>
            <!--end::Tab Content-->
        </div>
        <!--end::Workspace-->

        
            
            
                
            
        

    </div>
    <!--end::Secondary-->
</div>

<?php /**PATH D:\Laravel pros\gptBot\resources\views/layouts/aside.blade.php ENDPATH**/ ?>