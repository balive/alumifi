<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<!--begin::Head-->
<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />


    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <link href="<?php echo e(asset('backend/css/pages/wizard/wizard-1.css')); ?>" rel="stylesheet" type="text/css" />

    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="<?php echo e(asset('backend/plugins/custom/fullcalendar/fullcalendar.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="<?php echo e(asset('backend/plugins/global/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('backend/plugins/custom/prismjs/prismjs.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('backend/css/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="<?php echo e(asset('favicon.png')); ?>" />

    <?php echo $__env->yieldContent('styles'); ?>

    <style>

        <?php if(auth()->user()->type == 'client'): ?>
        body{
            background: #231f20;
        }
        <?php endif; ?>

        .btn.btn-primary.dropdown-toggle:after{

            margin-left: 8px;
        }

        .datatable.datatable-default > .datatable-table >
        .datatable-body .datatable-row > .datatable-cell{
            padding-top : 25px
        }

        .fullnametxt{

            text-transform: none!important;
        }
        .min-h-110{

            min-height: 110px;
        }
        .fullnametxt , .fullnametxt-title , .paymentNameInput{


            display:none
        }
        .fullnametxt::placeholder {

            color:#cccc;
        }

        .startFileButton:after{

            margin-left: 7px !important;

        }

        .datatable.datatable-default > .datatable-table {

            overflow-x: auto !important;

        }

        th{
            cursor: pointer
        }
        .first-col-table-tasks{

            width:70px;

        }
        .first-col-table{

            max-width: 65px;
        }


        .aside-secondary-enabled .aside{
            width: 250px !important;
        }
        .aside-menu .menu-nav > .menu-item {
            position: relative;
            margin: 0;
            margin-left: -22px;
        }

        .dataTables_length label {
            font-weight: 300;
        }
        .dataTables_length label select{
            background-color: #F3F6F9 !important;
            height: calc(1.35em + 1.1rem + 2px);
            padding: 0.55rem 0.75rem;
            font-size: 0.925rem;
            line-height: 1.35;
            width: 68px;
            border: none;
            border-radius: 0.28rem;
        }

        .paginate_button{

            color: #7E8299;
            background-color: #F3F6F9;
            border-color: #F3F6F9;
        }

        .dataTables_paginate {

            margin-bottom: 14px;

        }

        .paginate_button {
            color: #7E8299;
            background-color: #F3F6F9;
            border-color: #F3F6F9;
            padding: 10px;
            border-radius: 3px;
            font-size: 11px;
            margin: 3px;
            cursor: pointer;
        }

        .paginate_button.current {
            background-color:#0BB7AF;
            color: white;

        }
        .paginate_button:hover {
            background-color:blue;
            color: white;

        }

        <?php if(auth()->user()->type == 'client'): ?>

        .gpt-entry p , .gpt-entry h1 ,.gpt-entry h2, .gpt-entry h3, .gpt-entry h4,
        .gpt-entry h5, .gpt-entry h6, .gpt-entry span , .gpt-entry div{
            color: white !important;
        }
         a:hover{
            color:  #f4da3e !important;
        }

        .navi .navi-item .navi-link:hover .navi-text,.navi .navi-item .navi-link:hover .navi-icon i  {

            color:  #f4da3e !important;
        }
        .card , .card-body {
            background: #2f2f2f;
            border: none;
        }

        .card span , .card div , .card label , .card h3, .card a , .card a:hover{
            color:white !important;
        }

        .card-header{
            background: #2f2f2f;
            border: none !important;
        }


        .btn_send_wrap{
            position: fixed; width: 50%;bottom: 5%;left: 32%;
        }

        <?php if(request()->segment(2) == null): ?>
            #kt_subheader{
                position: fixed;
                z-index: 9999;
                width: 85%;
            }
        <?php endif; ?>

        /**/
        #messages_container{
            /*overflow: auto;*/
            height: 66%;
            position: absolute;
            width: 63%;
            left: 18%;
        }
       <?php endif; ?>

        @media (max-width: 1300px){

            .first-col-table{

                max-width: 70px;
            }

        }
        @media (max-width: 991px){

            .sec_submit{

                right: 10%;
            }

            .first-col-table{

                max-width: 44px;
                width: 68px !important;
            }

        }

        <?php if(auth()->user()->type == 'client'): ?>
            @media (max-width: 991px){

                .btn_send_wrap {
                    position: fixed;
                    width: 70%;
                    bottom: 5%;
                    left: 50%;
                    transform: translateX(-50%);
                }

                #kt_subheader{
                    position: fixed;
                    z-index: 9999;
                    width: 100%;
                }

                #messages_container{
                    position: absolute;
                    /*overflow: auto;*/
                    height: 66%;
                    width: 93%;
                    left: 5%;
                }
            }
        <?php endif; ?>

        @media (max-width: 663px){

            .first-col-table{

                max-width: 65px;
                width: 68px !important;
            }

            .first-col-table-tasks{

                width:70px;
                padding-right: 8px !important;


            }

        }
        @media (max-width: 480px){

            .sec_submit{

                right: 12%;
                top: -49px;

            }

        }
        @media (max-width: 320px){

            .sec_submit{

                right: 14%;

            }

        }

        @media (min-width: 992px){

            .aside-minimize .aside {
                width: 65px !important;
                transition: all 0.3s ease;
            }

            .aside-secondary-enabled.aside-fixed .wrapper {
                padding-left: 247px;
            }

            .aside-fixed.aside-minimize .wrapper {
                padding-left: 70px !important;
                transition: all 0.3s ease;
            }




        }

    </style>

