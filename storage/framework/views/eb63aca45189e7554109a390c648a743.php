<?php $__env->startSection('styles'); ?>
    <style>

        .datatable-head  .datatable-cell span{

            text-transform: uppercase;
            color: #B5B5C3 !important;
        }

        .datatable.datatable-default > .datatable-table > .datatable-head .datatable-row >
        .datatable-cell.datatable-cell-sort, .datatable.datatable-default > .datatable-table >
        .datatable-body .datatable-row > .datatable-cell.datatable-cell-sort, .datatable.datatable-default >
        .datatable-table > .datatable-foot .datatable-row > .datatable-cell.datatable-cell-sort
        {

            white-space: nowrap;
        }
        .datatable.datatable-default > .datatable-table{

            overflow-x: scroll;

        }

        .card-custom{
            transition: all 0.3s ease;  ;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!--begin::Subheader-->
    <div class="container subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h2 style="color: #3a384e" class="d-flex align-items-center  font-weight-bolder my-1 mr-3">
                        Settings</h2>
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
        <br>
        <div class="row">
            <div class="col-xl-12 mt-5">
                <div class="col-xxl-12">
                    <div class="gutter-b">
                        <!--begin::Header-->
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body p-0 position-relative overflow-hidden">
                            <!--begin::Chart-->
                            <div id="" class="" style="height: 100px"></div>
                            <!--end::Chart-->
                            <!--begin::Stats-->
                            <div class="mt-n25">
                                <!--begin::Row-->
                                <div class="row m-0">


                                </div>
                            </div>

                            <!--end::Stats-->
                        </div>

                        <!--end::Body-->
                    </div>

                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">
                                Settings
                            </h3>

                        </div>
                        <!--begin::Form-->
                        <form class="form" method="POST" action="<?php echo e(route('settings.store')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Engine </label>
                                    <select class="form-control" name="engine">
                                        <option selected disabled >Please Select </option>
                                        
                                        <option <?php if($settings['engine'] ==  'gpt-3.5-turbo-16k'): ?> selected <?php endif; ?> >gpt-3.5-turbo-16k</option>
                                        <option <?php if($settings['engine'] ==  'gpt-4o'): ?> selected <?php endif; ?> >gpt-4o</option>
                                        <option <?php if($settings['engine'] ==  'gpt-4o-mini'): ?> selected <?php endif; ?> >gpt-4o-mini</option>
                                    </select>
                                </div>


                                <!--end: Code-->
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Save</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>            <!--end::Advance Table Widget 1-->

                </div>
            </div>

        </div>

    </div>

    <!--end::Entry-->
<?php $__env->stopSection(); ?>



<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel pros\biasBot\resources\views/dashboard/settings.blade.php ENDPATH**/ ?>