<div class="btn-group ml-2">
        <a type="button" class=" btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2 btn @if(auth()->user()->type == 'client') btn-dark @else btn-primary @endif font-weight-bold dropdown-toggle dropdown-toggle-split " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-lg">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                </g>
                            </svg>
                                <!--end::Svg Icon-->
                        </span>

            <span class="d-none d-md-inline mr-2"> {{ auth()->user()->name }}  </span>
        </a>
        <div class="dropdown-menu dropdown-menu-sm p-0 m-0 dropdown-menu-right" style="">
            <ul class="navi py-5">
                <li class="navi-item">
                    <a href="{{ route('profile') }}" class="navi-link">

                    <span class="navi-icon">

                        <i class="flaticon-profile"></i>

                    </span>
                        <span class="navi-text">Profile</span>
                    </a>
                </li>

                {{--@if(auth()->user()->type == 'client')--}}
                    {{--<li class="navi-item">--}}
                        {{--<a href="{{ route('subscription') }}"   class="navi-link">--}}
                        {{--<span class="navi-icon">--}}
                            {{--<i class="fa fa-dollar-sign"></i>--}}
                        {{--</span>--}}
                            {{--<span class="navi-text">Subscription </span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--@endif--}}



            <li class="navi-item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"  class="navi-link">
                        <span class="navi-icon">
                            <i class="flaticon-logout"></i>
                        </span>
                    <span class="navi-text">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </div>
</div>





