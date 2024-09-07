

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

        .form-control:focus{
            border: none !important;
        }

        <?php if(auth()->user()->type == 'client'): ?>
        .header-mobile-fixed .header-mobile{

            background: #2f2f2f;
        }

        .center_image {
            height: 70vh !important;
            display: grid !important;
            place-items: center !important;
        }


        <?php endif; ?>
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!--begin::Subheader-->
    <div  class="container subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h2 style="color: #3a384e" class="d-flex align-items-center <?php if(auth()->user()->type == 'client'): ?> text-white <?php endif; ?> font-weight-bolder my-1 mr-3">
                        Anesthesia</h2>
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
        <div class="row ">

            <?php if(auth()->user()->type == 'admin'): ?>
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

                                        <div class="text-center col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                                            <span class="svg-icon svg-icon-3x svg-icon-dark d-block my-2">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                                <i class="icon-3x text-dark-50 flaticon2-search"></i>                                                <!--end::Svg Icon-->
                                            </span>
                                            <a href="" class="text-dark font-weight-bolder font-size-h2">
                                                <?php echo e(DB::table('users')->where('type', 'client')->get()->count()); ?> Users
                                            </a>
                                        </div>

                                    </div>
                                </div>

                                <!--end::Stats-->
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-xl-12 ">
                    <div class="mr-auto " style="box-shadow: none">

                        <input hidden class="conversation_id" value="<?php echo e(isset($conversation) ?  $conversation['id'] : null); ?>">

                        <div class="modal-body" >
                            <div class="card-custom">
                                <!--begin::Header-->
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div  class="conversation-container not-visible">
                                    <!--begin::Scroll-->
                                    

                                    <div id="messages_container" style="" class="   <?php if(isset($prompts)): ?> center_image <?php endif; ?> mt-2" >

                                    <?php if(isset($prompts)): ?>
                                        <!--begin::Messages-->
                                        <img style="width: 40%" class="mr-5 prompt_image" src="<?php echo e(asset('ai_main_white.png')); ?>">


                                            <div class="row prompts_container mt-8">
                                                <?php $__currentLoopData = $prompts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prompt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div style="cursor: pointer" class="col-xl-6 prompt_message " data-prompt="<?php echo e($prompt['description']); ?>">
                                                    <!--begin::Card-->
                                                        <div style="border-radius: 20%" class="card card-custom gutter-b card-stretch">
                                                        <!--begin::Body-->
                                                        <div class="card-body" style="border-radius: 19px;">
                                                            <!--begin::Text-->
                                                            <p class="">
                                                               <?php echo e($prompt['description']); ?>

                                                            </p>
                                                            <!--end::Text-->
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                    <!--end::Card-->
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>


                                        <div id="gpt_messages" class=" ">

                                            <?php if(isset($conversation)): ?>
                                                <?php $__currentLoopData = $conversation->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conversation_message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="d-flex flex-column mb-5 align-items-end">
                                                        <div style="background: #2f2f2f; color: white;border-radius: 4% !important;" class="mt-2 rounded p-5   font-weight-bold font-size-lg text-left max-w-600px"><?php echo e($conversation_message['question']); ?></div>
                                                    </div>

                                                    <div class="gpt-entry">
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-2">
                                                                <img style="width:20px" alt="Pic" src="<?php echo e(asset('ai_white.png')); ?>">
                                                            </div>
                                                            <div>
                                                                <a href="#" class="text-muted font-weight-bold font-size-h6"></a>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column mb-5 align-items-start">
                                                            <div id="#" style="color:white;background: transparent" class="mt-2 rounded p-5 font-weight-bold font-size-lg text-left max-w-600px"><?php echo $conversation_message['answer']; ?></div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                        </div>
                                        <!--end::Messages-->
                                    </div>
                                    <!--end::Scroll-->
                                </div>

                                <!--end::Body-->
                                <!--begin::Footer-->
                                <div class="align-items-center  btn_send_wrap" style="">
                                    <!--begin::Compose-->
                                    <div class="input-group mb-3">
                                        <input type="text" style="border:none ;height: 45px; border-top-left-radius: 17px; border-bottom-left-radius: 17px; background: #2f2f2f;  color: white;" class="gpt_msg_input form-control" placeholder="Message ANESTHETIZE.AI">
                                        <div class="input-group-append">
                                            <span style="border-top-right-radius: 17px;border-bottom-right-radius: 17px;color: #0000003b;cursor: pointer" class="btn_send_gpt input-group-text">
                                                

                                                

                                                <span class="svg-icon svg-icon-wanring svg-icon-x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo3/dist/../src/media/svg/icons/Navigation/Angle-double-up.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <title>Stockholm-icons / Navigation / Angle-double-up</title>
    <desc>Created with Sketch.</desc>
    <defs/>
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M8.2928955,10.2071068 C7.90237121,9.81658249 7.90237121,9.18341751 8.2928955,8.79289322 C8.6834198,8.40236893 9.31658478,8.40236893 9.70710907,8.79289322 L15.7071091,14.7928932 C16.085688,15.1714722 16.0989336,15.7810586 15.7371564,16.1757246 L10.2371564,22.1757246 C9.86396402,22.5828436 9.23139665,22.6103465 8.82427766,22.2371541 C8.41715867,21.8639617 8.38965574,21.2313944 8.76284815,20.8242754 L13.6158645,15.5300757 L8.2928955,10.2071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 15.500003) scale(-1, 1) rotate(-90.000000) translate(-12.000003, -15.500003) "/>
        <path d="M6.70710678,12.2071104 C6.31658249,12.5976347 5.68341751,12.5976347 5.29289322,12.2071104 C4.90236893,11.8165861 4.90236893,11.1834211 5.29289322,10.7928968 L11.2928932,4.79289682 C11.6714722,4.41431789 12.2810586,4.40107226 12.6757246,4.76284946 L18.6757246,10.2628495 C19.0828436,10.6360419 19.1103465,11.2686092 18.7371541,11.6757282 C18.3639617,12.0828472 17.7313944,12.1103502 17.3242754,11.7371577 L12.0300757,6.88414142 L6.70710678,12.2071104 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(12.000003, 8.500003) scale(-1, 1) rotate(-360.000000) translate(-12.000003, -8.500003) "/>
    </g>
