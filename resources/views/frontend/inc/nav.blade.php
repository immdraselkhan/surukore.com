@if(get_setting('topbar_banner') != null)
<div class="position-relative top-banner removable-session z-1035 d-none" data-key="top-banner" data-value="removed">
    <a href="{{ get_setting('topbar_banner_link') }}" class="d-block text-reset">
        <img src="{{ uploaded_asset(get_setting('topbar_banner')) }}" class="w-100 mw-100 h-50px h-lg-auto img-fit">
    </a>
    <button class="btn text-white absolute-top-right set-session" data-key="top-banner" data-value="removed" data-toggle="remove-parent" data-parent=".top-banner">
        <i class="la la-close la-2x"></i>
    </button>
</div>
@endif
<!-- Top Bar -->
<div class="top-navbar bg-white border-bottom border-soft-secondary z-1035">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col">
                <ul class="list-inline d-flex justify-content-between justify-content-lg-start mb-0">
                    @if(get_setting('show_language_switcher') == 'on')
                    <li class="list-inline-item dropdown mr-3" id="lang-change">
                        @php
                            if(Session::has('locale')){
                                $locale = Session::get('locale', Config::get('app.locale'));
                            }
                            else{
                                $locale = 'en';
                            }
                        @endphp
                        <a href="javascript:void(0)" class="dropdown-toggle text-reset py-2" data-toggle="dropdown" data-display="static">
                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$locale.'.png') }}" class="mr-2 lazyload" alt="{{ \App\Language::where('code', $locale)->first()->name }}" height="11">
                            <span class="opacity-60">{{ \App\Language::where('code', $locale)->first()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-left">
                            @foreach (\App\Language::all() as $key => $language)
                                <li>
                                    <a href="javascript:void(0)" data-flag="{{ $language->code }}" class="dropdown-item @if($locale == $language) active @endif">
                                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" class="mr-1 lazyload" alt="{{ $language->name }}" height="11">
                                        <span class="language">{{ $language->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif

                    @if(get_setting('show_currency_switcher') == 'on')
                    <li class="list-inline-item dropdown" id="currency-change">
                        @php
                            if(Session::has('currency_code')){
                                $currency_code = Session::get('currency_code');
                            }
                            else{
                                $currency_code = \App\Currency::findOrFail(get_setting('system_default_currency'))->code;
                            }
                        @endphp
                        <a href="javascript:void(0)" class="dropdown-toggle text-reset py-2 opacity-60" data-toggle="dropdown" data-display="static">
                            {{ \App\Currency::where('code', $currency_code)->first()->name }} {{ (\App\Currency::where('code', $currency_code)->first()->symbol) }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                            @foreach (\App\Currency::where('status', 1)->get() as $key => $currency)
                                <li>
                                    <a class="dropdown-item @if($currency_code == $currency->code) active @endif" href="javascript:void(0)" data-currency="{{ $currency->code }}">{{ $currency->name }} ({{ $currency->symbol }})</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>

            <div class="col-5 text-right d-none d-lg-block">
                <ul class="list-inline mb-0">
                    @auth
                        @if(isAdmin())
                            <li class="list-inline-item mr-3">
                                <a href="{{ route('admin.dashboard') }}" class="text-reset py-2 d-inline-block opacity-60">{{ translate('My Panel')}}</a>
                            </li>
                        @else
                            <li class="list-inline-item mr-3">
                                <a href="{{ route('dashboard') }}" class="text-reset py-2 d-inline-block opacity-60">{{ translate('My Panel')}}</a>
                            </li>
                        @endif
                        <li class="list-inline-item">
                            <a href="{{ route('logout') }}" class="text-reset py-2 d-inline-block opacity-60">{{ translate('Logout')}}</a>
                        </li>
                    @else
                        <li class="list-inline-item mr-3">
                            <a href="{{ route('user.login') }}" class="text-reset py-2 d-inline-block opacity-60">{{ translate('Login')}}</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('user.registration') }}" class="text-reset py-2 d-inline-block opacity-60">{{ translate('Registration')}}</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- END Top Bar -->
<header class="@if(get_setting('header_stikcy') == 'on') sticky-top @endif z-1020 tk_vally_brand-color border-bottom shadow-sm">
    <div class="position-relative logo-bar-area z-1" style="background-color:#f5f5f5;">
        <div class="container">
            <div class="d-flex align-items-center">

                <div class="col-auto col-xl-3 pl-0 pr-3 d-flex align-items-center">
                    <a class="d-block logo-padding mr-3 ml-0" href="{{ route('home') }}">
                        @php
                            $header_logo = get_setting('header_logo');
                        @endphp
                        @if($header_logo != null)
                            <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px h-md-100px" height="100">
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px h-md-100px" height="100">
                        @endif
                    </a>

{{--                    @if(Route::currentRouteName() != 'home')--}}
{{--                        <div class="d-none d-xl-block align-self-stretch category-menu-icon-box ml-auto mr-0">--}}
{{--                            <div class="h-100 d-flex align-items-center" id="category-menu-icon">--}}
{{--                                <div class="dropdown-toggle navbar-light bg-light h-40px w-50px pl-2 rounded border c-pointer">--}}
{{--                                    <span class="navbar-toggler-icon"></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}

                </div>



                <div class="d-lg-none ml-auto mr-0">
                    <a class="p-2 d-block text-white" href="javascript:void(0);" data-toggle="class-toggle" data-target=".front-header-search">
                        <i class="las la-search la-flip-horizontal la-2x"></i>
                    </a>
                </div>
                <button class="navbar-toggler  d-lg-none" type="button" data-toggle="collapse" data-target="#main_nav">
                        <span class="navbar-toggler-icon c_navbar-toggler-icon bg-black">
                            <i class="la la-bars la-2x opacity-100"></i>
                        </span>
                </button>

                <div class="flex-grow-1 front-header-search d-flex align-items-center bg-white">
                    <div class="position-relative flex-grow-1">
                        <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                            <div class="d-flex position-relative align-items-center">
                                <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                    <button class="btn px-2" type="button"><i class="la la-2x la-long-arrow-left"></i></button>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="border-0 border-lg form-control" id="search" name="q" placeholder="{{translate('I am shopping for...')}}" autocomplete="off">
                                    <div class="input-group-append d-none d-lg-block">
                                        <button class="btn btn-primary " type="submit" style="border-radius:0">
                                            <i class="la la-search la-flip-horizontal fs-18"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="min-height: 200px">
                            <div class="search-preloader absolute-top-center">
                                <div class="dot-loader"><div></div><div></div><div></div></div>
                            </div>
                            <div class="search-nothing d-none p-3 text-center fs-16">

                            </div>
                            <div id="search-content" class="text-left">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-none d-lg-none ml-3 mr-0">
                    <div class="nav-search-box">
                        <a href="#" class="nav-box-link">
                            <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
                        </a>
                    </div>
                </div>


                <div class="d-none d-lg-block ml-3 mr-0">
                    <div class="" id="compare">
                        @include('frontend.partials.compare')
                    </div>
                </div>

                <div class="d-none d-lg-block ml-3 mr-0">
                    <div class="" id="wishlist">
                        @include('frontend.partials.wishlist')
                    </div>
                </div>

                <div class="d-none d-lg-block  align-self-stretch ml-3 mr-0" data-hover="dropdown">
                    <div class="nav-cart-box dropdown h-100" id="cart_items">
                        @include('frontend.partials.cart')
                    </div>
                </div>

            </div>
        </div>
        @if(Route::currentRouteName() != 'home')
        <div class="hover-category-menu position-absolute w-100 top-100 left-0 right-0 d-none z-3" id="hover-category-menu">
            <div class="container">
                <div class="row gutters-10 position-relative">
                    <div class="col-lg-3 position-static">
                        @include('frontend.partials.category_menu')
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

        <div class="bg-black border-top border-gray-200 ">
{{--            <div class="container">--}}
{{--                <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center">--}}
{{--                    @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)--}}
{{--                    <li class="list-inline-item mr-0">--}}
{{--                        <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}" class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">--}}
{{--                            {{ translate($value) }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}



            <div class="container">
                <nav class="navbar navbar-expand-lg bg-black p-0">



{{--                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">--}}
{{--                        <span class="navbar-toggler-icon c_navbar-toggler-icon">--}}
{{--                            <i class="la la-bars la-2x opacity-80"></i>--}}
{{--                        </span>--}}
{{--                    </button>--}}
                    <div class="collapse navbar-collapse" id="main_nav">

                        <ul class="navbar-nav custom-navbar">
{{--                            @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}"--}}
{{--                                       class="nav-link">--}}
{{--                                        {{ translate($value) }}--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}

                            @foreach (\App\Category::where('level', 0)->orderBy('order_level', 'desc')->get()->take(20) as $key => $category)
                            <li class="nav-item dropdown">
                                <a class="nav-link text-white @if(count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id))>0) dropdown-toggle @endif" href="{{ route('products.category', $category->slug) }}" @if(count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id))>0) data-toggle="dropdown"  @endif>  {{ $category->getTranslation('name') }}  </a>
{{--                                <a class="nav-link @if(count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id))>0) dropdown-toggle @endif" href="{{ route('products.category', $category->slug) }}" @if(count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id))>0) data-toggle="dropdown" @endif>  {{ $category->getTranslation('name') }}  </a>--}}
                                @if(count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id))>0)
                                <ul class="dropdown-menu c_dropdown-menu c_top_boder c_box-shadow_none text-white`">
                                    @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category->id) as $key => $first_level_id)
                                    <li><a class="dropdown-item" href="{{ route('products.category', \App\Category::find($first_level_id)->slug) }}" data-display="static"> {{ \App\Category::find($first_level_id)->getTranslation('name') }}
                                            <span class="text-right custom-ion"><i class="la la-angle-right"></i></span>
                                        </a>
{{--                                        <ul class="submenu dropdown-menu">--}}
{{--                                            @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($first_level_id) as $key => $second_level_id)--}}
{{--                                            <li><a class="dropdown-item" href="{{ route('products.category', \App\Category::find($second_level_id)->slug) }}">{{ \App\Category::find($second_level_id)->getTranslation('name') }}</a></li>--}}
{{--                                            @endforeach--}}
{{--                                            <li><a class="dropdown-item" href=""> Third level--}}
{{--                                                    <span class="text-right custom-ion"><i class="la la-angle-right"></i></span>--}}
{{--                                                </a>--}}
{{--                                                <ul class="submenu dropdown-menu">--}}
{{--                                                    <li><a class="dropdown-item" href=""> Fourth level 1</a></li>--}}
{{--                                                    <li><a class="dropdown-item" href=""> Fourth level 2</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
                                    </li>
                                    @endforeach
                                </ul>
                                    @endif
                            </li>
                            @endforeach
                        </ul>
                    </div> <!-- navbar-collapse.// -->
                </nav>
            </div>






        </div>

</header>
