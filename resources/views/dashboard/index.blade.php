@extends('layouts.master')

@section('styles')
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
            /*border:  !important;*/
        }

        @if(!isset(auth()->user()->type) || (isset(auth()->user()->type) && auth()->user()->type == 'client'))

        .header-mobile-fixed .header-mobile{

            background: #2f2f2f;
        }

        .center_image {
            height: 70vh !important;
            display: grid !important;
            place-items: center !important;
        }



        @endif


        /*Typing animation **/

        .tiblock {
            align-items: center;
            display: flex;
            height: 17px;
        }

        .ticontainer .tidot {
            background-color: #90949c;
        }

        .tidot {
            -webkit-animation: mercuryTypingAnimation 1.5s infinite ease-in-out;
            border-radius: 2px;
            display: inline-block;
            height: 4px;
            margin-right: 2px;
            width: 4px;
        }

        @-webkit-keyframes mercuryTypingAnimation{
            0%{
                -webkit-transform:translateY(0px)
            }
            28%{
                -webkit-transform:translateY(-5px)
            }
            44%{
                -webkit-transform:translateY(0px)
            }
        }

        .tidot:nth-child(1){
            -webkit-animation-delay:200ms;
        }
        .tidot:nth-child(2){
            -webkit-animation-delay:300ms;
        }
        .tidot:nth-child(3){
            -webkit-animation-delay:400ms;
        }


        .circular-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 33px; /* Adjust size as needed */
            height: 33px; /* Adjust size as needed */
            background-color: #019cc1;
            border-radius: 50%;
            color: black; /* SVG fill color */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optional: add shadow */
        }

        .circular-icon svg {
            /*width: 22px;*/
            /*height: 22px;*/
            fill: currentColor; /* Inherits color from parent */
        }

        .custom-placeholder::placeholder {
            color: #019cc1;
        }
    </style>