</svg><!--end::Svg Icon--></span>
                                                
                                            </span>
                                        </div>

                                    </div>
                                    <span class=" text-muted"  >anesthetize.ai can make mistakes. Check important info.</span>

                                    <!--begin::Compose-->
                                </div>
                                <!--end::Footer-->
                            </div>

                            <!--end::Form-->
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>


    <!--end::Entry-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <script>
        // Add an event listener for the 'keydown' event
        document.addEventListener('keydown', function(event) {
            // Check if the 'Alt' key was pressed
            if (event.key === 'Enter') {
                // Display an alert
                // const myModal = document.getElementById('kt_chat_modal');
                // const isOpen = myModal.classList.contains('show');
                // if (isOpen) {
                _sendGPTMessage()
                // }
            }
        });

        $('body').on('click' , '.btn_send_gpt', function () {
            _sendGPTMessage()
        });

        $('body').on('click' , '.prompt_message', function () {

            var message = $(this).data('prompt');


            _sendGPTMessage(message)
        });

        var is_processing  = false;

        var _sendGPTMessage = function (message){

            $('.prompt_image').remove();
            $('.prompts_container').remove();
            $('#messages_container').removeClass('center_image');


            if(!message){
                var text = $('.gpt_msg_input').val();
            }else {

                text = message;
            }

            var conversation_id = $('.conversation_id').val();

            if (text.trim() !== '' && !is_processing) {
                const gpt_messages          = document.getElementById('gpt_messages');
                const messages_container    = document.getElementById('bodyContainer');

                is_processing = true;

                $('.gpt_msg_input').val('')

                $('.btn_send_gpt').html('<div class="spinner spinner-sm spinner-dark spinner-center"></div>')

                var html = `<div class="d-flex flex-column mb-5 align-items-end">
		 						<div style="background: #2f2f2f; color: white;border-radius: 4% !important;" class="mt-2 rounded p-5   font-weight-bold font-size-lg text-left max-w-600px">${text}</div>
		 					</div>`;

                gpt_messages.innerHTML += html;
                // scroll to latest
                messages_container.scrollTop = messages_container.scrollHeight;


                $.ajax({
                    url: "<?php echo route('send.message'); ?>",
                    method: "GET",
                    data: {
                        conversation_id:conversation_id,
                        text:text,
                    },
                    success: function (data) {
                        if(data.status === 200 ){

                            const uniqueId = 'gpt_response_' + new Date().getTime();

                            displayHtmlWordByWord(data.message, gpt_messages, messages_container, uniqueId);

                            $('.conversation_id').val(conversation_id);

                            // $('.gpt_msg_input').prop('disabled', false);
                            $('.btn_send_gpt').html('Send');
                            is_processing = false;
                        }else {

                            Swal.fire({
                                text: data.message,
                                icon: "error",
                                showCancelButton: false,
                                buttonsStyling: false,
                                confirmButtonText: "Ok!",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-dark",
                                    cancelButton: "btn font-weight-bold btn-default"
                                }
                            }).
                            then(function (result) {

                                if(result.value) {

                                    KTApp.blockPage({
                                        state: 'danger',
                                        message: 'Please wait...'
                                    });
//                            KTApp.unblockPage();


                                    window.location.href ="/dashboard/subscription"
                                }
                            });

                        }
                    }
                });

            }
        }

        function displayHtmlWordByWord(html, gpt_messages, messages_container, uniqueId) {
            var messageHtml = `<div class="gpt-entry">
                           <div class="d-flex align-items-center">
                               <div class="mr-2">
                                   <img style="width:20px" alt="Pic" src="<?php echo e(asset('ai_white.png')); ?>">
                               </div>
                               <div>
                                   <a href="#" class="text-muted font-weight-bold font-size-h6"></a>
                               </div>
                           </div>
                           <div class="d-flex flex-column mb-5 align-items-start">
                               <div id="${uniqueId}" style="color:white;background: transparent" class="mt-2 rounded p-5 font-weight-bold font-size-lg text-left max-w-600px"></div>
                           </div>
                       </div>`;

            gpt_messages.innerHTML += messageHtml;

            var gpt_response = document.getElementById(uniqueId);

            var parser = new DOMParser();
            var doc = parser.parseFromString(html, 'text/html');
            var words = Array.from(doc.body.childNodes).flatMap(extractTextNodes);
            var index = 0;

            function addNextWord() {
                if (index < words.length) {
                    gpt_response.innerHTML += words[index].outerHTML || words[index].textContent;
                    index++;
                    messages_container.scrollTo({ top: messages_container.scrollHeight, behavior: 'smooth' });
                    setTimeout(addNextWord, 100); // Adjust the speed (in milliseconds) here
                }
            }

            addNextWord();
        }

        function extractTextNodes(node) {
            if (node.nodeType === Node.TEXT_NODE) {
                return node.textContent.split(' ').map(word => {
                    var span = document.createElement('span');
                    span.textContent = word + ' ';
                    return span;
                });
            } else if (node.nodeType === Node.ELEMENT_NODE) {
                return [node];
            } else {
                return [];
            }
        }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel pros\gptBot\resources\views/dashboard/index.blade.php ENDPATH**/ ?>