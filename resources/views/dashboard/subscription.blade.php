@extends('layouts.master')

@section('styles')


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
                    <h2 class="d-flex align-items-center @if(auth()->user()->type == 'client') text-white @else text-dark @endif font-weight-bold my-1 mr-3">User Details</h2>
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
            <!--begin::Profile Account Information-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8 mr-10">
                    <!--begin::Card-->
                    <div class="card-custom">
                        <!--begin::Form-->
                        <!--begin::Body-->
                        @if(auth()->user()->subscribed())
                            <div class="card mb-3 mb-lg-5">
                            <!-- Header -->
                            <div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
                                <h5 class="card-header-title">Overview</h5>
                                @if(isset($currentSubscription->ends_at) && $currentSubscription->ends_at < Carbon\Carbon::now()  )
                                    <span class="badge btn btn-danger  ">Inactive</span>
                                @else
                                    <span class="badge btn btn-success  ">Active</span>
                                @endif
                            </div>
                            <!-- End Header -->
                            <!-- Body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md mb-4 mb-md-0">
                                        <div class="mb-4">
                                            <span class="card-subtitle">Your plan (Billed):</span>
                                            <h5>{{ $plan_info['name'] }}</h5>
                                        </div>
                                        <div>
                                            <span class="card-subtitle">Plan Price</span>
                                            <h3 class="text-primary">
                                                @if($currentSubscription->plan_type == "monthly")
                                                    ${{ $plan_info['price_monthly'] }} {{  $currentSubscription->plan_type }}
                                                @elseif($currentSubscription->plan_type == "yearly")
                                                    ${{ $plan_info['price_yearly'] }} {{  $currentSubscription->plan_type }}
                                                @else
                                                    ${{ $plan_info['price_monthly'] }} {{  $currentSubscription->plan_type }}
                                                @endif
                                            </h3>
                                        </div>

                                        @if($currentSubscription)
                                                <div>
                                                    <span class="card-subtitle">Started At</span>
                                                    <h3 class="text-primary">
                                                        {{ $started_at }}
                                                    </h3>
                                                </div>

                                            @if(!$onGracePeriod && $currentSubscription->type !== "free")
                                                <div>
                                                    <span class="card-subtitle">Next Billing Cycle</span>
                                                    <h3 class="text-primary">
                                                        {{ $nextBillingDate }}
                                                    </h3>
                                                </div>
                                                <div>
                                                    <span class="card-subtitle">Billed At</span>
                                                    <h3 class="text-primary">
                                                        {{ $subscriptionStartDate }}
                                                    </h3>
                                                </div>
                                            @endif
                                        @else
                                            @if(isset($nextBillingDate))
                                                <div>
                                                    <span class="card-subtitle">Subscription Ends</span>
                                                    <h3 class="text-primary">
                                                        {{ $nextBillingDate }}
                                                    </h3>
                                                </div>
                                            @endif
                                        @endif

                                        @if($paymentMethod)
                                            <div>
                                                <span class="card-subtitle">Payment Method</span>
                                                <span class="">
                                                    <p><strong>{{ $paymentMethod->card->brand }} **** **** **** {{ $paymentMethod->card->last4 }} - {{ $paymentMethod->card->exp_month }}/{{ $paymentMethod->card->exp_year }} </strong> </p>

                                                    <!-- Add form for changing payment method -->
                                                    <a href="#" data-toggle="modal" data-target="#update_item"  class="btn-success btn-sm">
                                                        Update Payment Method
                                                    </a>
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- End Col -->
                                    <div class="col-md-auto">
                                        <div class="d-grid d-md-flex gap-3">
                                            @if($currentSubscription->type !== "free")
                                                @if(!$onGracePeriod)
                                                    <a id="btn-cancel-subscription" class="btn-danger btn-sm mr-2" href="#">Cancel subscription</a>
                                                @else
                                                    <a href="{{ route('subscription.resume' , auth()->user()->id) }}" class="btn-warning text-white btn-sm mr-2" >Resume subscription</a>
                                                @endif
                                            @endif
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
                                        <span class="text-dark fw-semibold">{{ auth()->user()->remaining_credits }} prompts</span>
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Row -->
                                <!-- Progress -->
                                {{--<div class="progress rounded-pill mb-3">--}}
                                    {{--<div class="progress-bar" role="progressbar" style="width: {{ $percenatege }}%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>--}}
                                {{--</div>--}}
                                <!-- End Progress -->
                                <!-- Legend Indicators -->
                                {{--<div class="list-inline">--}}
                                    {{--<div class="list-inline-item">--}}
                                        {{--<span class="legend-indicator bg-primary"></span>score--}}
                                    {{--</div>--}}
                                    {{--<div class="list-inline-item">--}}
                                        {{--<span class="legend-indicator"></span>Available points--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                            </div>
                            <!-- End Body -->
                        </div>
                        @endif

                        <!--end::Form-->
                    </div>
                    <br>
                    <br>

                    <div id="plans-section" class="card" @if(auth()->user()->subscribed()) style="display: none;" @endif>
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
                                            @foreach($plans as $plan)
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
                                                        <h4 class="font-size-h3 mb-10">{{ $plan['name'] }}<br>
                                                            <span style="font-size: 15px" class="text-muted">Unlock advanced features and priority support.</span>
                                                        </h4>
                                                        <div class="d-flex flex-column line-height-xl pb-10">
                                                            <span>Monthly score </span>
                                                            <span>Access to all tools</span>
                                                            <span>Product support</span>
                                                            <span>Free Assets</span>
                                                        </div>
                                                        <span class="font-size-h1 d-block font-weight-boldest text-dark">

                                                            @if($plan['type'] == 'monthly')
                                                                {{ $plan['price_monthly'] }}
                                                            @elseif($plan['type'] == 'yearly')
                                                                {{ $plan['price_yearly'] }}
                                                            @else
                                                                {{ $plan['price_monthly'] }}
                                                            @endif
                                                            <sup class="font-size-h3 font-weight-normal pl-1">$</sup></span>
                                                            <div class="mt-7">
                                                                @if(isset($currentSubscription) && $currentSubscription->plan_id ==  $plan['id'] && !auth()->user()->exceeded_subscription())
                                                                    <a type="button"  href="#" class=" btn btn-success text-uppercase font-weight-bolder px-15 py-3">Subscribed</a>
                                                                @elseif(isset($currentSubscription) && $currentSubscription->plan_id == $plan['id'] && auth()->user()->exceeded_subscription())
                                                                    <a href="{{ route('subscribe' , [$plan['id'], 'trial']) }}"  class="btn btn-dark text-uppercase font-weight-bolder px-15 py-3">Renew</a>
                                                                @else
                                                                    <a style="background: #000" type="button"  href="{{ route('subscribe' , [$plan['id'] , "trial"]) }}" class=" btn  text-uppercase font-weight-bolder px-15 py-3">Subscribe</a>
                                                                @endif



                                                            </div>
                                                        <!--end::Content-->
                                                    </div>
                                                </div>
                                            @endforeach
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

@endsection

@section('scripts')
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
                        url: "{{ route('subscription.cancel' , auth()->user()->id) }}",
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

@endsection