@endsection
@section('content')
    <!--begin::Subheader-->
    <div  class="container subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center mr-1">
                <!--begin::Page Heading-->
                <div class="d-block align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    @if(!isset(auth()->user()->type) || (isset(auth()->user()->type) && auth()->user()->type == 'client'))
                        <img style="width: 125px" class="mb-5 header-logo" src="{{ asset('alumifi-logo2.png') }}">
                    @else
                        <h2 style="color: #3a384e" class="d-flex align-items-center  font-weight-bolder my-1 mr-3">
                            aLumifi.ai</h2>
                    @endif



                    <div class="recheck_section  @if(isset(auth()->user()->type) && auth()->user()->type == "client" && isset($conversation) && $conversation->id) @else d-none @endif">
                        <a href="#" style="color: #019cc1" class="font-size-sm mt-5 mb-6" data-toggle="modal" data-target="#add_item" >
                                <span class="svg-icon svg-icon-md svg-icon-white mr-3">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                                    <i style="font-size: 19px" class="flaticon2-gear  text-white"></i>
                                    <!--end::Svg Icon-->
                                </span>

                            Change Bias
                        </a>
                    </div>
                    <!--end::Page Title-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center flex-wrap">
                <!--begin::Button-->

                @auth
                    @include('layouts.profile_button')

                @endauth

            <!--end::Button-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="container">
        <div class="h3 text-center">
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <span class="text-danger" role="alert">
                        <strong style="font-size: 13px; font-weight: 400;">{{ $error }}</strong><br>
                    </span>
                @endforeach
            @endif
            @include('flash::message')
        </div>
        <br>
        <div class="row ">

            @if(isset(auth()->user()->type) && auth()->user()->type == 'admin')
                <div class="col-xl-12 mt-5">
                    <div class="col-xxl-12">
                        <div class="gutter-b">
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
                                                {{ DB::table('users')->where('type', 'client')->get()->count() }} Users
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
            @else
                <div class="col-xl-12 ">
                    <div class="mr-auto " style="box-shadow: none">

                        <input hidden class="conversation_id" value="{{ isset($conversation) ?  $conversation['id'] : null }}">

                        <div class="modal-body" >
                            <div class="card-custom">
                                <!--begin::Header-->
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div  class="conversation-container not-visible">
                                    <!--begin::Scroll-->
                                    {{--<span  style="margin: auto;width: 50%;color: #cacaca;position: absolute;top: 7px;left: 43%;">{{ Carbon\Carbon::now()->format('g:i A') }}</span>--}}
                                    <div id="messages_container" style="" class=" mt-2" >

                                        <div class="data_section mt-40   @if(request()->segment(3) != '') d-none @endif">
                                            <!--begin::Form-->
                                            <div class="col-12 col-md-12  mb-5">
                                                <br>
                                                <h3  class=" form-control-label text-white">STEP 1: Enter URL you want bias checked</h3>
                                            </div>

                                            <div class="col-12 col-md-12  mb-5">
                                                <br>
                                                <label  class=" form-control-label text-white"> URL</label>
                                                <input style="color:#019cc1; border-color: #019cc1;  background: transparent" type="text" class=" form-control  form-control-solid url_input" name="name" value="{{ isset($conversation) ? $conversation->url : null  }}">
                                            </div>

                                            <div class="col-12 col-md-12  mb-5 perspective_select d-none">
                                                <br>
                                                <label  class="form-control-label text-white">Select Perspective</label>
                                                <select style="color:#019cc1; border-color: #019cc1;  background: transparent" id="bias_select" class="form-control">
                                                    <option selected disabled value="0">Select Your Perspective </option>
                                                    <option >Left</option>
                                                    <option >Socialist </option>
                                                    <option >Libertarian </option>
                                                    <option >Right </option>

                                                    <option >Christian</option>
                                                    <option >Islam </option>
                                                    <option >Buddhist </option>
                                                    <option >Agnostic </option>

                                                    <option >Scientific</option>
                                                    <option >Green</option>
                                                    <option >Skeptical</option>
                                                    <option >Crypto</option>
                                                    <option >Jewish</option>
                                                </select>
                                            </div>

                                            <div class="col-12 col-md-12  mb-5 d-none">
                                                <br>
                                                <label  class=" form-control-label text-white">Fetched Data</label>
                                                <textarea rows="5" id="scraped_data"  type="text" placeholder="your fetched data shows up here" class="form-control form-control-solid" ></textarea>
                                            </div>
                                            <div class="ml-3">
                                                <button style="border-color: white; background: transparent" id="btnFetch" type="button" class=" btn btn-success mr-2" >BIAS Check!</button>
                                                <!--end::Form-->
                                            </div>
                                        </div>


                                        <div id="gpt_messages" class=" @if(request()->segment(3) == '') mt-7 @endif ">

                                            @if(isset($conversation))
                                                @foreach($conversation->messages as $conversation_message)
                                                    <div class="d-flex flex-column mb-5 align-items-end">
                                                        <div style="background: #2f2f2f; color: white;border-radius: 4% !important;" class="mt-2 rounded p-5   font-weight-bold font-size-lg text-left max-w-600px">{!! $conversation_message['question'] !!}</div>
                                                    </div>

                                                    <div class="gpt-entry">
                                                        <div class="d-flex align-items-start">
                                                            <div class="mr-2">
                                                                <img style="width: 20px;" alt="Pic" src="{{ asset('ai_white.png') }}">
                                                            </div>
                                                            <div id="message_{{ $loop->index }}" style="color:white; background: transparent;" class="rounded pl-4 pt-1 font-weight-bold font-size-lg text-left max-w-600px">
                                                                {!! $conversation_message['answer'] !!}

                                                                <button class="copy-btn" data-target="message_{{ $loop->index }}" style="position: absolute; left: 30px; background-color: transparent; color: white; border: none; border-radius: 0%; padding: 0px; cursor: pointer;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" fill="none" viewBox="0 0 24 24" class="icon-md-heavy">
                                                                        <path fill="currentColor" fill-rule="evenodd" d="M7 5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-2v2a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-9a3 3 0 0 1 3-3h2zm2 2h5a3 3 0 0 1 3 3v5h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-9a1 1 0 0 0-1 1zM5 9a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h9a1 1 0 0 0 1-1v-9a1 1 0 0 0-1-1z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                </button>
                                                                <button class="twitter-btn" data-target="message_{{ $loop->index }}" style="position: absolute; left: 62px;  background-color: transparent; color: white; border: none; border-radius: 0%; padding: 0px; cursor: pointer;">
                                                                    <img src="https://uxwing.com/wp-content/themes/uxwing/download/brands-and-social-media/x-social-media-white-icon.png" width="13" height="13" alt="X Social Media White icon in SVG, PNG formats" title="X Social Media White icon">
                                                                </button>

                                                                <button href="#" class="changePerBtn"  data-toggle="modal" data-target="#add_item" style="position: absolute; left: 87px;  background-color: transparent; color: white; border: none; border-radius: 0%; padding: 0px; cursor: pointer;">

                                                                   <span class="svg-icon svg-icon-sm svg-icon-white mr-3">
                                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                                                                        {{--<i style="font-size: 16px" class="flaticon2-gear  text-white"></i>--}}
                                                                       <!--end::Svg Icon-->
                                                                       <img style="    width: 119px;
    margin-bottom: 2px;" src="{{ asset('gear.png') }}">
                                                                    </span>
                                                                </button>
                                                                {{--<button class="linkedin-btn" data-target="message_{{ $loop->index }}" style="position: absolute; left: 90px;  background-color: transparent; color: white; border: none; border-radius: 0%; padding: 2px; cursor: pointer;">--}}
                                                                    {{--<i style="font-size: 13px" class="icon-x la text-white socicon-linkedin"></i>--}}
                                                                {{--</button>--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <!--end::Messages-->
                                    </div>
                                    <!--end::Scroll-->
                                </div>
                                <!--end::Body-->
                                <!--begin::Footer-->
                                <div class="align-items-center  btn_send_wrap @if(request()->segment(3) == '') d-none @endif" style="">
                                    <!--begin::Compose-->
                                    <div class="input-group mb-3">
                                        <input type="text" style="border:none ;height: 57px;    padding: 21px; border-top-left-radius: 17px; border-bottom-left-radius: 17px; background: #2f2f2f;  color: white;"  class="custom-placeholder gpt_msg_input form-control" placeholder="Ask more on this new perspective on this article">

                                        <div class="input-group-append">
                                            <span style="border-top-right-radius: 17px;border-bottom-right-radius: 17px;cursor: pointer; background-color: #2f2f2f; border: none" class="btn_send_gpt input-group-text">
                                                <div class="circular-icon ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 32 32" class="icon-xl"><path fill="currentColor" fill-rule="evenodd" d="M15.192 8.906a1.143 1.143 0 0 1 1.616 0l5.143 5.143a1.143 1.143 0 0 1-1.616 1.616l-3.192-3.192v9.813a1.143 1.143 0 0 1-2.286 0v-9.813l-3.192 3.192a1.143 1.143 0 1 1-1.616-1.616z" clip-rule="evenodd"></path></svg>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <span class=" text-muted">aLumifi can make mistakes. Check important info.</span>
                                    <!--begin::Compose-->
                                </div>
                                <!--end::Footer-->
                            </div>
                            <!--end::Form-->
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!--end::Entry-->

    <div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change perspective  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!--begin::Form-->
                    <div class="col-12 col-md-12 mb-5">
                        <br>
                        <label class=" form-control-label">URL</label>
                        <input type="text" class="form-control  form-control-solid  url_input_edit" name="name" value="{{ isset($conversation) ?  $conversation->url  : '' }}" disabled >
                    </div>

                    <div class="col-12 col-md-12  mb-5">
                        <br>

                        <label  class="form-control-label ">Select Perspective</label>
                        <select  id="bias_select_edit" class="form-control">
                            <option selected disabled value="0">Select Your Perspective </option>
                            <option >Left</option>
                            <option >Socialist </option>
                            <option >Libertarian </option>
                            <option >Right </option>

                            <option >Christian</option>
                            <option >Islam </option>
                            <option >Buddhist </option>
                            <option >Agnostic </option>

                            <option >Scientific</option>
                            <option >Green</option>
                            <option >Skeptical</option>
                            <option >Crypto</option>
                            <option >Jewish</option>

                        </select>
                    </div>
                    <div class="card-footer">
                        <button style="background: #019cc1" id="btnFetch_edit" type="button" class=" btn btn-primary mr-2" >Change Perspective</button>
                    </div>
                    <!--end::Form-->
                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')

    <script src="https://static.linkedin.com/scds/platform/buttons/in.js" async defer></script>

    <script>

        let msgs_count = 0;

        $('body').on('click', '.twitter-btn', function() {
            const targetId = $(this).data('target');
            const messageElement = $(`#${targetId}`);
            const messageText = messageElement.text();
            const url = $('.url_input').val();
            const bias = $('#bias_select :selected').val();

            const tweetText = `aLumifi.ai has reviewed the biases from this article ${url} and looked at it from ${bias} perspective to deliver to you this overall review and critique on that article as follows: ${messageText}`;
            // const tweetText = `${messageText}`;

            var twurl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(tweetText)}`;

            window.open(twurl, '_blank');
            // Copy the tweet text to clipboard
            // navigator.clipboard.writeText(tweetText).then(() => {
            //     alert('Text copied to clipboard!');
            // });
        });

        $('body').on('click', '.linkedin-btn', function() {
            const targetId = $(this).data('target');
            const messageElement = $(`#${targetId}`);
            const messageText = messageElement.text();
            const url = $('.url_input').val();
            const bias = $('#bias_select :selected').val();

            const tweetText = `aLumifi.ai has reviewed the biases from this article ${url} and looked at it from ${bias} perspective to deliver to you this overall review and critique on that article as follows: ${messageText}`;

            // var twurl = `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(window.location.href)}&title=${encodeURIComponent(tweetText)}`;
            var twurl = `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(window.location.href)}&title=${encodeURIComponent(tweetText)}&summary=${encodeURIComponent(tweetText)}`;

            window.open(twurl, '_blank');
            // Copy the tweet text to clipboard
            // navigator.clipboard.writeText(tweetText).then(() => {
            //     alert('Text copied to clipboard!');
            // });
        });

        // Copy to clipboard
        $('body').on('click', '.copy-btn', function() {
            var targetId = $(this).data('target');
            var textToCopy = $(`#${targetId}`).text();

            navigator.clipboard.writeText(textToCopy).then(function() {
                alert('Message copied to clipboard!');
            }).catch(function(err) {
                console.error('Could not copy text: ', err);
            });
        });

        $('body').on("click", "#btnSkip", function () {
            $('.data_section').addClass('d-none')
        });

        $('body').on("click", "#btnFetch_edit", function () {
            const bias                  = $('#bias_select_edit :selected').val();
            var url                     = $('.url_input').val();

            $('#add_item').modal('hide');

            if(bias !== "0" && url !== ""){

                $('#btnFetch_edit').html('<div class="spinner spinner-lg spinner-white spinner-center p-4"></div>');

                $.ajax({
                    url: "{{ route('fetch') }}",
                    type: "POST",
                    data: {
                        url : url,
                        _token: "{!! csrf_token() !!}"
                    },
                    success: function (response) {
                        if (response.status === 200) {

                            $('#scraped_data').val(response.data);

                            _sendGPTMessage(`aLumified <a target="_blank" href="${url}">URL</a> review below as from the ${bias} perspective` , bias, 1);
                            // _sendGPTMessage(`<!--aLumified <a target="_blank" href="${url}">URL</a>-->` , bias, 1);

                            $('#btnFetch_edit').html('Fetch data');

                            $('.data_section').addClass('d-none');

                            $('.btn_send_wrap').removeClass('d-none');
                        }
                        else {
                            alert(response.data)
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

            }else {
                Swal.fire({
                    text: "Please select your bias and provide URL before starting.",
                    icon: "error",
                    showCancelButton: false,
                    buttonsStyling: false,
                    confirmButtonText: "Ok!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-dark",
                        cancelButton: "btn font-weight-bold btn-default"
                    }
                })
            }



        });

        $('body').on("click", "#btnFetch", function () {
            const bias                  = $('#bias_select :selected').val();
            var url                     = $('.url_input').val();

            if(url !== ""){

                $('#btnFetch').html('<div class="spinner spinner-lg spinner-white spinner-center p-4"></div>');

                $.ajax({
                    url: "{{ route('fetch') }}",
                    type: "POST",
                    data: {
                        url : url,
                        _token: "{!! csrf_token() !!}"
                    },
                    success: function (response) {
                        if (response.status === 200) {

                            $('#scraped_data').val(response.data);

                            // _sendGPTMessage(`aLumified <a target="_blank" href="${url}">URL</a> review below as from the ${bias} perspective` , bias, 1);
                            _sendGPTMessage(`aLumified <a target="_blank" href="${url}">URL</a>` , bias, 1);

                            $('#btnFetch').html('Fetch data');

                            $('.data_section').addClass('d-none');

                            $('.btn_send_wrap').removeClass('d-none');

                        }
                        else {
                            alert(response.data)
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

            }else {
                Swal.fire({
                    text: "Please select your bias and provide URL before starting.",
                    icon: "error",
                    showCancelButton: false,
                    buttonsStyling: false,
                    confirmButtonText: "Ok!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-dark",
                        cancelButton: "btn font-weight-bold btn-default"
                    }
                })
            }



        });

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

        $('body').on('click' , '.changePerBtn', function () {
            var url                     = $('.url_input').val();

            $('.url_input_edit').val(url)
        });

        $('body').on('click' , '.btn_send_gpt', function () {
            _sendGPTMessage()
        });

        $('body').on('click' , '.prompt_message', function () {

            var message = $(this).data('prompt');

            _sendGPTMessage(message)
        });

        var is_processing  = false;

        var _sendGPTMessage = function (message, selected_bias = '',  rewrite = 0){

            if(msgs_count < 4) {
                msgs_count++;

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

                    let bias                  = $('#bias_select :selected').val();
                    const scraped_data          = $('#scraped_data').val();
                    var url                     = $('.url_input').val();

                    if(selected_bias !== ''){
                        bias = selected_bias
                    }

                    is_processing = true;

                    $('.gpt_msg_input').val('');

                    // $('.btn_send_gpt').html('<div class="spinner spinner-sm spinner-dark spinner-center"></div>')
                    $('.btn_send_gpt').html(' <div class="circular-icon stop">\n' +
                        '                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" class="icon-lg">  <rect width="10" height="10" x="7" y="7" fill="currentColor" rx="1.25"></rect></svg>\n' +
                        '                                                </div>');


                      var userMessageHtml = `<div class="d-flex flex-column mb-5 align-items-end">
                                    <div style="background: #2f2f2f; color: white;border-radius: 4% !important;" class="mt-2 rounded p-5 font-weight-bold font-size-lg text-left max-w-600px">${text}</div>
                                </div>`;


                    // Add user's message
                    gpt_messages.innerHTML += userMessageHtml;

                    // Add loading indicator
                    var loadingIndicatorHtml = `<div id="loadingEntry"  class="gpt-entry">
                           <div class="d-flex align-items-center">
                               <div class="mr-2">
                                   <img style="width:20px" alt="Pic" src="{{ asset('ai_white.png') }}">

                               </div>
                               <div class="ml-4">

                            <div class="ticontainer">
  <div class="tiblock">
    <div class="tidot"></div>
    <div class="tidot"></div>
    <div class="tidot"></div>
  </div>
</div>

                               </div>
                           </div>
                           <div class="d-flex flex-column mb-5 align-items-start">
                               <div style="color:white;background: transparent" class="mt-2 rounded p-5 font-weight-bold font-size-lg text-left max-w-600px">
                           </div>
                       </div>`;




                    // Add loading indicator for GPT response
                    gpt_messages.innerHTML += loadingIndicatorHtml;
                    messages_container.scrollTop = messages_container.scrollHeight;

                    $.ajax({
                        url: "{!! route('send.message') !!}",
                        method: "POST",
                        data: {
                            conversation_id:conversation_id,
                            bias:bias,
                            scraped_data:scraped_data,
                            text:text,
                            url:url,
                            rewrite:rewrite,
                            _token: "{!! csrf_token() !!}"
                        },
                        success: function (data) {
                            if(data.status === 200 ){
                                // Remove loading indicator
                                var loadingIndicator = document.getElementById('loadingEntry');
                                if (loadingIndicator) {
                                    loadingIndicator.remove()
                                }

                                const uniqueId = 'gpt_response_' + new Date().getTime();

                                displayHtmlWordByWord(data.message, gpt_messages, messages_container, uniqueId);

                                $('.conversation_id').val(data.conversation_id);

                                // $('.gpt_msg_input').prop('disabled', false);
                                $('.btn_send_gpt').html(' <div class="circular-icon ">\n' +
                                    '                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 32 32" class="icon-xl"><path fill="currentColor" fill-rule="evenodd" d="M15.192 8.906a1.143 1.143 0 0 1 1.616 0l5.143 5.143a1.143 1.143 0 0 1-1.616 1.616l-3.192-3.192v9.813a1.143 1.143 0 0 1-2.286 0v-9.813l-3.192 3.192a1.143 1.143 0 1 1-1.616-1.616z" clip-rule="evenodd"></path></svg>\n' +
                                    '                                                </div>');

                                if(rewrite && bias === "0"){
                                    // $('#add_item').modal('show');
                                    $('#exampleModalLabel').html("Rework Article from a New Perspective")
                                    $('#btnFetch_edit').html("START NEW PERSPECTIVE!");
                                    $('.url_input_edit').val($('.url_input').val())
                                    $('.recheck_section').removeClass('d-none');
                                }

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
            }else {

                Swal.fire({
                    text: "Please sign in to remove the limits.",
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


                        window.location.href ="/login"
                    }
                });
            }

        };

        function displayHtmlWordByWord(html, gpt_messages, messages_container, uniqueId) {
            var messageHtml = `
        <div class="gpt-entry">
            <div class="d-flex align-items-start">
                <div class="mr-2">
                    <img style="width: 20px;" alt="Pic" src="{{ asset('ai_white.png') }}">
                </div>
                <div id="${uniqueId}" style="color:white; background: transparent; position: relative;" class="rounded pl-4 pt-1 font-weight-bold font-size-lg text-left max-w-600px">
                    <button class="copy-btn" data-target="${uniqueId}" style="position: absolute; left: 10px;bottom:-19px; background-color: transparent; color: white; border: none; border-radius: 0%; padding: 0px; cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" fill="none" viewBox="0 0 24 24" class="icon-md-heavy">
                            <path fill="currentColor" fill-rule="evenodd" d="M7 5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-2v2a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-9a3 3 0 0 1 3-3h2zm2 2h5a3 3 0 0 1 3 3v5h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-9a1 1 0 0 0-1 1zM5 9a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h9a1 1 0 0 0 1-1v-9a1 1 0 0 0-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <button class="twitter-btn" data-target="${uniqueId}" style="position: absolute; left: 42px;bottom:-19px;   background-color: transparent; color: white; border: none; border-radius: 0%; padding: 3px; cursor: pointer;">
                        <img src="https://uxwing.com/wp-content/themes/uxwing/download/brands-and-social-media/x-social-media-white-icon.png" width="13" height="13" alt="X Social Media White icon in SVG, PNG formats" title="X Social Media White icon">
                    </button>

                    <button href="#" class="changePerBtn"   data-toggle="modal" data-target="#add_item" style="position: absolute; left: 73px;bottom:-19px;  background-color: transparent; color: white; border: none; border-radius: 0%; padding: 0px; cursor: pointer;">
                        <span class="svg-icon svg-icon-sm svg-icon-white mr-3">
                            <img style="    width: 119px;
    margin-bottom: 2px;" src="{{ asset('gear.png') }}">

                        </span>
                    </button>

                </div>
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
                    setTimeout(addNextWord, 20); // Adjust the speed (in milliseconds) here
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

@endsection