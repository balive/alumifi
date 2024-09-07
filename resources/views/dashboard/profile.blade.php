@extends('layouts.master')

@section('styles')


    <style>
        #paypal-button-container, #rzpbutton{

            display: none;
        }
    </style>

@endsection
@section('content')

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
                    <h2 style="color: #3a384e" class="d-flex align-items-center font-weight-bolder my-1 mr-3 @if(auth()->user()->type == 'client') text-white @else text-dark @endif    ">Profile</h2>
                    <!--end::Page Title-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center flex-wrap">
                <!--begin::Button-->
            @include('layouts.profile_button')

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
            <!--begin::Profile Account Information-->
            <div class="d-flex flex-row" style="margin-top: 10px;">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
                    <!--begin::Profile Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Body-->
                        <div class="card-body pt-4">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end">
                                <div class="dropdown dropdown-inline">


                                </div>
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::User-->
                            <div class="d-flex align-items-center" style="margin-top: 15px;">
                                <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                    {{--<div class="symbol-label" style="background-image:url({{ $user->photo }})"></div>--}}
                                    <!--i class="symbol-badge bg-success"></i-->
                                </div>
                                <div>
                                    <a  class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{ $user->name  }} </a>

                                    {{--<div class="mt-2">--}}
                                    {{--<a href="{{ route('messages') }}" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">My Messages</a>--}}

                                    {{--</div>--}}
                                </div>
                            </div>
                            <!--end::User-->
                            <!--begin::Contact-->
                            <div class="py-9">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Email:</span>
                                    <a href="#" class="text-muted text-hover-primary">{{ $user->email }}</a>
                                </div>


                            </div>
                            <!--end::Contact-->
                            <!--begin::Nav-->
                            <div class="navi navi-bold navi-hover navi-active navi-link-rounded nav-tabs" style="border-bottom: none">
                                <div class="navi-item  mb-2">
                                    <a class="navi-link py-4  " href="#userInformation" data-toggle="tab">
                                        <span class="navi-icon mr-2">
                                            <i style="font-size: 1.7rem"  class="icon-xl fas fa-user"></i>

                                        </span>
                                        <span  style="color: #2f2f2f" class="navi-text font-size-lg "> Account Information</span>
                                    </a>
                                </div>



                            </div>

                            <!--end::Nav-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Profile Card-->
                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8">
                    <!--begin::Card-->
                    <div class="tab-content">

                        <div class="tab-pane active" id="userInformation">
                            <div class="card card-custom">
                                <!--begin::Form-->
                                <form  method="post" action="{{ route('update.user.info') }}" enctype="multipart/form-data" accept-charset="utf-8">
                                    @csrf
                                    <div class="card card-custom">
                                        <!--begin::Header-->
                                        <div class="card-header py-3">
                                            <div class="card-title align-items-start flex-column">
                                                <h3 class="card-label font-weight-bolder text-dark">Account Information</h3>
                                                <span class="text-muted font-weight-bold font-size-sm mt-1">Change Your Personal Information</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!--begin::Body-->

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="alert alert-danger m-t-20" role="alert" id="error_alert" style="display:none"></div>
                                        </div>

                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h5 class="font-weight-bold mb-6">Account Information</h5>
                                            </div>
                                        </div>
                                        <div hidden class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url({{ $user->photo}})">
                                                    <div class="image-input-wrapper" style="background-image: none">
                                                    </div>
                                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                        <input type="file" name="profile_pic" id="profile_avatar" accept=".png, .jpg, .jpeg">
                                                        <input hidden type="text" name="userid" value="{{ $user->id }}">
                                                        <input type="hidden" name="profile_avatar_remove" id="profile_avatar_remove" value="0">
                                                    </label>
                                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" onclick="$('#profile_avatar_remove').val('1');" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                                </div>
                                                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"> Name</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type="text" name="name" value="{{ $user->name }}" id="name" required class="form-control form-control-lg form-control-solid">

                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h5 class="font-weight-bold mt-10 mb-6">Contact information</h5>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group input-group-lg input-group-solid">
                                                    <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-at"></i>
                                                </span>
                                                    </div>
                                                    <input type="text" name="email" value="{{ $user->email }}" id="email" required class="form-control form-control-lg @error('email') is-invalid @enderror form-control-solid">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Password</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group input-group-lg input-group-solid">
                                                    <input type="text" name="password" value=""   class="form-control form-control-lg @error('password') is-invalid @enderror form-control-solid">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Confirm Password</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group input-group-lg input-group-solid">

                                                    <input type="text" name="password_confirmation" class="form-control form-control-lg @error('password') is-invalid @enderror form-control-solid">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <!--end::Body-->
                                    <div class="card-header py-3">
                                        <div class="card-toolbar">
                                            <button type="submit" class="btn btn-success mr-2 save_profile_btn">Save</button>
                                            <button type="reset" class="btn btn-dark mr-2 save_profile_btn">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                                <!--end::Form-->
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

@endsection

@section('scripts')
    <script src="{{ asset('backend/js/pages/custom/profile/profile.js') }}"></script>

    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>

    <script>
        $('.navi-link').click(function(){

            $('.navi-link').removeClass('active')

            $(this).addClass('active')
        })
    </script>

@endsection