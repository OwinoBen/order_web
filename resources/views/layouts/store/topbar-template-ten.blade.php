    @php
        $clientData = \App\Models\Client::select('id', 'logo')
            ->where('id', '>', 0)
            ->first();
        $urlImg = $clientData->logo['image_fit'] . '300/100' . $clientData->logo['image_path'];

        $languageList = \App\Models\ClientLanguage::with('language')
            ->where('is_active', 1)
            ->orderBy('is_primary', 'desc')
            ->get();
        $currencyList = \App\Models\ClientCurrency::with('currency')
            ->orderBy('is_primary', 'desc')
            ->get();
        $pages = \App\Models\Page::with([
            'translations' => function ($q) {
                $q->where('language_id', session()->get('customerLanguage') ?? 1);
            },
        ])
            ->whereHas('translations', function ($q) {
                $q->where(['is_published' => 1, 'language_id' => session()->get('customerLanguage') ?? 1]);
            })
            ->orderBy('order_by', 'ASC')
            ->get();
        $preference = $client_preference_detail;
        $applocale = 'en';
        if (session()->has('applocale')) {
            $applocale = session()->get('applocale');
        }
    @endphp
    <div class="header_top_bar">
        <div class="container">
            <div class="item">
                @if ($preference->is_hyperlocal && $preference->is_hyperlocal == 1)
                    <div class="  location-bar d-inline-flex align-items-center position-relative p-0 mr-2"
                        href="#edit-address" data-toggle="modal">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <h2 class="homepage-address"><span data-placement="top" data-toggle="tooltip"
                                title="{{ session('selectedAddress') }}">{{ session('selectedAddress') }}</span></h2>
                    </div>
                @endif
                @php
                    $url = '';
                    if ($topBarText->link == 'category') {
                        if (!empty($topBarText->category->slug)) {
                            $url = route('categoryDetail', $topBarText->category->slug);
                        }
                    } elseif ($topBarText->link == 'vendor') {
                        if (!empty($topBarText->vendor->slug)) {
                            $url = route('vendorDetail', $topBarText->vendor->slug);
                        }
                    }
                @endphp
                <div class="sale_for">
                    <a href="{{ $url }}">
                        <img src="{{ get_file_path(@$topBarText->banner_image, 'IMG_URL1', '400', '150') }}"
                            alt="">
                        <p><b>{{ strtoupper(@$topBarText->bold_text) }}</b>{{ ucwords(@$topBarText->normal_text) }}</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="top-header site-topbar al_custom_head">
        <nav class="navbar navbar-expand-lg p-0 ">
            <div class="container ">
                <div class="row d-flex align-items-center justify-content-between w-100">
                    <div class="left p-0 d-md-flex align-items-center justify-content-start">
                        <a class="navbar-brand mr-3" href="{{ route('userHome') }}">
                            <img class="logo-image" style="height:50px;" alt="" src="{{ $urlImg }}"></a>
                        <div
                            class="al_custom_head_map_box px-2 py-1 d-md-inline-flex  d-flex align-items-center justify-content-start">
                            @if (isset($preference))
                            @endif
                            <div class="col d-inline-flex  justify-content-start p-0 position-relative">
                                @php
                                    $searchPlaceholder = getNomenclatureName('Search', true);
                                    $searchPlaceholder = $searchPlaceholder === 'Search product, vendor, item' ? __('Search product, vendor, item') : $searchPlaceholder;
                                @endphp
                                <input class="form-control border-0 typeahead" type="search"
                                    placeholder="{{ $searchPlaceholder }}" id="main_search_box" autocomplete="off">
                                <button class="btn"><i class="fa fa-search" aria-hidden="true"></i> Search </button>
                                <div class="list-box style-4" style="display:none;" id="search_box_main_div"> </div>
                            </div>

                        </div>
                    </div>

                    <div class="right text-right ml-auto al_z_index p-0">
                        <ul class="header-dropdown ml-auto">
                            @if (p2p_module_status() && Session::get('vendorType') == 'p2p')
                                <li><a href="{{ route('posts.index', ['fullPage' => 1]) }}" class="sell-btn"><span><i
                                                class="fa fa-plus"
                                                aria-hidden="true"></i>{{ __('Add Post') }}</span></a></li>
                            @endif
                            @if ($is_ondemand_multi_pricing == 1)
                                @include('layouts.store.onDemandTopBarli')
                            @endif
                            @if ($client_preference_detail->header_quick_link == 1)
                                {{-- <li class="onhover-dropdown quick-links quick-links">
                            <a href="javascript:void(0)">
                                <span class="icon-icLang align-middle">
                                    <svg version="1.0"width="18" height="18" fill="none" stroke="none" viewBox="0 0 456.000000 456.000000"
                                        preserveAspectRatio="xMidYMid meet">
                                        <g transform="translate(0.000000,456.000000) scale(0.100000,-0.100000)">
                                        <path d="M3472 4549 c-40 -5 -123 -25 -185 -46 -181 -60 -224 -94 -638 -508
                                        -197 -197 -359 -363 -359 -369 0 -6 49 -61 110 -121 l109 -109 22 20 c13 10
                                        181 177 374 369 327 327 356 353 425 387 119 58 181 73 300 72 115 0 186 -16
                                        279 -64 123 -63 195 -134 265 -261 99 -183 99 -377 0 -578 l-46 -94 -667 -666
                                        -666 -667 -95 -46 c-56 -28 -122 -52 -160 -58 -36 -7 -81 -16 -101 -22 -24 -7
                                        -43 -7 -55 0 -10 5 -44 12 -74 16 -72 10 -169 48 -249 99 l-64 42 -109 -115
                                        c-59 -63 -108 -119 -108 -125 2 -31 197 -147 315 -187 22 -7 42 -16 45 -19 12
                                        -15 179 -39 269 -39 96 0 246 22 280 40 9 5 53 24 99 41 160 60 187 83 892
                                        789 360 360 676 683 702 718 188 252 229 638 101 942 -53 124 -110 204 -220
                                        311 -145 139 -296 213 -503 244 -103 16 -175 17 -288 4z"/>
                                        <path d="M1955 3083 c-44 -9 -82 -19 -85 -22 -3 -4 -34 -18 -70 -30 -91 -33
                                        -145 -61 -219 -116 -35 -26 -360 -343 -720 -704 -753 -752 -749 -748 -816
                                        -972 -68 -225 -54 -475 37 -681 118 -269 364 -470 653 -534 117 -26 343 -24
                                        447 4 244 66 293 101 731 536 198 196 357 360 355 365 -5 16 -209 231 -219
                                        231 -4 0 -168 -160 -363 -355 -198 -197 -379 -370 -408 -388 -200 -128 -438
                                        -139 -637 -31 -92 51 -145 94 -195 160 -94 127 -130 231 -130 384 -1 143 41
                                        275 118 375 17 22 323 333 681 690 l651 651 94 46 c56 28 122 52 160 58 36 6
                                        80 16 98 22 23 7 42 7 60 0 15 -6 49 -13 75 -16 65 -8 168 -50 246 -99 l64
                                        -42 109 115 c59 63 108 119 108 125 -2 31 -197 147 -315 187 -22 7 -42 16 -45
                                        19 -3 3 -42 13 -88 22 -102 21 -268 21 -377 0z"/>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <span class="quick-links ml-1 align-middle">{{ __('Quick Links') }}</span>
                            <ul class="onhover-show-div">
                                @foreach ($pages as $page)
                                @if (isset($page->primary->type_of_form) && $page->primary->type_of_form == 2)
                                @if (isset($last_mile_common_set) && $last_mile_common_set != false)
                                <li>
                                    <a href="{{route('extrapage',['slug' => $page->slug])}}">
                                        @if (isset($page->translations) && $page->translations->first()->title != null)
                                        {{ $page->translations->first()->title ?? ''}}
                                        @else
                                        {{ $page->primary->title ?? ''}}
                                        @endif
                                    </a>
                                </li>
                                @endif
                                @else
                                <li>
                                    <a href="{{route('extrapage',['slug' => $page->slug])}}" target="_blank">
                                        @if (isset($page->translations) && $page->translations->first()->title != null)
                                        {{ $page->translations->first()->title ?? ''}}
                                        @else
                                        {{ $page->primary->title ?? ''}}
                                        @endif
                                    </a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </li> --}}
                            @endif
                            @if (count($languageList) > 1)
                                {{-- <li class="onhover-dropdown change-language">
                            <a href="javascript:void(0)">
                                <!-- <span class="alLanguageSign">{{$applocale}}</span> -->
                                <span class="icon-icLang align-middle">
                                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 456.000000 456.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,456.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
<path d="M2055 4554 c-110 -12 -303 -50 -408 -80 -841 -242 -1461 -935 -1618
-1809 -21 -114 -24 -161 -24 -385 1 -222 4 -272 24 -385 174 -975 916 -1708
1896 -1872 172 -28 564 -26 740 6 965 172 1693 900 1866 1866 21 114 24 162
24 385 0 223 -3 271 -24 385 -86 484 -304 901 -649 1242 -327 324 -750 541
-1212 623 -99 18 -172 23 -350 25 -124 2 -243 1 -265 -1z m303 -268 c121 -32
247 -139 349 -294 82 -124 172 -310 222 -457 l41 -120 -48 -9 c-61 -11 -1153
-14 -1253 -3 l-77 8 14 47 c53 175 154 398 233 516 66 97 177 215 242 257 55
35 148 68 194 68 17 1 54 -6 83 -13z m-764 -202 c-110 -181 -206 -401 -260
-597 l-16 -59 -71 7 c-127 12 -410 45 -489 56 l-78 11 19 27 c37 52 158 181
231 247 192 173 417 309 650 395 41 15 76 26 78 24 1 -1 -27 -51 -64 -111z
m1431 69 c297 -115 596 -332 798 -578 l58 -70 -33 -7 c-36 -7 -418 -53 -534
-63 l-71 -7 -37 119 c-75 233 -176 453 -272 591 -51 73 -55 72 91 15z m-2165
-942 c129 -16 272 -32 318 -36 70 -6 82 -10 78 -24 -24 -80 -64 -411 -73 -598
l-6 -143 -454 0 -453 0 0 33 c0 54 28 220 55 325 31 125 75 251 126 361 62
133 58 130 121 120 29 -5 159 -22 288 -38z m3240 -65 c58 -123 102 -245 135
-378 27 -105 55 -271 55 -325 l0 -33 -455 0 -455 0 0 78 c0 111 -27 383 -54
542 -13 74 -23 136 -22 136 1 1 78 9 171 18 94 10 258 30 365 45 107 15 199
25 204 23 5 -3 30 -50 56 -106z m-2176 -17 c288 -10 441 -10 718 0 194 7 362
13 373 14 18 2 22 -11 42 -123 21 -124 46 -341 58 -517 l7 -93 -842 0 -841 0
6 98 c14 213 59 571 80 631 3 7 12 11 20 8 8 -4 178 -12 379 -18z m-744 -1057
c0 -141 50 -582 76 -663 4 -14 -8 -18 -78 -24 -91 -7 -522 -60 -606 -74 -63
-10 -59 -13 -121 120 -51 110 -95 236 -126 361 -27 105 -55 271 -55 326 l0 32
455 0 455 0 0 -78z m1935 -19 c-17 -245 -66 -618 -84 -634 -3 -3 -64 -1 -136
4 -169 12 -1062 12 -1230 0 -71 -5 -133 -7 -136 -4 -18 16 -67 389 -84 634
l-6 97 841 0 841 0 -6 -97z m1171 20 c-14 -161 -67 -373 -137 -548 -54 -135
-101 -221 -119 -218 -132 19 -432 56 -560 69 -91 9 -166 17 -167 18 0 0 5 35
13 76 25 130 54 390 61 538 l6 142 455 0 455 0 -7 -77z m-1360 -919 l41 -6
-14 -46 c-52 -175 -152 -397 -233 -518 -66 -98 -208 -241 -275 -276 -27 -14
-78 -32 -111 -39 -54 -11 -70 -10 -128 5 -177 48 -327 209 -474 509 -56 113
-147 356 -137 365 18 18 1205 24 1331 6z m-1571 -141 c73 -230 159 -419 260
-573 60 -91 65 -89 -80 -33 -237 92 -476 248 -667 435 -73 72 -191 209 -185
215 7 6 530 69 603 72 l31 1 38 -117z m2245 81 c118 -14 230 -28 248 -32 l33
-7 -54 -65 c-175 -212 -411 -397 -661 -519 -110 -54 -266 -116 -266 -107 0 2
30 53 66 113 109 180 206 402 260 596 l16 59 71 -7 c40 -3 169 -18 287 -31z"></path>
</g>
</svg>
                                </span>
                                <span class="language ml-1">{{ __("Language") }}</span>
                            </a>
                            <ul class="onhover-show-div">
                                @foreach ($languageList as $key => $listl)
                                    <li class="{{$applocale ==  $listl->language->sort_code ?  'active' : ''}}">
                                        <a href="javascript:void(0)" class="customerLang" langId="{{$listl->language_id}}">{{$listl->language->name}}@if ($listl->language->id != 1)
                                            ({{$listl->language->nativeName}})
                                            @endif </a>
                                    </li>

                                @endforeach
                            </ul>
                        </li> --}}
                            @endif



                            <li class="onhover-dropdown mobile-account">
                                <span class="icon-icLang align-middle wishlist-icon">
                                    {{-- <svg version="1.0" width="18" height="18" viewBox="0 0 456.000000 456.000000" preserveAspectRatio="xMidYMid meet">
                                    <g transform="translate(0.000000,456.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                                    <path d="M1935 4544 c-350 -61 -688 -195 -951 -380 -136 -94 -194 -144 -320
                                    -269 -126 -126 -172 -179 -262 -309 -196 -280 -330 -615 -387 -966 -21 -132
                                    -21 -548 0 -680 57 -351 191 -686 387 -966 90 -130 136 -183 262 -309 353
                                    -352 772 -565 1280 -650 123 -21 549 -21 672 0 228 38 432 101 638 197 251
                                    117 436 248 642 453 126 126 172 179 262 309 196 280 330 615 387 966 21 132
                                    21 548 0 680 -57 351 -191 686 -387 966 -90 130 -136 183 -262 309 -353 352
                                    -772 565 -1280 650 -118 20 -566 19 -681 -1z m529 -269 c103 -8 341 -57 436
                                    -91 41 -14 98 -34 125 -44 89 -31 319 -154 395 -212 219 -165 366 -312 497
                                    -493 67 -94 200 -334 218 -397 4 -13 22 -63 40 -113 32 -85 71 -255 95 -410
                                    14 -90 14 -368 0 -465 -58 -403 -187 -713 -420 -1012 l-44 -57 -36 107 c-134
                                    401 -424 730 -809 916 -52 25 -101 46 -108 46 -25 0 -13 18 36 53 72 52 190
                                    192 238 284 99 185 143 417 113 593 -34 206 -117 380 -247 519 -65 70 -181
                                    171 -197 171 -2 0 -31 16 -63 34 -113 68 -303 116 -453 116 -150 0 -340 -48
                                    -453 -116 -32 -18 -61 -34 -63 -34 -16 0 -132 -101 -197 -171 -173 -186 -269
                                    -449 -253 -694 11 -177 57 -317 157 -485 33 -54 149 -180 202 -218 26 -19 47
                                    -38 47 -43 0 -5 -12 -12 -27 -15 -44 -11 -201 -93 -288 -152 -294 -199 -509
                                    -480 -618 -808 l-33 -102 -44 57 c-232 297 -362 609 -420 1011 -14 97 -14 375
                                    0 465 24 155 63 325 95 410 18 50 36 100 40 113 18 63 151 303 218 397 131
                                    181 278 328 497 493 76 58 306 181 395 212 27 10 84 30 125 44 106 38 354 87
                                    484 96 109 7 162 6 320 -5z m-108 -745 c286 -37 515 -239 584 -515 44 -176 11
                                    -384 -86 -530 -102 -156 -224 -244 -401 -290 -125 -33 -221 -33 -346 0 -97 25
                                    -132 41 -222 101 -220 146 -332 451 -265 719 75 298 329 503 650 523 8 1 47
                                    -3 86 -8z m226 -1689 c209 -61 313 -110 453 -212 100 -73 146 -116 222 -204
                                    147 -171 248 -384 294 -616 l12 -63 -39 -34 c-112 -97 -374 -247 -529 -302
                                    -256 -93 -467 -131 -715 -131 -248 0 -459 38 -715 131 -153 55 -395 192 -523
                                    297 -43 35 -44 37 -37 80 4 25 22 96 40 159 63 215 163 383 325 544 58 58 132
                                    124 165 147 129 90 312 171 460 206 106 25 115 26 325 22 157 -3 208 -8 262
                                    -24z"></path>
                                    </g>
                                </svg> --}}
                                    <svg width="16" height="19" viewBox="0 0 16 19" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.0058 17.4605V15.6316C14.0058 14.6615 13.6633 13.7311 13.0535 13.0451C12.4437 12.3591 11.6167 11.9737 10.7544 11.9737H4.25146C3.38912 11.9737 2.5621 12.3591 1.95233 13.0451C1.34256 13.7311 1 14.6615 1 15.6316V17.4605"
                                            stroke="black" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M7.50244 8.31579C9.29817 8.31579 10.7539 6.67809 10.7539 4.65789C10.7539 2.6377 9.29817 1 7.50244 1C5.70671 1 4.25098 2.6377 4.25098 4.65789C4.25098 6.67809 5.70671 8.31579 7.50244 8.31579Z"
                                            stroke="black" stroke-opacity="0.7" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <line x1="1" y1="17.375" x2="14.0058" y2="17.375"
                                            stroke="#4D4D4D" stroke-width="2" />
                                    </svg>

                                </span>
                                <span class="alAccount">{{ __('My Account') }}</span>
                                <ul class="onhover-show-div">
                                    @if (Auth::user())
                                        @if (
                                            @auth()->user()->can('dashboard-view') ||
                                                Auth::user()->is_superadmin == 1 ||
                                                Auth::user()->is_admin == 1)
                                            <li>
                                                <a href="{{ route('client.dashboard') }}"
                                                    data-lng="en">{{ __('Control Panel') }}</a>
                                            </li>
                                        @endif
                                        <li>
                                            <a href="{{ route('user.profile') }}"
                                                data-lng="en">{{ __('Profile') }}</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('user.logout') }}"
                                                data-lng="es">{{ __('Logout') }}</a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('customer.login') }}"
                                                data-lng="en">{{ __('Login') }}</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('customer.register') }}"
                                                data-lng="es">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                            <div class="al_new_ipad_view ipad-view cutom_add_wishlist">
                                <div
                                    class="search_bar menu-right d-sm-flex d-block align-items-center justify-content-end w-100">
                                    @if (Session::get('preferences'))
                                        @if (isset(Session::get('preferences')->is_hyperlocal) && Session::get('preferences')->is_hyperlocal == 1)
                                            <div class="location-bar d-none align-items-center justify-content-start ml-md-2 my-2 my-lg-0 dropdown-toggle"
                                                href="#edit-address" data-toggle="modal">
                                                <div class="map-icon mr-md-1"><i class="fa fa-map-marker"
                                                        aria-hidden="true"></i></div>
                                                <div class="homepage-address text-left">
                                                    <h2><span data-placement="top" data-toggle="tooltip"
                                                            title="{{ session('selectedAddress') }}">{{ session('selectedAddress') }}</span>
                                                    </h2>
                                                </div>
                                                <div class="down-icon"> <i class="fa fa-angle-down"
                                                        aria-hidden="true"></i> </div>
                                            </div>
                                        @endif
                                    @endif
                                    @include('layouts.store.search_template')
                                    @if (auth()->user())
                                        @if ($client_preference_detail->show_wishlist == 1)
                                            <div class="icon-nav mr-0 d-none d-lg-block"> <a class="fav-button"
                                                    href="{{ route('user.wishlists') }}">
                                                    <span class="icon-icLang align-middle wishlist-icon">

                                                        <svg width="21" height="21" viewBox="0 0 21 21"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_557_43)">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M11.9634 0.723057C11.9634 0.723057 10.8335 1.39643 10.11 2.48363C10.11 2.48363 9.38652 1.39643 8.25657 0.723057C8.25657 0.723057 6.48417 -0.333172 4.51515 0.107547C4.51515 0.107547 2.54612 0.548267 1.27306 2.28615C1.27306 2.28615 0 4.02403 0 6.27127C0 6.27127 0 11.097 4.92846 16.061C4.92846 16.061 6.43022 17.5736 8.22906 18.9291C8.22906 18.9291 9.13218 19.6097 9.74411 19.9932C9.97144 20.1357 10.2486 20.1356 10.476 19.993C10.476 19.993 11.0904 19.6079 11.994 18.9268C11.994 18.9268 13.7928 17.5709 15.2943 16.0582C15.2943 16.0582 20.22 11.0955 20.22 6.27127C20.22 6.27127 20.22 4.02403 18.9469 2.28615C18.9469 2.28615 17.6739 0.548267 15.7049 0.107547C15.7049 0.107547 13.7358 -0.333172 11.9634 0.723057ZM7.55259 2.20258C7.55259 2.20258 8.85235 2.97715 9.41872 4.49836C9.4947 4.70242 9.63964 4.86462 9.82201 4.94967L9.82461 4.95086C10.0073 5.03504 10.2124 5.03516 10.3951 4.95099L10.398 4.94965C10.5804 4.86462 10.7253 4.70242 10.8012 4.49836C10.8012 4.49836 11.3677 2.97715 12.6674 2.20258C12.6674 2.20258 13.9672 1.42801 15.4111 1.75121C15.4111 1.75121 16.8551 2.0744 17.7887 3.34885C17.7887 3.34885 18.7222 4.6233 18.7222 6.27127C18.7222 6.27127 18.7222 10.3492 14.2922 14.8125C14.2922 14.8125 12.8689 16.2464 11.1573 17.5365C11.1573 17.5365 10.7925 17.8115 10.4169 18.078C10.2298 18.2107 9.99051 18.2104 9.80343 18.0778C9.61699 17.9458 9.35867 17.7595 9.0656 17.5387C9.0656 17.5387 7.354 16.2489 5.93042 14.8151C5.93042 14.8151 1.49778 10.3504 1.49778 6.27127C1.49778 6.27127 1.49778 4.6233 2.43136 3.34885C2.43136 3.34885 3.36494 2.0744 4.80888 1.75121C4.80888 1.75121 6.25283 1.42801 7.55259 2.20258Z"
                                                                    fill="#4A4A4A" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_557_43">
                                                                    <rect width="20.22" height="20.1"
                                                                        fill="white" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>




                                                    </span>
                                                    <span>WishList</span>
                                                </a> </div>
                                        @endif
                                    @endif
                                    <div class="icon-nav d-none d-lg-inline-block ">
                                        <form name="filterData" id="filterData"
                                            action="{{ route('changePrimaryData') }}"> @csrf <input type="hidden"
                                                id="cliLang" name="cliLang"
                                                value="{{ session('customerLanguage') }}"> <input type="hidden"
                                                id="cliCur" name="cliCur"
                                                value="{{ session('customerCurrency') }}"> </form>
                                        <ul class="d-flex align-items-center m-0 ">

                                            <li class="onhover-div pl-0 shake-effect d-none">
                                                @if ($client_preference_detail)
                                                    @if ($client_preference_detail->cart_enable == 1)
                                                        <a class="btn btn-solid d-flex align-items-center p-0"
                                                            href="{{ route('showCart') }}">
                                                            <span class="mr-1"><svg width="24px" height="24px"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M15 19C15 20.1046 15.8954 21 17 21C18.1046 21 19 20.1046 19 19C19 17.8954 18.1046 17 17 17H7.36729C6.86964 17 6.44772 16.6341 6.37735 16.1414M18 14H6.07143L4.5 3H2M9 5H21L19 11M11 19C11 20.1046 10.1046 21 9 21C7.89543 21 7 20.1046 7 19C7 17.8954 7.89543 17 9 17C10.1046 17 11 17.8954 11 19Z"
                                                                        stroke="#001A72" stroke-width="1.5"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg></span>


                                                            <span id="cart_qty_span"></span>
                                                        </a>
                                                    @endif
                                                @endif
                                                <script type="text/template" id="header_cart_template"> <% _.each(cart_details.products, function(product, key){%> <% _.each(product.vendor_products, function(vendor_product, vp){%> <li id="cart_product_<%=vendor_product.id %>" data-qty="<%=vendor_product.quantity %>"> <a class='media' href='<%=show_cart_url %>'> <% if(vendor_product.pvariant.media_one){%> <img class='mr-2 blur-up lazyload' data-src="<%=vendor_product.pvariant.media_one.pimage.image.path.proxy_url %>200/200<%=vendor_product.pvariant.media_one.pimage.image.path.image_path %>"> <%}else if(vendor_product.pvariant.media_second && vendor_product.pvariant.media_second.image != null){%> <img class='mr-2 blur-up lazyload' data-src="<%=vendor_product.pvariant.media_second.image.path.proxy_url %>200/200<%=vendor_product.pvariant.media_second.image.path.image_path %>"> <%}else{%> <img class='mr-2 blur-up lazyload' data-src="<%=vendor_product.image_url %>"> <%}%> <div class='media-body'> <h4><%=vendor_product.product.translation_one ? vendor_product.product.translation_one.title : vendor_product.product.sku %></h4> <h4> <span><%=vendor_product.quantity %> x <%=Helper.formatPrice(vendor_product.pvariant.price * vendor_product.pvariant.multiplier) %></span> </h4> </div></a> <div class='close-circle'> <a href="javascript::void(0);" data-product="<%=vendor_product.id %>" class='remove-product'> <i class='fa fa-times' aria-hidden='true'></i> </a> </div></li><%}); %> <%}); %> <li><div class='total'><h5>{{__('Subtotal')}}: <span id='totalCart'>{{Session::get('currencySymbol')}}<%=Helper.formatPrice(cart_details.gross_amount) %></span></h5></div></li><li><div class='buttons'><a href="<%=show_cart_url %>" class='view-cart'>{{__('View Cart')}}</a> </script>
                                                <ul class="show-div shopping-cart " id="header_cart_main_ul"></ul>
                                            </li>
                                            <li class="mobile-menu-btn d-none">
                                                <div class="toggle-nav p-0 d-inline-block"><i
                                                        class="fa fa-bars sidebar-bar"></i></div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="icon-nav d-sm-none d-none">
                                        <ul>
                                            <li class="onhover-div mobile-search">
                                                <a href="javascript:void(0);" id="mobile_search_box_btn"><i
                                                        class="ti-search"></i></a>
                                                <div id="search-overlay" class="search-overlay">
                                                    <div>
                                                        <span class="closebtn" onclick="closeSearch()"
                                                            title="Close Overlay">×</span>
                                                        <div class="overlay-content">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-xl-12">
                                                                        <form>
                                                                            <div class="form-group"> <input
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    placeholder="Search a Product">
                                                                            </div>
                                                                            <button type="submit"
                                                                                class="btn btn-primary"><i
                                                                                    class="fa fa-search"></i></button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="onhover-div mobile-setting">
                                                <div data-toggle="modal" data-target="#staticBackdrop"><i
                                                        class="ti-settings"></i></div>
                                                <div class="show-div setting">
                                                    <h6>language</h6>
                                                    <ul>
                                                        <li><a href="#">english</a></li>
                                                        <li><a href="#">french</a></li>
                                                    </ul>
                                                    <h6>currency</h6>
                                                    <ul class="list-inline">
                                                        <li><a href="#">euro</a></li>
                                                        <li><a href="#">rupees</a></li>
                                                        <li><a href="#">pound</a></li>
                                                        <li><a href="#">doller</a></li>
                                                    </ul>
                                                    <h6>Change Theme</h6>
                                                    @if ($client_preference_detail->show_dark_mode == 1)
                                                        <ul class="list-inline">
                                                            <li><a class="theme-layout-version"
                                                                    href="javascript:void(0)">Dark</a></li>
                                                        </ul>
                                                    @endif
                                                </div>
                                            </li>
                                        </ul>

                                        <div class="ipad-view order-lg-3">
                                            <div
                                                class="search_bar menu-right d-sm-flex d-block align-items-center justify-content-end w-100">
                                                @if (Session::get('preferences'))
                                                    @if (isset(Session::get('preferences')->is_hyperlocal) && Session::get('preferences')->is_hyperlocal == 1)
                                                        <div class="location-bar d-none align-items-center justify-content-start ml-md-2 my-2 my-lg-0 dropdown-toggle"
                                                            href="#edit-address" data-toggle="modal">
                                                            <div class="map-icon mr-md-1"><i class="fa fa-map-marker"
                                                                    aria-hidden="true"></i></div>
                                                            <div class="homepage-address text-left">
                                                                <h2><span data-placement="top" data-toggle="tooltip"
                                                                        title="{{ session('selectedAddress') }}">{{ session('selectedAddress') }}</span>
                                                                </h2>
                                                            </div>
                                                            <div class="down-icon"> <i class="fa fa-angle-down"
                                                                    aria-hidden="true"></i> </div>
                                                        </div>
                                                    @endif
                                                @endif
                                                <div class="radius-bar d-xl-inline al_custom_search">
                                                    <div
                                                        class="search_form d-flex align-items-center justify-content-between">
                                                        <button class="btn"><i class="fa fa-search"
                                                                aria-hidden="true"></i></button> @php
                                                                    $searchPlaceholder = getNomenclatureName('Search product, vendor, item', true);
                                                                    $searchPlaceholder = $searchPlaceholder === 'Search product, vendor, item' ? __('Search product, vendor, item') : $searchPlaceholder;
                                                                @endphp
                                                        <input class="form-control border-0 typeahead" type="search"
                                                            placeholder="{{ $searchPlaceholder }}"
                                                            id="main_search_box" autocomplete="off"> </div>
                                                    <div class="list-box style-4" style="display:none;"
                                                        id="search_box_main_div"> </div>
                                                </div>
                                                @include('layouts.store.search_template')
                                                @if (auth()->user())
                                                    @if ($client_preference_detail->show_wishlist == 1)
                                                        <div class="icon-nav mx-2 d-none d-sm-block"> <a
                                                                class="fav-button"
                                                                href="{{ route('user.wishlists') }}"> <i
                                                                    class="fa fa-heart" aria-hidden="true"></i> </a>
                                                        </div>
                                                    @endif
                                                @endif
                                                <div class="icon-nav d-none d-sm-inline-block">
                                                    <form name="filterData" id="filterData"
                                                        action="{{ route('changePrimaryData') }}"> @csrf <input
                                                            type="hidden" id="cliLang" name="cliLang"
                                                            value="{{ session('customerLanguage') }}"> <input
                                                            type="hidden" id="cliCur" name="cliCur"
                                                            value="{{ session('customerCurrency') }}"> </form>
                                                    <ul class="d-flex align-items-center">
                                                        <li class="mr-2 pl-0 d-ipad"> <span
                                                                class="mobile-search-btn"><i class="fa fa-search"
                                                                    aria-hidden="true"></i></span> </li>
                                                        <li class="onhover-div pl-0 shake-effect">
                                                            @if ($client_preference_detail)
                                                                @if ($client_preference_detail->cart_enable == 1)
                                                                    <a class="btn btn-solid d-flex align-items-center "
                                                                        href="{{ route('showCart') }}">
                                                                        <span class="mr-1"><svg width="24px"
                                                                                height="24px" viewBox="0 0 24 24"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M15 19C15 20.1046 15.8954 21 17 21C18.1046 21 19 20.1046 19 19C19 17.8954 18.1046 17 17 17H7.36729C6.86964 17 6.44772 16.6341 6.37735 16.1414M18 14H6.07143L4.5 3H2M9 5H21L19 11M11 19C11 20.1046 10.1046 21 9 21C7.89543 21 7 20.1046 7 19C7 17.8954 7.89543 17 9 17C10.1046 17 11 17.8954 11 19Z"
                                                                                    stroke="#001A72"
                                                                                    stroke-width="1.5"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round" />
                                                                            </svg>
                                                                        </span>

                                                                        <span id="cart_qty_span">
                                                                        </span>
                                                                    </a>
                                                                @endif
                                                            @endif
                                                            <script type="text/template" id="header_cart_template">
                                                          <% _.each(cart_details.products, function(product, key){%> <% _.each(product.vendor_products, function(vendor_product, vp){%> <li id="cart_product_<%=vendor_product.id %>" data-qty="<%=vendor_product.quantity %>"> <a class='media' href='<%=show_cart_url %>'> <% if(vendor_product.pvariant.media_one){%> <img class='mr-2 blur-up lazyload' data-src="<%=vendor_product.pvariant.media_one.pimage.image.path.proxy_url %>200/200<%=vendor_product.pvariant.media_one.pimage.image.path.image_path %>"> <%}else if(vendor_product.pvariant.media_second && vendor_product.pvariant.media_second.image != null){%> <img class='mr-2 blur-up lazyload' data-src="<%=vendor_product.pvariant.media_second.image.path.proxy_url %>200/200<%=vendor_product.pvariant.media_second.image.path.image_path %>"> <%}else{%> <img class='mr-2 blur-up lazyload' data-src="<%=vendor_product.image_url %>"> <%}%> <div class='media-body'> <h4><%=vendor_product.product.translation_one ? vendor_product.product.translation_one.title : vendor_product.product.sku %></h4> <h4> <span><%=vendor_product.quantity %> x <%=Helper.formatPrice(vendor_product.pvariant.price) %></span> </h4> </div></a> <div class='close-circle'> <a href="javascript::void(0);" data-product="<%=vendor_product.id %>" class='remove-product'> <i class='fa fa-times' aria-hidden='true'></i> </a> </div></li><%}); %> <%}); %> <li><div class='total'><h5>{{ __('Subtotal') }}: <span id='totalCart'>{{ Session::get('currencySymbol') }}<%=Helper.formatPrice(cart_details.gross_amount) %></span></h5></div></li><li><div class='buttons'><a href="<%=show_cart_url %>" class='view-cart'>{{ __('View Cart') }}</a>
                                                      </script>
                                                            <ul class="show-div shopping-cart "
                                                                id="header_cart_main_ul"></ul>
                                                        </li>
                                                        <li class="mobile-menu-btn d-none">
                                                            <div class="toggle-nav p-0 d-inline-block"><i
                                                                    class="fa fa-bars sidebar-bar"></i></div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="icon-nav d-sm-none d-none">
                                                    <ul>
                                                        <li class="onhover-div mobile-search">
                                                            <a href="javascript:void(0);"
                                                                id="mobile_search_box_btn"><i
                                                                    class="ti-search"></i></a>
                                                            <div id="search-overlay" class="search-overlay">
                                                                <div>
                                                                    <span class="closebtn" onclick="closeSearch()"
                                                                        title="Close Overlay">×</span>
                                                                    <div class="overlay-content">
                                                                        <div class="container">
                                                                            <div class="row">
                                                                                <div class="col-xl-12">
                                                                                    <form>
                                                                                        <div class="form-group"> <input
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                placeholder="Search a Product">
                                                                                        </div>
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary"><i
                                                                                                class="fa fa-search"></i></button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="onhover-div mobile-setting">
                                                            <div data-toggle="modal" data-target="#staticBackdrop"><i
                                                                    class="ti-settings"></i></div>
                                                            <div class="show-div setting">
                                                                <h6>language</h6>
                                                                <ul>
                                                                    <li><a href="#">english</a></li>
                                                                    <li><a href="#">french</a></li>
                                                                </ul>
                                                                <h6>currency</h6>
                                                                <ul class="list-inline">
                                                                    <li><a href="#">euro</a></li>
                                                                    <li><a href="#">rupees</a></li>
                                                                    <li><a href="#">pound</a></li>
                                                                    <li><a href="#">doller</a></li>
                                                                </ul>
                                                                <h6>Change Theme</h6>
                                                                @if ($client_preference_detail->show_dark_mode == 1)
                                                                    <ul class="list-inline">
                                                                        <li><a class="theme-layout-version"
                                                                                href="javascript:void(0)">Dark</a></li>
                                                                    </ul>
                                                                @endif
                                                            </div>
                                                        </li>
                                                        <li class="onhover-div mobile-cart">
                                                            <a href="{{ route('showCart') }}"
                                                                style="position: relative"> <i
                                                                    class="ti-shopping-cart"></i> <span
                                                                    class="cart_qty_cls" style="display:none"></span>
                                                            </a>{{-- <span class="cart_qty_cls" style="display:none"></span> --}}
                                                            <ul class="show-div shopping-cart"> </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <li class="onhover-div pl-0 shake-effect">
                                @if ($client_preference_detail)
                                    @if ($client_preference_detail->cart_enable == 1)
                                        <a class="btn btn-solid d-flex align-items-center p-0"
                                            href="{{ route('showCart') }}">
                                            <span class="mr-1 icon-icLang align-middle">
                                                {{-- <svg version="1.0"
 width="18" height="18" viewBox="0 0 519.000000 456.000000"
 preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,456.000000) scale(0.100000,-0.100000)">
<path d="M43 4515 l-45 -45 4 -70 c3 -66 6 -73 41 -108 l37 -37 428 -3 427 -3
59 -267 c32 -147 109 -499 171 -782 63 -283 155 -702 204 -930 50 -228 96
-423 101 -432 16 -29 12 -44 -16 -57 -46 -20 -116 -84 -161 -144 -101 -138
-112 -349 -26 -503 33 -59 112 -138 166 -165 94 -49 144 -59 281 -59 l130 0
-69 -34 c-105 -50 -195 -154 -236 -274 -26 -76 -26 -218 0 -294 47 -138 151
-242 288 -289 77 -26 219 -26 295 0 122 42 228 134 279 244 33 69 34 76 34
192 0 115 -1 123 -33 190 -45 95 -134 186 -227 231 l-69 34 944 0 944 0 -69
-34 c-50 -24 -88 -52 -132 -99 -97 -102 -133 -189 -133 -322 0 -163 68 -288
208 -381 80 -54 150 -74 257 -74 174 0 305 73 399 223 58 93 75 269 37 379
-41 120 -131 224 -236 274 l-69 34 114 0 c96 0 120 3 144 19 48 32 66 69 66
136 0 65 -17 102 -61 133 -22 16 -130 17 -1449 22 l-1425 5 -41 23 c-50 29
-74 68 -74 120 0 48 32 98 80 126 35 21 43 21 1456 24 l1421 2 40 34 c31 27
44 48 58 98 11 35 22 65 25 68 4 3 23 66 44 140 21 74 98 347 171 605 349
1229 365 1288 365 1337 0 55 -15 91 -55 128 l-27 25 -1888 3 c-1786 2 -1889 3
-1894 20 -3 9 -28 119 -55 243 -28 124 -55 237 -60 251 -5 14 -27 39 -48 57
l-38 31 -519 0 -519 0 -44 -45z m4777 -880 c0 -3 -29 -108 -64 -233 -36 -125
-103 -364 -151 -532 -47 -168 -90 -314 -95 -325 -6 -11 -54 -175 -108 -365
l-99 -345 -1249 -3 -1249 -2 -114 517 c-62 285 -117 523 -121 528 -4 6 -22 78
-40 160 -17 83 -54 250 -81 372 -27 123 -49 225 -49 228 0 3 770 5 1710 5 941
0 1710 -2 1710 -5z m-2749 -3084 c35 -34 39 -44 39 -87 0 -86 -55 -144 -135
-144 -75 0 -135 59 -135 133 0 82 58 137 144 137 43 0 53 -4 87 -39z m2130 16
c42 -28 59 -60 59 -112 0 -76 -59 -135 -135 -135 -80 0 -135 58 -135 144 0 43
4 53 39 87 35 35 44 39 88 39 36 0 60 -7 84 -23z"/>
</g>
</svg> --}}
                                                <svg width="22" height="21" viewBox="0 0 22 21"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.28562 20C8.78531 20 9.19038 19.5949 9.19038 19.0953C9.19038 18.5956 8.78531 18.1905 8.28562 18.1905C7.78594 18.1905 7.38086 18.5956 7.38086 19.0953C7.38086 19.5949 7.78594 20 8.28562 20Z"
                                                        stroke="#4D4D4D" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M18.2387 20C18.7384 20 19.1435 19.5949 19.1435 19.0953C19.1435 18.5956 18.7384 18.1905 18.2387 18.1905C17.7391 18.1905 17.334 18.5956 17.334 19.0953C17.334 19.5949 17.7391 20 18.2387 20Z"
                                                        stroke="#4D4D4D" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M1.04785 1H4.6669L7.09166 13.1148C7.1744 13.5313 7.40101 13.9055 7.73182 14.1718C8.06264 14.4381 8.47658 14.5796 8.90119 14.5714H17.6955C18.1201 14.5796 18.534 14.4381 18.8648 14.1718C19.1956 13.9055 19.4223 13.5313 19.505 13.1148L20.9526 5.52381H5.57166"
                                                        stroke="#4D4D4D" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>

                                            </span>

                                            <span>{{ __('Cart') }}</span>
                                            <span id="cart_qty_span">{{ __('0') }}</span>
                                        </a>
                                    @endif
                                @endif
                                <script type="text/template" id="header_cart_template"> <% _.each(cart_details.products, function(product, key){%> <% _.each(product.vendor_products, function(vendor_product, vp){%> <li id="cart_product_<%=vendor_product.id %>" data-qty="<%=vendor_product.quantity %>"> <a class='media' href='<%=show_cart_url %>'> <% if(vendor_product.pvariant.media_one){%> <img class='mr-2 blur-up lazyload' data-src="<%=vendor_product.pvariant.media_one.pimage.image.path.proxy_url %>200/200<%=vendor_product.pvariant.media_one.pimage.image.path.image_path %>"> <%}else if(vendor_product.pvariant.media_second && vendor_product.pvariant.media_second.image != null){%> <img class='mr-2 blur-up lazyload' data-src="<%=vendor_product.pvariant.media_second.image.path.proxy_url %>200/200<%=vendor_product.pvariant.media_second.image.path.image_path %>"> <%}else{%> <img class='mr-2 blur-up lazyload' data-src="<%=vendor_product.image_url %>"> <%}%> <div class='media-body'> <h4><%=vendor_product.product.translation_one ? vendor_product.product.translation_one.title : vendor_product.product.sku %></h4> <h4> <span><%=vendor_product.quantity %> x <%=Helper.formatPrice(vendor_product.pvariant.price * vendor_product.pvariant.multiplier) %></span> </h4> </div></a> <div class='close-circle'> <a href="javascript::void(0);" data-product="<%=vendor_product.id %>" class='remove-product'> <i class='fa fa-times' aria-hidden='true'></i> </a> </div></li><%}); %> <%}); %> <li><div class='total'><h5>{{__('Subtotal')}}: <span id='totalCart'>{{Session::get('currencySymbol')}}<%=Helper.formatPrice(cart_details.gross_amount) %></span></h5></div></li><li><div class='buttons'><a href="<%=show_cart_url %>" class='view-cart'>{{__('View Cart')}}</a> </script>
                                <ul class="show-div shopping-cart " id="header_cart_main_ul"></ul>
                            </li>
                        </ul>
                    </div>



                </div>
            </div>
        </nav>


        {{-- <div class="mobile-menu main-menu position-fixed d-none">
        <div class="menu-right_">
            <ul class="header-dropdown icon-nav d-flex justify-content-around">
                <li class="onhover-div mobile-setting">
                    <div data-toggle="modal" data-target="#setting_modal"><i class="ti-settings"></i></div>
                </li>

                <li class="onhover-dropdown mobile-account  d-inline d-sm-none"> <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="alAccount">{{__('My Account')}}</span>
                    <ul class="onhover-show-div">
                        @if (Auth::user())
                            @if (Auth::user()->is_superadmin == 1 || Auth::user()->is_admin == 1)
                                <li>
                                    <a href="{{route('client.dashboard')}}" data-lng="en">{{__('Control Panel')}}</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{route('user.profile')}}" data-lng="en">{{__('Profile')}}</a>
                            </li>
                            <li>
                                <a href="{{route('user.logout')}}" data-lng="es">{{__('Logout')}}</a>
                            </li>
                        @else
                        <li>
                            <a href="{{route('customer.login')}}" data-lng="en">{{__('Login')}}</a>
                        </li>
                        <li>
                            <a href="{{route('customer.register')}}" data-lng="es">{{__('Register')}}</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @if ($client_preference_detail->show_wishlist == 1)
                <li class="mobile-wishlist d-inline d-sm-none">
                    <a href="{{route('user.wishlists')}}">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                    </a>
                </li>
                @endif
                <li class="onhover-div al_mobile-search">
                    <a href="javascript:void(0);" id="mobile_search_box_btn" onClick="$('.search-overlay').css('display','block');"><i class="ti-search"></i></a>
                    <div id="search-overlay" class="search-overlay">
                        <div> <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
                        <div class="overlay-content w-100">
                            <form>
                                <div class="form-group m-0">
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Search a Product">
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        </div>
                    </div>
                </li>

                @if ($client_preference_detail->cart_enable == 1)
                <li class="onhover-div mobile-cart">
                    <a href="{{route('showCart')}}" style="position: relative">
                        <i class="ti-shopping-cart"></i>
                        <span class="cart_qty_cls" style="display:none"></span>
                    </a>
                    <ul class="show-div shopping-cart">
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div> --}}
    </div>
    <div class="al_mobile_menu al_new_mobile_header">

        <div class="al_new_cart">
            @if ($client_preference_detail->cart_enable == 1)
                <div class="onhover-dropdown_al onhover-div mobile-cart">
                    <a href="{{ route('showCart') }}" style="position: relative">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span class="cart_qty_cls" style="display:none"></span>
                    </a>
                    <ul class="show-div shopping-cart"></ul>
                </div>
            @endif
        </div>
        <a class="al_toggle-menu" href="javascript:void(0)">
            <i></i>
            <i></i>
            <i></i>
        </a>
        <div class="al_menu-drawer" data-spy="scroll" id="navbarsfoodTemplate">
            <ul class="header-dropdown ml-auto">
                <li class="onhover-dropdown_al mobile-account_al">
                    <ul class="onhover-show-div font-weight-bold">
                        @if (Auth::user())
                            @if (Auth::user()->is_superadmin == 1 || Auth::user()->is_admin == 1)
                                <li>
                                    <a href="{{ route('client.dashboard') }}"
                                        data-lng="en">{{ __('Control Panel') }}</a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ route('user.profile') }}" data-lng="en">{{ __('Profile') }}</a>
                            </li>

                            <li class="onhover-show-div">
                                <a href="javascript:void(0)" id="show-btn">
                                    <span class="">{{ __('Categories') }}</span>
                                </a>
                                @foreach ($navCategories as $cate)
                                    <ul class="cat-itmes">

                                        <a href="javascript:void(0)"
                                            class="text-muted sub-list">{{ $cate['name'] }}
                                            @if(!empty($cate['children']))
                                                 <i class="fa fa-caret-down"></i>
                                            @endif
                                        </a>

                                        @if(!empty($cate['children']))
                     <ul class="al_main_category_lists">
                        @foreach($cate['children'] as $childs)
                        <li>
                           <a href="{{route('categoryDetail', $childs['slug'])}}"><span class="new-tag">{{$childs['name']}}</span></a>
                           @if(!empty($childs['children']))
                           <ul class="al_main_category_sub_list">
                              @foreach($childs['children'] as $chld)
                              <li><a href="{{route('categoryDetail', $chld['slug'])}}">{{$chld['name']}}</a></li>
                              @endforeach
                           </ul>
                           @endif
                        </li>
                        @endforeach
                     </ul>
                     @endif
                                    </ul>
                                @endforeach
                            </li>
                            <li>
                                <a href="{{ route('user.logout') }}" data-lng="es">{{ __('Logout') }}</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('customer.login') }}" data-lng="en">{{ __('Login') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('customer.register') }}" data-lng="es">{{ __('Register') }}</a>
                            </li>
                        @endif
                    </ul>
                </li>
                @if ($client_preference_detail->show_wishlist == 1)
                    <li class="onhover-dropdown_al mobile-wishlist_al">
                        <a href="{{ route('user.wishlists') }}">
                            {{ __('Wishlists') }}
                        </a>
                    </li>
                @endif

                @if ($client_preference_detail->cart_enable == 1)
                    <li class="onhover-dropdown_al onhover-div mobile-cart">
                        <a href="{{ route('showCart') }}" style="position: relative">
                            {{ __('Viewcart') }}
                            <span class="cart_qty_cls" style="display:none"></span>
                        </a>
                        <ul class="show-div shopping-cart"></ul>
                    </li>
                @endif

                @if ($client_preference_detail->header_quick_link == 1)
                    @foreach ($pages as $page)
                        @if (isset($page->primary->type_of_form) && $page->primary->type_of_form == 2)
                            @if (isset($last_mile_common_set) && $last_mile_common_set != false)
                                <li class="onhover-dropdown_al">
                                    <a href="{{ route('extrapage', ['slug' => $page->slug]) }}">
                                        @if (isset($page->translations) && $page->translations->first()->title != null)
                                            {{ $page->translations->first()->title ?? '' }}
                                        @else
                                            {{ $page->primary->title ?? '' }}
                                        @endif
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="onhover-dropdown_al">
                                <a href="{{ route('extrapage', ['slug' => $page->slug]) }}" target="_blank">
                                    @if (isset($page->translations) && $page->translations->first()->title != null)
                                        {{ $page->translations->first()->title ?? '' }}
                                    @else
                                        {{ $page->primary->title ?? '' }}
                                    @endif
                                </a>
                            </li>
                        @endif
                    @endforeach

                @endif
                <li class="onhover-dropdown change-language">
                    <a href="javascript:void(0)">
                        <!-- <span class="alLanguageSign">{{ $applocale }}</span> -->
                        <span class="icon-icLang align-middle"><svg width="18" height="16"
                                viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M6.59803 0H15.3954C16.3301 0 17.0449 0.714786 17.0449 1.64951V7.6977C17.0449 8.63242 16.3301 9.3472 15.3954 9.3472H9.3472V13.1961H5.66331L2.19934 16.0002V13.1961H1.64951C0.714786 13.1961 0 12.4813 0 11.5465V5.49836C0 4.56364 0.714786 3.84885 1.64951 3.84885H8.79737V2.74918H6.59803V0ZM5.66331 10.062L5.93822 10.9417H7.25783L5.44337 6.04819H4.12377L2.30931 10.9417H3.62891L3.95882 10.062H5.66331ZM12.1514 7.14786C12.8112 7.47776 13.5809 7.6977 14.2957 7.6977V6.59803C13.9658 6.59803 13.6359 6.54304 13.251 6.43308C14.0758 5.60832 14.5157 4.45367 14.4607 3.29901L14.4057 2.74918H12.5912V1.64951H11.4916V2.74918H9.84206V3.84885H13.1411C13.0861 4.6736 12.7012 5.38839 12.0964 5.88324C11.7115 5.55334 11.3816 5.16845 11.2166 4.6736H10.062C10.2269 5.33341 10.5568 5.93822 11.0517 6.43308C10.6668 6.54304 10.2819 6.59803 9.89704 6.59803L9.95202 7.6977C10.7218 7.64271 11.4916 7.47776 12.1514 7.14786ZM4.23384 9.12727L4.78368 7.42278L5.33351 9.12727H4.23384Z"
                                    fill="#777777" />
                            </svg></span>
                        <span class="language ml-1 align-middle">{{ __('language') }}</span>
                    </a>
                    <ul class="onhover-show-div">
                        @foreach ($languageList as $key => $listl)
                            <li class="{{ $applocale == $listl->language->sort_code ? 'active' : '' }}">
                                <a href="javascript:void(0)" class="customerLang"
                                    langId="{{ $listl->language_id }}">{{ $listl->language->name }}
                                    @if ($listl->language->id != 1)
                                        ({{ $listl->language->nativeName }})
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="onhover-dropdown change-currency">
                    <a href="javascript:void(0)">
                        <span class="icon-icCurrency align-middle"><svg width="17" height="17"
                                viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M9.39724 0.142578H1.69458C1.26547 0.142578 0.917597 0.490456 0.917597 0.919564V2.05797C0.917597 2.48705 1.26547 2.83496 1.69458 2.83496H9.39724C9.82635 2.83496 10.1742 2.48708 10.1742 2.05797V0.919564C10.1742 0.490456 9.82638 0.142578 9.39724 0.142578ZM1.08326 4.57899H8.78588C9.21502 4.57899 9.56287 4.92687 9.5629 5.35598V5.94463C8.76654 6.24743 8.08369 6.70273 7.51822 7.2682L7.51514 7.27137H1.08326C0.654151 7.27137 0.306273 6.92349 0.306273 6.49439V5.35598C0.306273 4.92687 0.654151 4.57899 1.08326 4.57899ZM6.31719 9.0156H2.18655C1.75744 9.0156 1.40956 9.36347 1.40956 9.79258V10.931C1.40956 11.3601 1.75744 11.708 2.18655 11.708H5.8268C5.77784 10.8364 5.91763 9.95693 6.2739 9.11453C6.28796 9.08133 6.30256 9.04848 6.31719 9.0156ZM6.20036 13.452H0.776986C0.347878 13.452 0 13.7999 0 14.229V15.3674C0 15.7965 0.347878 16.1444 0.776986 16.1444H8.3093C7.38347 15.4994 6.63238 14.5788 6.20036 13.452ZM6.85635 11.3741C6.85635 8.74051 8.99127 6.60557 11.6249 6.60557C14.2584 6.60557 16.3933 8.74048 16.3934 11.3741C16.3934 14.0077 14.2585 16.1426 11.6249 16.1426C8.99127 16.1426 6.85635 14.0076 6.85635 11.3741Z"
                                    fill="#777777" />
                            </svg></span>
                        <span class="currency ml-1 align-middle">{{ __('Currency') }}</span>
                    </a>
                    <ul class="onhover-show-div">
                        @foreach ($currencyList as $key => $listc)
                            <li
                                class="{{ session()->get('iso_code') == $listc->currency->iso_code ? 'active' : '' }}">
                                <a href="javascript:void(0)" currId="{{ $listc->currency_id }}" class="customerCurr"
                                    currSymbol="{{ $listc->currency->symbol }}">
                                    {{ $listc->currency->iso_code }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <script src="{{asset('assets/js/jquery-3.1.1.min.js')}}"></script>
    <script>
        $(document).ready(function() {
    $('.cat-itmes').hide();
    $('.al_main_category_lists').hide();

    $('#show-btn').click(function() {
        if ($('.cat-itmes').is(':hidden')) {
            $('.cat-itmes').show();
        } else {
            $('.cat-itmes').hide();
        }
    });

    $('.sub-list').click(function() {
        var mainCategoryList = $(this).next('.al_main_category_lists');
        if (mainCategoryList.is(':hidden')) {
            mainCategoryList.show();
        } else {
            mainCategoryList.hide();
        }
    });
});

    </script>
