<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head>
    <meta charset="utf-8" />
    <title>aLumifi AI Bias Checking app |  Login</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
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
            background: #231f20 !important;
        }

        .login.login-3 .login-content{
            background: #231f20 !important;

        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-mobile-fixed subheader-enabled aside-enabled aside-fixed aside-secondary-enabled page-loading">
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="login-content flex-row-fluid d-flex flex-column p-10">
            <!--begin::Top-->
            <!--div class="text-right d-flex justify-content-center">
                <div class="top-signin text-right d-flex justify-content-end pt-5 pb-lg-0 pb-10">
                    <span class="font-weight-bold text-muted font-size-h4">Having issues?</span>
                    <a href="javascript:;" class="font-weight-bold text-primary font-size-h4 ml-2" id="kt_login_signup">Get Help</a>
                </div>
            </div-->
            <!--end::Top-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-row-fluid flex-center">
                <!--begin::Signin-->
                <div class="login-form">
                    <!--begin::Form-->
                    <img style="width: 150px" class="mb-10" src="{{ asset('alumifi-logo2.png') }}">

                    <!--begin::Title-->
                    <div class="pb-10 pb-lg-15">
                        <h3 class="font-weight-bolder text-white display5"> Sign In </h3>
                        <div class="text-muted font-weight-bold font-size-h4"> Don't have an aLumifi account yet?
                            <a style="color: #019cc1" href=" {{ route('register') }}" class=" font-weight-bolder"> Sign Up </a></div>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!--begin::Title-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark">E-mail Address</label>
                            <input id="email"  style="padding: 12px" type="email"  class="form-control h-auto py-7 px-6 rounded-lg border-0 @error('email') is-invalid @enderror"  name="email"  value="{{ old('email') }}"  required autocomplete="email" autofocus >
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                            @enderror

                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->

                        <div class="form-group">
                            <div class="d-flex justify-content-between mt-n5">
                                <label class="font-size-h6 font-weight-bolder text-dark pt-5"> Password </label>
                                <a style="color: #019cc1" href="{{ route('password.request') }}" class=" font-size-h6 font-weight-bolder text-hover-primary pt-5">Forgot your password ?</a>
                            </div>
                            <input id="password" type="password" style="padding: 12px"  class="form-control h-auto py-7 px-6 rounded-lg border-0 @error('password') is-invalid @enderror"  name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                            @enderror

                        </div>

                        <div class="row">
                            <div class="alert alert-danger m-t-20" role="alert" id="error_alert" style="display:none"></div>
                        </div>
                        <!--end::Form group-->
                        <!--begin::Action-->
                        <div class="pb-lg-0 pb-5">

                            <button style="background: #019cc1" type="submit" id="kt_login_singin_form_submit_button" class="btn  font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">
                                Sign In
                            </button>
                        </div>

                    </form>
                    <!--end::Action-->

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



<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#1BC5BD", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#6993FF", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#1BC5BD", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#E1E9FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('backend/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('backend/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('backend/js/scripts.bundle.js') }}"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<!--script src="{{ asset('backend/js/pages/custom/login/login-3.js') }}"></script-->
<script>
    "use strict";

    // Class Definition
    var KTLogin = function() {
        var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';

        var _handleFormSignin = function() {
            var form = KTUtil.getById('kt_login_singin_form');
            var formSubmitUrl = KTUtil.attr(form, 'action');
            var formSubmitButton = KTUtil.getById('kt_login_singin_form_submit_button');

            if (!form) {
                return;
            }

            FormValidation
                .formValidation(
                    form,
                    {
                        fields: {
                            email: {
                                validators: {
                                    notEmpty: {
                                        message: '<?php echo "Required Filed" ?>'
                                    }
                                }
                            },
                            password: {
                                validators: {
                                    notEmpty: {
                                        message: '<?php echo "Required Field" ?>'
                                    }
                                }
                            }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            submitButton: new FormValidation.plugins.SubmitButton(),
                            //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                            bootstrap: new FormValidation.plugins.Bootstrap({
                                //	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
                                //	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
                            })
                        }
                    }
                )
                .on('core.form.valid', function() {
                    // Show loading state on button
                    KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");

                    // Simulate Ajax request
                    setTimeout(function() {
                        KTUtil.btnRelease(formSubmitButton);
                    }, 2000);

                    // Form Validation & Ajax Submission: https://formvalidation.io/guide/examples/using-ajax-to-submit-the-form

                    FormValidation.utils.fetch(formSubmitUrl, {
                        method: 'POST',
                        dataType: 'json',
                        params: {
                            email: form.querySelector('[name="email"]').value,
                            password: form.querySelector('[name="password"]').value,
                        },
                    }).then(function(response) { // Return valid JSON
                        console.log(response);
                        $("#error_alert").hide(0);
                        // Release button
                        KTUtil.btnRelease(formSubmitButton);
                        console.log(response);
                        if (response && typeof response === 'object' &&  response.error == false) {
                            Swal.fire({
                                text: "<?php echo "Logged in !" ?> ",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "<?php echo "Dashboard" ?> ",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            }).then(function() {
                                KTUtil.scrollTop();
                                document.location.href="{{ route('login') }}";
                            });
                            window.setTimeout(function () {
                                location.href = "{{ route('login') }}";
                            }, 2000);
                        } else {
                            Swal.fire({
                                text: "Error !",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: " Okay ",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            }).then(function() {
                                KTUtil.scrollTop();
                                $("#error_alert").html(obj.validation);
                                $("#error_alert").show('slow');
                            });
                        }
                    });

                })
                .on('core.form.invalid', function() {
                    Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        KTUtil.scrollTop();
                    });
                });
        }



        // Public Functions
        return {
            init: function() {
                _handleFormSignin();
                //_handleFormForgot();
                //_handleFormSignup();
            }
        };
    }();

    // Class Initialization
    jQuery(document).ready(function() {

        KTLogin.init();
    });
</script>
<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>