</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-mobile-fixed subheader-enabled aside-enabled aside-fixed aside-secondary-enabled page-loading">


<div id="bodyContainer" style="overflow-y: auto; <?php if(auth()->user()->type == 'client' && (request()->segment(2) == null || request()->segment(2) == 'conversations') ): ?> height: 83% <?php else: ?>;height: 100%; <?php endif; ?>">

    <!--begin::Main-->
    <!--begin::Header Mobile-->
    <div id="kt_header_mobile" class="header-mobile">
        <!--begin::Logo-->
        <a href="<?php echo e(URL::to('/')); ?>">
            <img alt="Logo" src="<?php echo e(asset('ai_white.png')); ?>" class="logo-default max-h-30px" />
        </a>
        <!--end::Logo-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                <span></span>
            </button>
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Aside-->

        <?php echo $__env->make('layouts.aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Content-->

                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                    <?php echo $__env->yieldContent('content'); ?>

                </div>

                <!--end::Content-->
                <!--begin::Footer-->
                <!--doc: add "bg-white" class to have footer with solod background color-->
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->


                        
                            
                        
                        
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->




    <div class="modal fade" id="delete_record_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Are you sure you want to delete this item ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Please confirm that you want to delete this item. This action cannot be reserved.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="" id="delete_record_btn" type="submit" class="btn btn-danger">Delete</a>
                </div>

            </div>

        </div>
    </div>

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop">
        <span class="svg-icon">
        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24" />
                <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
            </g>
        </svg>
            <!--end::Svg Icon-->
        </span>
    </div>
    <!--end::Scrolltop-->
</div>


<!--begin::Global Theme Bundle(used by all pages)-->
<script src="<?php echo e(asset('backend/plugins/global/plugins.bundle.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/custom/prismjs/prismjs.bundle.js')); ?>"></script>
<script src="<?php echo e(asset('backend/js/scripts.bundle.js')); ?>"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->
<script src="<?php echo e(asset('backend/plugins/custom/fullcalendar/fullcalendar.bundle.js')); ?>"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="<?php echo e(asset('backend/js/pages/widgets.js')); ?>"></script>

<!--- For exporting--->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script>
<script src="<?php echo e(asset('backend/js/export.js')); ?>"></script>

<?php echo $__env->yieldContent('scripts'); ?>


<script>
    $("body").on("click" , '.open_delete_modal' , function(e){

        var action = $(this).data('action');

        $('#delete_record_btn').attr('href', action);

    });



</script>

<script>
    // Search Table
    (function(document) {
        'use strict';

        var LightTableFilter = (function(Arr) {

            var _input;

            function _onInputEvent(e) {
                _input = e.target;
                var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
                Arr.forEach.call(tables, function(table) {
                    Arr.forEach.call(table.tBodies, function(tbody) {
                        Arr.forEach.call(tbody.rows, _filter);
                    });
                });
            }

            function _filter(row) {
                var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
                row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
            }

            return {
                init: function() {
                    var inputs = document.getElementsByClassName('light-table-filter');
                    Arr.forEach.call(inputs, function(input) {
                        input.oninput = _onInputEvent;
                    });
                }
            };
        })(Array.prototype);

        document.addEventListener('readystatechange', function() {
            if (document.readyState === 'complete') {
                LightTableFilter.init();
            }
        });


    })(document);
</script>

<script>
    $('#csv').on('click',function(){
        $(".kt_datatable").tableHTMLExport({type:'csv',filename:'table.csv'});
    });
    $('#pdf').on('click',function(){
        $(".kt_datatable").tableHTMLExport({type:'pdf',filename:'table.pdf'});
    })
</script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('.kt_datatable').DataTable( {
            "paging": false,
            "searching": false,
            "info": false,
            "sorting": false,
        } );
    } );

</script>
<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>
<?php /**PATH D:\Laravel pros\gptBot\resources\views/layouts/master.blade.php ENDPATH**/ ?>