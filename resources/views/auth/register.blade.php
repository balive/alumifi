<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head>
    <meta charset="utf-8" />
    <title>  aLumifi AI Bias Checking app | Register </title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by This page)-->
    <link href="{{ asset('backend/css/pages/login/login-3.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('backend/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ asset('backend/media/logos/favicon.ico') }}" />

    <style>

        body {
            position: inherit;
            display: grid;
            background: #231f20;

        }
        .login.login-3 .login-content{
            background: #231f20 !important;

        }

        .officer-label{

            display: block;
            transition: 0.3s all ease;
            float: left;
            margin-right: 10px;
            margin-top: 5px;


        }

        .realtorTransactions {

            display:none
        }
        .card-input-officers-element  {
            display: none;
        }
        .card-input-officers-element:checked + .card-input{

            box-shadow: 0 0 1px 1px rgba(125, 243, 237, 0.19);
            background: #1BC5BD;
            border-radius: 4px;
            color: #fff
        }
        .card-input-officers-element + .card-input{


            color:#1BC5BD;
            background: #fff;
            border-radius: 4px;
            border:2px solid #1BC5BD;


        }

        /*.card-input-officers-element + .card-input:hover{*/

        /*box-shadow: 0 0 1px 1px rgba(125, 243, 237, 0.13);*/
        /*background: rgba(9, 204, 151, 0.05);*/
        /*border-radius: 4px;*/
        /*}*/
        .officer-label div {
            cursor: pointer;
            /*padding:5px 1px 2px 0px !important*/
        }
        .officer-content {
            margin-left: 10px;
            padding: 0;
            margin-right: 5px;

            /* padding-left: 12px; */
        }

        @media (max-width: 992px){

            .firstcont{
                margin-top: 55px;

            }
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-mobile-fixed subheader-enabled aside-enabled aside-fixed aside-secondary-enabled page-loading">
<!--begin::Main-->

<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid wizard" id="kt_login">
        <!--begin::Aside-->
        <div class="login-aside d-flex flex-column flex-row-auto">
            <!--begin::Aside Top-->
            <div class="d-flex flex-column-auto flex-column pt-15 px-30">
                <!--begin::Aside header-->
                <a href="{{ url('/') }}" class="login-logo text-center pt-lg-25 pb-10">
                    <img src="{{ asset('uploads/') }}" class="max-h-70px" alt="" />
                </a>
                <!--end::Aside header-->
                <!--begin: Wizard Nav-->
                <div class="wizard-nav pt-5 pt-lg-30">
                    <!--begin::Wizard Steps-->
                    <div class="wizard-steps">
                        <!--begin::Wizard Step 1 Nav-->
                        <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                            <div class="wizard-wrapper">
                                <div class="wizard-icon">
                                    <i class="wizard-check ki ki-check"></i>
                                    <span class="wizard-number">1</span>
                                </div>
                                <div class="wizard-label">
                                    <h3 class="wizard-title"> Account Settings </h3>
                                    <div class="wizard-desc"> Setup Your aLumifi Account Details </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Wizard Steps-->
                </div>
                <!--end: Wizard Nav-->
            </div>
            <!--end::Aside Top-->
            <!--begin::Aside Bottom-->
            {{--<div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center" style="background-position-y: calc(100% + 5rem); background-image: url(http://app.homeli.ca/public/uploads/home-3.png)"></div>--}}
            <!--end::Aside Bottom-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="login-content flex-column-fluid d-flex flex-column p-10">
            <!--begin::Top-->

            <!--end::Top-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-row-fluid flex-center">
                <!--begin::Signin-->


                <div class="login-form login-form-signup">
                    <!--begin::Form-->

                    <form id="kt_login_signup_form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data" >
                    @csrf
                    <!--begin: Wizard Step 1-->
                        <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                            <!--begin::Title-->

                            <a href="{{ URL::to('/') }}">
                                <img style="width: 150px" class="mb-10" src="{{ asset('alumifi-logo2.png') }}">
                            </a>
                            <div class="pb-10 pb-lg-15">
                                <h3 class="font-weight-bolder text-dark display5"> Create Account </h3>
                                <div class="text-white font-weight-bold font-size-h4"> Already have an aLumifi account?
                                    <a style="color: #019cc1"  href=" {{ route('login') }}" class=" font-weight-bolder"> Sign In </a></div>
                            </div>
                            <!--begin::Title-->
                            <!--begin::Form Group-->




                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $error }}</strong><br>
                                    </span>
                                @endforeach

                            @endif

                            <br>
                            <br>
                            <div class="form-group firstcont">
                                <label class="font-size-h6 font-weight-bolder text-white">  Name  <span style="color: red">*</span></label>
                                <input  style="padding: 12px" type="text" id="first_name"  name="name" class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6 @error('name') is-invalid @enderror "  required autocomplete="name" autofocus>
                                <input hidden style="padding: 12px" type="text"  name="type" class="form-control " value="admin" >

                                @error('name')
                                <span class="invalid-feedback" role="alert">   <strong>{{ $message }}</strong>  </span>
                                @enderror

                            </div>
                            <!--end::Form Group-->
                            <!--begin::Form Group-->

                            <!--end::Form Group-->
                            <!--begin::Form Group-->
                            <div class="form-group">
                                <label class="font-size-h6 font-weight-bolder text-white"> Email Address <span style="color: red">*</span></label>
                                <input id="email" type="email" style="padding: 12px"    class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6 @error('email') is-invalid @enderror user_email" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-size-h6 font-weight-bolder text-white">Password <span style="color: red">*</span></label>

                                <input id="password" type="password"  style="padding: 12px"   class="form-control h-auto py-7 px-6 rounded-lg border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                <div class="fv-plugins-message-container ">
                                    <div data-field="password" data-validator="notEmpty" class="fv-help-block passfeedback"></div>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror


                            </div>

                            <div class="form-group">
                                <label class="font-size-h6 font-weight-bolder text-white">Confirm Password <span style="color: red">*</span></label>

                                <input id="password-confirm" type="password" class="form-control h-auto py-7 px-6 rounded-lg border-0" name="password_confirmation" required="">


                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>


                            <!--end::Form Group-->
                        </div>
                        <!--end: Wizard Step 1-->
                        <!--begin: Wizard Step 2-->
                        <!--end: Wizard Step 2-->

                        <!--begin: Wizard Actions-->
                        <div class="row">
                            <div class="alert alert-danger m-t-20" role="alert" id="error_alert" style="display:none"></div>
                        </div>
                        <div class="d-flex justify-content-between pt-3">

                            <div class="mr-2">
                                {{--<button type="button" class="btn btn-light-primary font-weight-bolder font-size-h6 pl-6 pr-8 py-4 my-3 mr-3" data-wizard-type="action-prev">--}}
                                    {{--<span class="svg-icon svg-icon-md mr-1">--}}
                                            {{--<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
                                            {{--<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
                                                {{--<polygon points="0 0 24 0 24 24 0 24" />--}}
                                                {{--<rect fill="#000000" opacity="0.3" transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000)" x="14" y="7" width="2" height="10" rx="1" />--}}
                                                {{--<path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997)" />--}}
                                            {{--</g>--}}
                                        {{--</svg>--}}
                                        {{--<!--end::Svg Icon-->--}}
                                    {{--</span> Previous--}}
                                {{--</button>--}}
                            </div>
                            <div>
                                <button style="background-color:#019cc1"  class="btn  font-weight-bolder font-size-h6 pl-5 pr-8 py-4 my-3" data-wizard-type="action-submit" type="submit" id="kt_login_signup_form_submit_button"> Sign Up
                                    <span class="svg-icon svg-icon-md ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <rect fill="#000000" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />
                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </button>
                                <button type="button" class="btn btn-primary font-weight-bolder font-size-h6 pl-8 pr-4 py-4 my-3" data-wizard-type="action-next"> Next Step
                                    <span class="svg-icon svg-icon-md ml-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <rect fill="#000000" opacity="0.3" transform="translate(8.500000, 12.000000) rotate(-90.000000) translate(-8.500000, -12.000000)" x="7.5" y="7.5" width="2" height="9" rx="1" />
                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                            </g>
                                         </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </button>
                            </div>
                        </div>
                        <!--end: Wizard Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Signin-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>

<!--end::Main-->
<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#1BC5BD", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#6993FF", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#1BC5BD", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#E1E9FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('backend/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('backend/js/pages/custom/profile/profile.js') }}"></script>

<script src="{{ asset('backend/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('backend/js/scripts.bundle.js') }}"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by This page)-->
<!--script src="{{ asset('backend/js/pages/custom/login/login-3.js') }}"></script-->
<script>
    "use strict";

    // Class Definition
    var KTLogin = function() {
        var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';

        var _handleFormSignup = function() {
            // Base elements
            var wizardEl = KTUtil.getById('kt_login');
            var form = KTUtil.getById('kt_login_signup_form');


            var formSubmitUrl = KTUtil.attr(form, 'action');

            var formSubmitButton = KTUtil.getById('kt_login_signup_form_submit_button');
            var wizardObj;
            var validations = [];

            if (!form) {
                return;
            }

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            // Step 1
            validations.push(FormValidation.formValidation(
                form,
                {
                    fields: {
                        name: {
                            validators: {
                                notEmpty: {
                                    message: 'This field is required.'
                                }
                            }
                        },
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'This filed is required.'
                                },
                                emailAddress: {
                                    message: 'Please enter a valid email address.'
                                }
                            }
                        },

                        password: {
                            validators: {
                                notEmpty: {
                                    message: 'This field is required.'
                                }
                            }
                        },
                        password_confirmation: {
                            validators: {
                                identical: {
                                    compare: function() {
                                        return form.querySelector('[name="password"]').value;
                                    },
                                    message: 'Passwords do not match '
                                }
                            }
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        // Bootstrap Framework Integration
                        bootstrap: new FormValidation.plugins.Bootstrap({
                            //eleInvalidClass: '',
                            eleValidClass: '',
                        })
                    }
                }
            ));

            // Step 2
            validations.push(FormValidation.formValidation(
                form,
                {
                    fields: {


                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        // Bootstrap Framework Integration
                        bootstrap: new FormValidation.plugins.Bootstrap({
                            //eleInvalidClass: '',
                            eleValidClass: '',
                        })
                    }
                }
            ));



            // Initialize form wizard
            wizardObj = new KTWizard(wizardEl, {
                startStep: 1, // initial active step number
                clickableSteps: false  // allow step clicking
            });

            // Validation before going to next page
            wizardObj.on('change', function (wizard) {
                if (wizard.getStep() > wizard.getNewStep()) {
                    return; // Skip if stepped back
                }




                // Validate form before change wizard step
                var validator = validations[wizard.getStep() - 1]; // get validator for currnt step

                if (validator) {
                    validator.validate().then(function (status) {
                        if (status == 'Valid') {
                            wizard.goTo(wizard.getNewStep());

                            KTUtil.scrollTop();
                        } else {
                            Swal.fire({
                                text: "Error",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Confirm",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light"
                                }
                            }).then(function () {
                                KTUtil.scrollTop();
                            });
                        }
                    });
                }

                return false;  // Do not change wizard step, further action will be handled by he validator
            });

            // Change event
            wizardObj.on('changed', function (wizard) {
                KTUtil.scrollTop();
            });

            // Submit event
            wizardObj.on('submit', function (wizard) {

                $("#error_alert").hide(0);
                var validator = validations[wizard.getStep() - 1]; // get validator for currnt step

                if (validator) {
                    validator.validate().then(function (status) {
                        if (status == 'Valid') {
                            //submit form

                            $("#kt_login_signup_form").submit();


                        }
                        else{
                            Swal.fire({
                                text: "Error",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Confirm",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light"
                                }
                            }).then(function () {
                                KTUtil.scrollTop();
                            });
                        }
                    });
                }
            });
        }

        // Public Functions
        return {
            init: function() {
//                _handleFormSignin();
//                _handleFormForgot();
                _handleFormSignup();
            }
        };


    }();

    // Class Initialization
    jQuery(document).ready(function() {
        KTLogin.init();


        $('#password').on('keyup' , function(){

            if($(This).val().length < 8){

                $('.passfeedback').html('Your password must be at least 8 characters.');

            }else{

                $('.passfeedback').html('');

            }

        })




    });
</script>
<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>