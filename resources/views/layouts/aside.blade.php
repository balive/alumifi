
<div class="aside aside-left d-flex aside-fixed" id="kt_aside" style="z-index: 10000">
    <!--begin::Primary-->

    <!--end::Primary-->
    <!--begin::Secondary-->
    <div class="aside-secondary d-flex flex-row-fluid" @if(!isset(auth()->user()->type) || (isset(auth()->user()->type) && auth()->user()->type == 'client')) style="background-color: #2f2f2f;" @endif >
        <!--begin::Workspace-->
        <div class="aside-workspace scroll scroll-push my-2">
            <!--begin::Tab Content-->
            <div class="tab-content">
                <!--begin::Tab Pane-->
                <!--end::Tab Pane-->
                <a href="{{ URL::to('/') }}">
                    {{--<img style="max-height: 34px" alt="Logo" src="{{ asset('frontend/img/logo-black.png') }}" class="logo-default mt-5 ml-5" />--}}
                </a>
                <!--begin::Tab Pane-->
                <div class="tab-pane fade show active" id="kt_aside_tab_2">
                    <!--begin::Aside Menu-->
                    <div class="aside-menu-wrapper flex-column-fluid px-10 py-5" id="kt_aside_menu_wrapper">
                        <!--begin::Menu Container-->
                        <div @if(!isset(auth()->user()->type) || (isset(auth()->user()->type) && auth()->user()->type == 'client'))  style="background-color: #2f2f2f;" @endif id="kt_aside_menu" class="aside-menu min-h-lg-800px" data-menu-vertical="1" data-menu-scroll="1">
                            <!--begin::Menu Nav-->
                            <ul class="menu-nav">

                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ route('dashboard') }}" class="text-muted   font-weight-bold side-link">
                                        <div  class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 @if(request()->segment(1)=='') active @endif ">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class=" symbol-40 symbol-light mr-7">
                                                    <span class="symbol-label ">

                                                      @if(!isset(auth()->user()->type) || (isset(auth()->user()->type) && auth()->user()->type == 'client'))
                                                            {{--<img alt="Logo" src="{{ asset('ai_white.png') }}" class="logo-default max-h-20px" />--}}
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" viewBox="0 0 24 24" class="icon-xl-heavy"><path d="M15.673 3.913a3.121 3.121 0 1 1 4.414 4.414l-5.937 5.937a5 5 0 0 1-2.828 1.415l-2.18.31a1 1 0 0 1-1.132-1.13l.311-2.18A5 5 0 0 1 9.736 9.85zm3 1.414a1.12 1.12 0 0 0-1.586 0l-5.937 5.937a3 3 0 0 0-.849 1.697l-.123.86.86-.122a3 3 0 0 0 1.698-.849l5.937-5.937a1.12 1.12 0 0 0 0-1.586M11 4A1 1 0 0 1 10 5c-.998 0-1.702.008-2.253.06-.54.052-.862.141-1.109.267a3 3 0 0 0-1.311 1.311c-.134.263-.226.611-.276 1.216C5.001 8.471 5 9.264 5 10.4v3.2c0 1.137 0 1.929.051 2.546.05.605.142.953.276 1.216a3 3 0 0 0 1.311 1.311c.263.134.611.226 1.216.276.617.05 1.41.051 2.546.051h3.2c1.137 0 1.929 0 2.546-.051.605-.05.953-.142 1.216-.276a3 3 0 0 0 1.311-1.311c.126-.247.215-.569.266-1.108.053-.552.06-1.256.06-2.255a1 1 0 1 1 2 .002c0 .978-.006 1.78-.069 2.442-.064.673-.192 1.27-.475 1.827a5 5 0 0 1-2.185 2.185c-.592.302-1.232.428-1.961.487C15.6 21 14.727 21 13.643 21h-3.286c-1.084 0-1.958 0-2.666-.058-.728-.06-1.369-.185-1.96-.487a5 5 0 0 1-2.186-2.185c-.302-.592-.428-1.233-.487-1.961C3 15.6 3 14.727 3 13.643v-3.286c0-1.084 0-1.958.058-2.666.06-.729.185-1.369.487-1.961A5 5 0 0 1 5.73 3.545c.556-.284 1.154-.411 1.827-.475C8.22 3.007 9.021 3 10 3A1 1 0 0 1 11 4"></path></svg>
                                                        @else

                                                            <span class="svg-icon svg-icon-xl  @if(request()->segment(1)=='' ) svg-icon-success @endif">
                                                                <i style="font-size: 1.7rem" class=" @if(request()->segment(1)=='' ) text-primary  @endif flaticon-squares"></i>

                                                            <!--end::Svg Icon-->
                                                            </span>
                                                        @endif

                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1 mr-2">

                                                    @if(!isset(auth()->user()->type) || (isset(auth()->user()->type) && auth()->user()->type == 'client'))


                                                        <span class=" font-size-h6 mb-0">
                                                   New URL Check
                                                    </span>
                                                    @else

                                                        <span class=" font-size-h6 mb-0">
                                                            aLumifi.ai
                                                        </span>
                                                    @endif


                                                </div>
                                                <!--begin::End-->
                                            </div>
                                        </div>
                                        <!--end::Item-->
                                    </a>

                                </li>

                                @auth()
                                @foreach(auth()->user()->conversations as $conversation)
                                    <li class="menu-item" aria-haspopup="true">
                                        <a  href="{{ route('conversation.show' , $conversation['id']) }}" class="text-muted   font-weight-bold side-link">
                                            <div @if(request()->segment(3) == $conversation['id']) style="color: #019cc1" @endif  class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 @if(request()->segment(1)=='') active @endif ">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <span style="width: 72%;font-size: 12px !important;" class=" mb-0">
                                                        {{ $conversation['name'] }}
                                                        </span>

                                                    </div>
                                                    <!--begin::End-->
                                                </div>
                                            </div>
                                            <!--end::Item-->
                                        </a>

                                    </li>
                                @endforeach
                                @else
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{ route('login') }}" class="text-muted   font-weight-bold side-link">
                                            <div  class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 @if(request()->segment(1)=='') active @endif ">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class=" symbol-40 symbol-light mr-7">
                                                    <span class="symbol-label ">
                                                        <span class="svg-icon svg-icon-xl  ">
                                                                <i style="font-size: 1.7rem" class=" flaticon-user"></i>
                                                            </span>

                                                    </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">

                                                       <span class=" font-size-h6 mb-0">
                                                         Sign in
                                                        </span>

                                                    </div>
                                                    <!--begin::End-->
                                                </div>
                                            </div>
                                            <!--end::Item-->
                                        </a>

                                    </li>
                                @endauth()

                                <li class="menu-item" aria-haspopup="true">
                                    <a href="mailto:info@alumifi.ai" class="text-muted   font-weight-bold side-link">
                                        <div  class="list-item hoverable p-2 p-lg-3 mb-1 mt-2  ">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class=" symbol-40 symbol-light mr-7">
                                                    <span class="symbol-label ">

                                                        <span class="svg-icon svg-icon-xl  ">
                                                                <i style="font-size: 1.7rem" class=" flaticon-mail"></i>
                                                            <!--end::Svg Icon-->
                                                            </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1 mr-2">

                                                     <span class=" font-size-h6 mb-0">
                                                         Contact us
                                                     </span>


                                                </div>
                                                <!--begin::End-->
                                            </div>
                                        </div>
                                        <!--end::Item-->
                                    </a>

                                </li>

                                <li class="menu-item" aria-haspopup="true">
                                    <a  target="_blank" href="https://x.com/alumifi" class="text-muted   font-weight-bold side-link">
                                        <div  class="list-item hoverable p-2 p-lg-3 mb-1 mt-2  ">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class=" symbol-40 symbol-light mr-10">
                                                    <span class="symbol-label ">

                                                        <span class="svg-icon svg-icon-xl  ">
                                                            <img src="https://uxwing.com/wp-content/themes/uxwing/download/brands-and-social-media/x-social-media-white-icon.png" width="13" height="13" alt="X Social Media White icon in SVG, PNG formats" title="X Social Media White icon">

                                                            <!--end::Svg Icon-->
                                                            </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1 mr-2">

                                                     <span class=" font-size-h6 mb-0">
                                                         alumifi
                                                     </span>


                                                </div>
                                                <!--begin::End-->
                                            </div>
                                        </div>
                                        <!--end::Item-->
                                    </a>

                                </li>






                            @if(isset(auth()->user()->type) && auth()->user()->type == 'admin')



                                    <li class="menu-item" aria-haspopup="true">
                                    <a @if(request()->segment(2)=='users') style="background: #fff; border-radius: 10px" @endif href="{{ route('users') }}" class="text-muted  font-weight-bold side-link">
                                        <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 @if(request()->segment(1)=='users') active @endif ">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class=" symbol-40 symbol-light mr-7">
                                                    <span class="symbol-label  ">
                                                        <span class="svg-icon svg-icon-xl  ">
                                                          <i style="font-size: 1.7rem"  class=" @if(request()->segment(2)=='users' ) text-primary  @endif icon-xl fas fa-user"></i>                                             <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <span class="@if(request()->segment(2)=='users') text-primary @endif font-size-h6 mb-0">
                                                        Users

                                                        </span>

                                                </div>
                                                <!--begin::End-->
                                            </div>
                                        </div>
                                        <!--end::Item-->
                                    </a>
                                </li>

                                    {{--<li class="menu-item" aria-haspopup="true">--}}
                                        {{--<a @if(request()->segment(2)=='users') style="background: #fff; border-radius: 10px" @endif href="{{ route('plans') }}" class="text-muted  font-weight-bold side-link">--}}
                                            {{--<div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 @if(request()->segment(1)=='plans') active @endif ">--}}
                                                {{--<div class="d-flex align-items-center">--}}
                                                    {{--<!--begin::Symbol-->--}}
                                                    {{--<div class=" symbol-40 symbol-light mr-7">--}}
                                                        {{--<span class="symbol-label  ">--}}
                                                            {{--<span class="svg-icon svg-icon-xl  ">--}}
                                                              {{--<i style="font-size: 1.7rem"  class=" @if(request()->segment(2)=='plans' ) text-primary  @endif icon-xl flaticon-list	"></i>                                             <!--end::Svg Icon-->--}}
                                                            {{--</span>--}}
                                                        {{--</span>--}}
                                                    {{--</div>--}}
                                                    {{--<!--end::Symbol-->--}}
                                                    {{--<!--begin::Text-->--}}
                                                    {{--<div class="d-flex flex-column flex-grow-1 mr-2">--}}
                                                        {{--<span class="@if(request()->segment(2)=='plans') text-primary @endif font-size-h6 mb-0">--}}
                                                            {{--Plans--}}
                                                        {{--</span>--}}

                                                    {{--</div>--}}
                                                    {{--<!--begin::End-->--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<!--end::Item-->--}}
                                        {{--</a>--}}
                                    {{--</li>--}}

                                    {{--<li class="menu-item" aria-haspopup="true">--}}
                                        {{--<a @if(request()->segment(2)=='users') style="background: #fff; border-radius: 10px" @endif href="{{ route('prompts') }}" class="text-muted  font-weight-bold side-link">--}}
                                            {{--<div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 @if(request()->segment(1)=='prompts') active @endif ">--}}
                                                {{--<div class="d-flex align-items-center">--}}
                                                    {{--<!--begin::Symbol-->--}}
                                                    {{--<div class=" symbol-40 symbol-light mr-7">--}}
                                                        {{--<span class="symbol-label  ">--}}
                                                            {{--<span class="svg-icon svg-icon-xl  ">--}}
                                                              {{--<i style="font-size: 1.7rem"  class=" @if(request()->segment(2)=='prompts' ) text-primary  @endif icon-xl flaticon-folder-1"></i>                                             <!--end::Svg Icon-->--}}
                                                            {{--</span>--}}
                                                        {{--</span>--}}
                                                    {{--</div>--}}
                                                    {{--<!--end::Symbol-->--}}
                                                    {{--<!--begin::Text-->--}}
                                                    {{--<div class="d-flex flex-column flex-grow-1 mr-2">--}}
                                                        {{--<span class="@if(request()->segment(2)=='prompts') text-primary @endif font-size-h6 mb-0">--}}
                                                            {{--Prompts--}}
                                                        {{--</span>--}}

                                                    {{--</div>--}}
                                                    {{--<!--begin::End-->--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<!--end::Item-->--}}
                                        {{--</a>--}}
                                    {{--</li>--}}

                                    <li class="menu-item" aria-haspopup="true">
                                        <a @if(request()->segment(2)=='settings') style="background: #fff; border-radius: 10px" @endif href="{{ route('settings') }}" class="text-muted  font-weight-bold side-link">
                                            <div class="list-item hoverable p-2 p-lg-3 mb-1 mt-2 @if(request()->segment(2)=='settings') active @endif ">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class=" symbol-40 symbol-light mr-7">
                                                    <span class="symbol-label  ">
                                                        <span class="svg-icon svg-icon-xl  ">
                                                          <i style="font-size: 1.7rem"  class=" @if(request()->segment(2)=='settings' ) text-primary  @endif icon-xl fas fa-server"></i>                                             <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                                        <span class="@if(request()->segment(2)=='settings') text-primary @endif font-size-h6 mb-0">
                                                        Settings

                                                        </span>

                                                    </div>
                                                    <!--begin::End-->
                                                </div>
                                            </div>
                                            <!--end::Item-->
                                        </a>
                                    </li>

                                @else



                                @endif



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

        {{--<div class="aside-footer d-flex flex-column align-items-center flex-column-auto py-4 py-lg-10">--}}
            {{--<!--begin::Aside Toggle-->--}}
            {{--<span class="aside-toggle btn btn-icon btn-primary btn-hover-primary shadow-sm" id="kt_aside_toggle" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Toggle Aside">--}}
                {{--<i class="ki ki-bold-arrow-back icon-sm"></i>--}}
            {{--</span>--}}
        {{--</div>--}}

    </div>
    <!--end::Secondary-->
</div>

