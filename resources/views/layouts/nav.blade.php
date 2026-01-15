<!-- BEGIN: Header-->
<nav
    class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a
                        class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                            class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item"><a class="navbar-brand" href="/"><img class="brand-logo"
                                                                           alt="modern admin logo"
                                                                           src="{{asset('logo/images2.png')}}">
                        <h3 class="brand-text">{{__('admin.account_system')}}</h3>
                    </a></li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                                                  data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                                              href="#"><i class="ft-menu"></i></a></li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i
                                class="ficon ft-maximize"></i></a></li>
                    <li class="dropdown nav-item mega-dropdown d-none d-lg-block"><a class="dropdown-toggle nav-link"
                                                                                     href="#"
                                                                                     data-toggle="dropdown"> {{ __('admin.Contact_Us') }}</a>
                        <ul class="mega-dropdown-menu dropdown-menu row">
                            <li class="col-md-2">

                                <div id="mega-menu-carousel-example">
                                    <div><img class="rounded img-fluid mb-1"
                                              src="{{ asset('logo/download.jfif') }}" alt="bout us"><a
                                            class="news-title mb-0 d-block" href="#"></a>
                                        <p class="news-content"><span
                                                class="font-small-2">{{ now()->format('Y-m-d H:i:s') }}</span></p>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-3">
                                <h6 class="dropdown-menu-header text-uppercase"><i
                                        class="la la-home"></i> {{__('admin.Dashboard')}}</h6>
                                <ul>
                                    <li class="menu-list">
                                        <ul>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="la la-cog"></i> {{__('admin.system_setting')}}</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="la la-calculator"></i> {{__('admin.accounts')}}</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="la la-truck"></i> {{__('admin.stores')}}</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="icon-basket-loaded"></i> {{__('admin.purchases')}}</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="la la-shopping-cart"></i> {{__('admin.sales')}}</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="col-md-3">
                                <h6 class="dropdown-menu-header text-uppercase"><i
                                        class="la la-list-ul"></i> {{ __('admin.account_system') }}
                                </h6>
                                <div class="mt-1" id="accordionWrap" role="tablist" aria-multiselectable="true">
                                    <div class="card border-0 box-shadow-0 collapse-icon accordion-icon-rotate">
                                        <div class="card-header p-0 pb-2 border-0" id="headingOne" role="tab"><a
                                                data-toggle="collapse" href="#accordionOne" aria-expanded="true"
                                                aria-controls="accordionOne">{{ __('admin.introduction') }}</a></div>
                                        <div class="card-collapse collapse show" id="accordionOne" role="tabpanel"
                                             aria-labelledby="headingOne" data-parent="#accordionWrap"
                                             aria-expanded="true">
                                            <div class="card-content">
                                                <p class="accordion-text text-small-3">{{ __('admin.An_accounting_system_is_the_framework_or_organized_method_for_recording_processing_and_classifying_all_financial_transactions_of_a_company_or_organization_with_the_aim_of_producing_accurate_information_that_helps_in_making_financial_and_administrative_decisions') }}</p>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </li>
                            <li class="col-md-4">
                                <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="la la-envelope-o"></i>
                                    {{ __('admin.Contact_Us') }}</h6>
                                <form class="form form-horizontal" action="{{ route('send-mail') }}" method="POST">
                                    @csrf

                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-3 form-control-label"
                                                   for="name">{{ __('admin.name') }}</label>
                                            <div class="col-sm-9">
                                                <div class="position-relative has-icon-left">
                                                    <input
                                                        class="form-control"
                                                        type="text"
                                                        id="name"
                                                        name="name"

                                                        required
                                                    >
                                                    <div class="form-control-position pl-1">
                                                        <i class="la la-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 form-control-label"
                                                   for="email">{{ __('admin.email') }}</label>
                                            <div class="col-sm-9">
                                                <div class="position-relative has-icon-left">
                                                    <input
                                                        class="form-control"
                                                        type="email"
                                                        id="email"
                                                        name="email"
                                                        placeholder="john@example.com"
                                                        required
                                                    >
                                                    <div class="form-control-position pl-1">
                                                        <i class="la la-envelope-o"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 form-control-label"
                                                   for="message">{{ __('admin.message') }}</label>
                                            <div class="col-sm-9">
                                                <div class="position-relative has-icon-left">
                    <textarea
                        class="form-control"
                        id="message"
                        name="message"
                        rows="3"

                        required
                    ></textarea>
                                                    <div class="form-control-position pl-1">
                                                        <i class="la la-commenting-o"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 mb-1">
                                                <button class="btn btn-info float-right" type="submit">
                                                    <i class="la la-paper-plane-o"></i> {{ __('admin.send') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </li>
                        </ul>
                    </li>

                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link"
                                                                       id="dropdown-flag" href="#"
                                                                       data-toggle="dropdown" aria-haspopup="true"
                                                                       aria-expanded="false">
                            <i class="ft ft-globe"></i> <span
                                class="selected-language">{{ app()->getLocale() == 'en' ? 'EN'  : 'AR'  }}</span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                            <a class="dropdown-item" href="{{url('locale/en')}}"><i
                                    class="flag-icon flag-icon-gb"></i>{{__('admin.en')}} </a>
                            <a class="dropdown-item " href="{{url('locale/ar')}}"><i
                                    class="flag-icon flag-icon-ye "></i> {{__('admin.ar')}} </a>
                        </div>
                    </li>
{{--                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#"--}}
{{--                                                                           data-toggle="dropdown"><i--}}
{{--                                class="ficon ft-bell"></i><span--}}
{{--                                class="badge badge-pill badge-danger badge-up badge-glow">5</span></a>--}}
{{--                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">--}}
{{--                            <li class="dropdown-menu-header">--}}
{{--                                <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6>--}}
{{--                                <span class="notification-tag badge badge-danger float-right m-0">5 New</span>--}}
{{--                            </li>--}}
{{--                            <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="media-left align-self-center"><i--}}
{{--                                                class="ft-plus-square icon-bg-circle bg-cyan"></i></div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h6 class="media-heading">You have new order!</h6>--}}
{{--                                            <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor sit--}}
{{--                                                amet, consectetuer elit.</p><small>--}}
{{--                                                <time class="media-meta text-muted"--}}
{{--                                                      datetime="2015-06-11T18:29:20+08:00">30 minutes ago--}}
{{--                                                </time>--}}
{{--                                            </small>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a><a href="javascript:void(0)">--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="media-left align-self-center"><i--}}
{{--                                                class="ft-download-cloud icon-bg-circle bg-red bg-darken-1"></i></div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h6 class="media-heading red darken-1">99% Server load</h6>--}}
{{--                                            <p class="notification-text font-small-3 text-muted">Aliquam tincidunt--}}
{{--                                                mauris eu risus.</p><small>--}}
{{--                                                <time class="media-meta text-muted"--}}
{{--                                                      datetime="2015-06-11T18:29:20+08:00">Five hour ago--}}
{{--                                                </time>--}}
{{--                                            </small>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a><a href="javascript:void(0)">--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="media-left align-self-center"><i--}}
{{--                                                class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h6 class="media-heading yellow darken-3">Warning notifixation</h6>--}}
{{--                                            <p class="notification-text font-small-3 text-muted">Vestibulum auctor--}}
{{--                                                dapibus neque.</p><small>--}}
{{--                                                <time class="media-meta text-muted"--}}
{{--                                                      datetime="2015-06-11T18:29:20+08:00">Today--}}
{{--                                                </time>--}}
{{--                                            </small>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a><a href="javascript:void(0)">--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="media-left align-self-center"><i--}}
{{--                                                class="ft-check-circle icon-bg-circle bg-cyan"></i></div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h6 class="media-heading">Complete the task</h6><small>--}}
{{--                                                <time class="media-meta text-muted"--}}
{{--                                                      datetime="2015-06-11T18:29:20+08:00">Last week--}}
{{--                                                </time>--}}
{{--                                            </small>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a><a href="javascript:void(0)">--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="media-left align-self-center"><i--}}
{{--                                                class="ft-file icon-bg-circle bg-teal"></i></div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h6 class="media-heading">Generate monthly report</h6><small>--}}
{{--                                                <time class="media-meta text-muted"--}}
{{--                                                      datetime="2015-06-11T18:29:20+08:00">Last month--}}
{{--                                                </time>--}}
{{--                                            </small>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a></li>--}}
{{--                            <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"--}}
{{--                                                                href="javascript:void(0)">Read all notifications</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                            <i class="ficon ft-mail"></i>
                            @if($messages_count > 0)
                                <span class="badge badge-pill badge-danger badge-up">{{ $messages_count }}</span>

                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0"><span
                                        class="grey darken-2">{{__('admin.messages')}} {{__('admin.email')}}</span></h6>
                                <span
                                    class="notification-tag badge badge-warning float-right m-0">{{ $messages_count }} {{__('admin.new')}}</span>
                            </li>
                            <li class="scrollable-container media-list w-100">
                                @if(isset($messages) && $messages->count() > 0)
                                    @foreach($messages as $msg)
                                        <a href="javascript:void(0)">
                                            <div class="media">
                                                <div class="media-left">
                            <span class="avatar avatar-sm avatar-online rounded-circle">
                                <img  src="{{asset('storage/'. Auth::User()->image)}}"
                                      onerror="this.src='{{ url('storage/profile.png')}}'" alt="avatar">
                            </span>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">{{ $msg->sender_name }}</h6>
                                                    <p class="notification-text font-small-3 text-muted">{{ Str::limit($msg->content, 40) }}</p>
                                                    <small>
                                                        <time
                                                            class="media-meta text-muted">{{ $msg->created_at->diffForHumans() }}</time>
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="text-center p-3">{{__('admin.There_are_no_new_messages')}}</div>
                                @endif
                            </li>
                            {{--                            <li class="dropdown-menu-footer">--}}
                            {{--                                <a class="dropdown-item text-muted text-center" href="#">عرض جميع الرسائل</a>--}}
                            {{--                            </li>--}}
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                                                                   href="#" data-toggle="dropdown"><span
                                class="mr-1 user-name text-bold-700"> {{Auth::user()->name }}</span>
                            <span
                                class="avatar avatar-online"><img
                                    src="{{ asset('storage/'.Auth::user()->image) }}"
                                    onerror="this.src='{{ url('storage/profile.png')}}'"
                                    alt="{{ Auth::user()->name }}"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                                                          href="{{route("profile")}}"><i class="ft-user"></i>{{ __('admin.profile') }}</a>
                            <a class="dropdown-item" href="{{route('chat.index',auth()->id())}}"><i
                                    class="ft-message-square"></i> {{ __('admin.chats') }}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();"><i
                                    class="ft-power"></i>  {{ __('admin.Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->
