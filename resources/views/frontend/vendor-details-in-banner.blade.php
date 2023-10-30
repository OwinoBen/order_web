<div class="vendor-design_new">
<div class="container">
<div class="row align-items-center">
        <div class="col-12 product-bottom-bar vendor-description pb-2">
            <div class="row vendor-details-left align-items-center">
                <div class="col-sm-2 col-lg-1 vender-icon">
                    <div class="vendor-stories">
                        <div class="circle-wrapper"></div>
                        <a href="" data-toggle="modal" data-target="#vendorStories_">
                            <img id="vendorStoriesImg" src="{{ $vendor->logo['image_fit'] . '120/120' . $vendor->logo['image_path'] }}" class="rounded-circle avatar-sm avatar-lg" alt="profile-image">
                        </a>
                    </div>                   
                    {{-- <!-- <img src="{{ $vendor->logo['image_fit'] . '120/120' . $vendor->logo['image_path'] }}" class="rounded-circle avatar-lg" alt="profile-image"> --> --}}
                </div>
                <div class="col-sm-10 col-lg-11 position-relative profile_address vendor_icon-design">
                            <h3>{{ $vendor->name }}</h3>
                            <div class="vendor-reviwes">
                        @if ($vendor->vendorRating > 0 && $client_preference_detail->rating_check == 1) 
                            <div class="rating-text-box ml-sm-auto p-1">
                                <span>{{ $vendor->vendorRating }}</span>
                                <i class="fa fa-star" aria-hidden="true"></i>
                             
                            </div>
                        @endif
                    </div>
                                <ul class="vendor-info customize_vendor"> <li class="d-block vendor-location">
                                        <a href="javascript:void(0)" onclick="copyToClipboard('#p1')" >
                                            <img src="{{ asset('assets/icons/domain_copy_icon.svg')}}" alt="">
                                            <span class="copied_txt" id="show_copy_msg_on_click_copy">{{ __('Copy') }}</span>
                                            <span class="copied_txt" id="show_copy_msg_on_click_copied" style="display:none;">{{ __('Copied') }}</span>
                                        </a>
                                        <span id="p1" style="display:none;">{{url()->current()}}</span>
                                    </li>
                                </ul>
                                    @if (!empty($vendor->desc))
                                        <h4 title="{{ $vendor->desc }}" style="line-height: 24px">
                                        {{--
                                        <svg width="29px" height="40px" viewBox="0 0 29 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>location</title>
                                        <g id="design-update" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="location" fill="#FFFFFF" fill-rule="nonzero">
                                        <g id="Group" transform="translate(14.444444, 20.000000) scale(-1, 1) rotate(-180.000000) translate(-14.444444, -20.000000) ">
                                        <path d="M12.1881488,39.8490462 C8.99166591,39.3022058 6.44847876,37.9897886 4.21638484,35.7477427 C1.61875637,33.1463445 0.218836839,29.9199857 0.0166262395,26.0999144 C-0.138920375,23.217284 0.794359313,19.8424971 2.92534794,15.6005774 C4.75302066,11.9679943 7.08621988,8.3744712 10.2515935,4.3044157 C11.9159423,2.16392586 13.3936351,0.414036356 13.7358377,0.187488161 C14.1013722,-0.0624960537 14.7857773,-0.0624960537 15.1513119,0.187488161 C15.6801703,0.539028463 18.9388719,4.58564794 20.7820993,7.15579815 C24.9429713,12.9835552 27.735033,18.4988319 28.5516527,22.5298274 C28.839414,23.9438006 28.9327419,24.9827975 28.8705233,26.0999144 C28.6683127,29.9199857 27.2683931,33.1463445 24.6707647,35.7477427 C22.3997841,38.0366607 19.7477143,39.3725138 16.4967901,39.8802943 C15.4079638,40.0521584 13.2691978,40.0365344 12.1881488,39.8490462 Z M16.7378873,37.1148439 C20.1132489,36.4039513 23.0064159,34.2947095 24.701874,31.2948989 C25.6818177,29.5606334 26.1951215,27.5998197 26.1951215,25.5296379 C26.1951215,21.6314466 23.807481,16.2255379 19.1644145,9.57752023 C17.4922884,7.19485818 14.6224534,3.48415499 14.4435748,3.48415499 C14.2646961,3.48415499 11.3948611,7.19485818 9.722735,9.57752023 C7.8250663,12.2960986 6.55736139,14.3740924 5.34409779,16.7645664 C2.8397973,21.7017547 2.17094685,25.1156016 3.05756256,28.4825765 C3.61753037,30.6152543 4.62858337,32.3573318 6.19960418,33.9119211 C8.07394088,35.7633667 10.3915854,36.9039197 13.0436552,37.271084 C13.8680523,37.3882641 15.8512716,37.3023321 16.7378873,37.1148439 Z" id="Shape"></path>
                                        <path d="M13.1214285,32.7323081 C11.5115211,32.4432639 9.8238403,31.435515 8.78167798,30.1309099 C8.17504618,29.3731452 7.57619172,28.1622842 7.35842646,27.2326554 C7.14066119,26.3342746 7.12510653,24.7796853 7.3195398,23.9516126 C7.98839024,21.1471022 9.98716424,19.1003564 12.732562,18.3972758 C13.5491817,18.1863516 15.3379678,18.1863516 16.1545875,18.3972758 C18.8999853,19.1003564 20.8987593,21.1471022 21.5676097,23.9516126 C21.762043,24.7796853 21.7464883,26.3342746 21.5287231,27.2326554 C21.3031805,28.1622842 20.7121033,29.3731452 20.1054715,30.1309099 C19.2188558,31.2402148 17.7800496,32.1932797 16.3879074,32.58388 C15.719057,32.7791802 13.8447203,32.8651122 13.1214285,32.7323081 Z M15.2679718,30.0762258 C16.6990007,29.8106176 17.9589282,28.8341168 18.5966694,27.4748276 C18.9466493,26.740499 19.0633092,26.1155384 19.0088679,25.2171577 C18.9388719,23.9984846 18.4800094,23.0141718 17.5700617,22.139227 C16.8156606,21.4205224 15.4701824,20.8658699 14.4435748,20.8658699 C13.4169671,20.8658699 12.0714889,21.4205224 11.3170878,22.139227 C10.4071401,23.0141718 9.94827759,23.9984846 9.87828161,25.2171577 C9.8238403,26.1155384 9.94050026,26.740499 10.2904801,27.4748276 C11.2004278,29.3965813 13.2303112,30.4512022 15.2679718,30.0762258 Z" id="Shape"></path>
                                        </g>
                                        </g>
                                        </g>
                                        </svg>  --}}
                                        {{ $vendor->desc }}</h4>
                                    @endif
                                <p>{!! $vendor->short_desc !!}</p>
                                <ul class="vendor-info">

                                @if ($vendor->is_show_vendor_details == 1)
                                    <li class="d-block vendor-location">
                                        <i class="icon-location"></i> <p class="vendor_address">{{ $vendor->address }}</p>
                                    </li>
                                    @if ($vendor->email)
                                        <li class="d-block vendor-email">
                                            <i class="fa fa-envelope"></i> <span class="vendor_email">{{ $vendor->email }}</span>
                                        </li>
                                    @endif
                                    @if ($vendor->website)
                                        <li class="d-block vendor-website">
                                        <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M65.82 42.2969C66.0933 44.9764 66.25 47.5697 66.25 49.9969C66.25 54.5402 65.701 59.6707 64.861 64.8578C59.6738 65.6978 54.5433 66.2469 50 66.2469C45.4771 66.2469 40.3482 65.6993 35.1386 64.8564C34.2991 59.6693 33.75 54.5397 33.75 49.9969C33.75 47.5707 33.9066 44.9769 34.1804 42.2969C39.648 43.1721 45.1024 43.7469 50 43.7469C54.8981 43.7469 60.3524 43.1721 65.82 42.2969Z" fill="#ffffff"/>
<path d="M73.217 40.9461C73.5551 44.0818 73.7518 47.1346 73.7518 49.9965C73.7518 54.1723 73.3337 58.7532 72.668 63.4027C82.1089 61.4327 90.8351 58.9161 95.5099 57.4832C97.0204 57.0204 97.6142 56.8361 98.4104 56.5175C98.8084 56.3585 99.1732 56.1965 99.6489 55.9694C99.8818 54.0108 100.002 52.0175 100.002 49.9965C100.002 44.6537 99.1637 39.5067 97.6123 34.6797L97.208 34.8069C92.3199 36.2939 83.1694 38.9227 73.217 40.9461Z" fill="#ffffff"/>
<path d="M94.7711 27.7124C89.8573 29.2015 81.3297 31.6214 72.1911 33.5054C70.0859 20.7113 66.3963 7.95059 64.6211 2.17188C77.8211 6.20183 88.7025 15.5466 94.7711 27.7124Z" fill="black"/>
<path d="M64.8182 34.8681C59.6449 35.7039 54.5306 36.25 50.0006 36.25C45.4706 36.25 40.3566 35.7039 35.1836 34.8681C37.1659 22.7621 40.7044 10.3955 42.5139 4.49205C42.9768 2.98124 43.1611 2.38781 43.4796 1.59133C43.6387 1.19343 43.8006 0.828476 44.0277 0.353047C45.9863 0.119905 47.9796 0 50.0006 0C52.112 0 54.1925 0.130857 56.2354 0.384905C56.2787 0.550667 56.3187 0.699 56.3582 0.839333C56.4754 1.25395 56.6587 1.83667 56.9663 2.81448L56.9987 2.91719C58.5411 7.82014 62.6287 21.4953 64.8182 34.8681Z" fill="#ffffff"/>
<path d="M27.8099 33.5054C29.9055 20.7676 33.571 8.07564 35.3427 2.29492L35.3804 2.17188C22.1801 6.20178 11.2988 15.5465 5.23047 27.7123C10.1439 29.2015 18.6714 31.6214 27.8099 33.5054Z" fill="black"/>
<path d="M2.38972 34.6797C0.838001 39.5068 0 44.6537 0 49.9966C0 52.0866 0.128238 54.1466 0.377286 56.1694L1.16529 56.4323L1.17157 56.4342L1.17929 56.4371L1.18471 56.4385C1.43833 56.5228 8.87167 58.9775 18.6609 61.4133C21.4231 62.1004 24.348 62.7794 27.3336 63.4018C26.6679 58.7528 26.25 54.1723 26.25 49.9966C26.25 47.1337 26.4464 44.0809 26.7844 40.9461C16.8299 38.9221 7.67705 36.2924 2.79033 34.8056L2.75633 34.7952L2.38972 34.6797Z" fill="#ffffff"/>
<path d="M49.9996 73.7479C54.1753 73.7479 58.7562 73.3298 63.4057 72.6641C61.4357 82.105 58.9191 90.8312 57.4862 95.5055C57.0234 97.0164 56.8391 97.6098 56.5205 98.4064C56.3615 98.8045 56.1996 99.1693 55.9724 99.645C54.0138 99.8779 52.0205 99.9979 49.9996 99.9979C47.9786 99.9979 45.9853 99.8779 44.0267 99.645C43.7996 99.1693 43.6377 98.8045 43.4786 98.4064C43.16 97.6103 42.9758 97.0164 42.5129 95.506C41.08 90.8317 38.5637 82.106 36.5938 72.666C41.2277 73.3293 45.8096 73.7479 49.9996 73.7479Z" fill="#ffffff"/>
<path d="M16.8506 68.692C10.6603 67.1515 5.38797 65.6043 2.17188 64.6172C7.01288 80.4743 19.5235 92.9848 35.3807 97.8258L35.3431 97.7029C33.7961 92.6553 30.8052 82.3386 28.6764 71.3229C24.5363 70.5224 20.5112 69.6024 16.8506 68.692Z" fill="black"/>
<path d="M97.7068 64.6548C92.6592 66.202 82.3416 69.1929 71.3254 71.3215C69.1968 82.3377 66.2059 92.6548 64.6587 97.7029L64.6211 97.8258C80.4782 92.9848 92.9887 80.4743 97.8297 64.6172L97.7068 64.6548Z" fill="black"/>
<path d="M0.523438 56.2969C0.696533 56.3193 0.837628 56.3431 0.884438 56.3535C0.925438 56.3635 0.989676 56.3807 1.01296 56.3869L1.06444 56.4016L1.09215 56.4102L1.12129 56.4193L1.14572 56.4269C1.13201 56.4226 0.854199 56.3531 0.523438 56.2969Z" fill="black"/>
</svg>

                                             {{ $vendor->website }}
                                        </li>
                                    @endif
                                @endif
                                
                                @if(isset($socialMediaUrls) && count($socialMediaUrls)>0)
                                    <li class="d-block vendor-instagram">
                                    <?xml version="1.0" encoding="UTF-8"?>
                                        <svg width="40px" height="40px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>globe</title>
                                            <g id="design-update" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g id="globe" fill="#FFFFFF" fill-rule="nonzero">
                                                    <g id="Group" transform="translate(20.000000, 20.000000) scale(-1, 1) rotate(-180.000000) translate(-20.000000, -20.000000) ">
                                                        <path d="M17.4989013,39.8909971 C10.2329215,38.9923312 4.05293227,34.1786078 1.32623663,27.3018602 C0.755896284,25.8796238 0.248058987,23.7853416 0.0761755945,22.1755575 C-0.0253918648,21.1987467 -0.0253918648,18.807514 0.0761755945,17.8307033 C0.857463743,10.4538286 5.71707603,4.10065149 12.7017921,1.32650899 C14.1237365,0.756051514 16.2175887,0.248109928 17.8270423,0.0761912378 C18.8036525,-0.0253970793 21.1943943,-0.0253970793 22.1710044,0.0761912378 C30.108892,0.920155718 36.8514088,6.50751316 39.1718346,14.1735239 C39.7499878,16.0724439 40,17.8307033 40,20.0031304 C40,21.6363579 39.9218712,22.5350238 39.6406075,23.9494458 C38.3280434,30.6073878 33.6950046,36.1400438 27.2962547,38.6797517 C25.8743103,39.2502092 23.780458,39.7581508 22.1710044,39.9300695 C21.147517,40.0394723 18.506763,40.0160288 17.4989013,39.8909971 Z M18.8270912,33.5690779 L18.8270912,29.5524322 L18.2254993,29.5836901 C16.8035549,29.6774639 14.4753162,29.9822289 13.3580741,30.2322924 C13.0299331,30.3026228 13.0143073,30.1854055 13.5221446,31.9905518 C13.9206016,33.4206027 14.553445,35.2726359 15.014405,36.3822929 L15.280043,36.9996373 L16.0535182,37.171556 C16.7644905,37.3278457 18.2176864,37.5544658 18.6552078,37.5779092 L18.8270912,37.5857237 L18.8270912,33.5690779 Z M23.0069828,37.3434746 C23.5226329,37.2575153 24.1164119,37.1481125 24.3351726,37.0934111 L24.7258167,36.9918228 L24.9836418,36.3744784 C25.4446018,35.2804504 26.0774452,33.4206027 26.4759021,31.9905518 C26.9837394,30.1854055 26.9681137,30.3026228 26.6399727,30.2322924 C25.5227306,29.9822289 23.1944919,29.6774639 21.7803604,29.5836901 L21.1709556,29.5524322 L21.1709556,33.5690779 L21.1709556,37.5935382 L21.6241027,37.5466513 C21.8663021,37.5232078 22.4913326,37.429434 23.0069828,37.3434746 Z M11.7876849,34.6396625 C11.5767371,33.9988747 11.256409,32.9361046 11.0767127,32.2718733 C10.8970165,31.607642 10.7329459,31.0371845 10.7016944,31.0059266 C10.6391914,30.9199672 7.56872894,31.9905518 7.34996826,32.170285 C7.22496216,32.2640588 9.13130524,33.9051008 10.1938571,34.6162191 C10.6704429,34.936613 12.0611358,35.757134 12.1627033,35.7883919 C12.1705161,35.7883919 11.9986327,35.2726359 11.7876849,34.6396625 Z M29.7260608,34.663106 C30.8823673,33.8972864 32.7808975,32.2796878 32.6480785,32.170285 C32.4293178,31.9905518 29.3588554,30.9199672 29.2963524,31.0059266 C29.2651008,31.0371845 29.1010303,31.607642 28.921334,32.2718733 C28.7416378,32.9361046 28.4213096,33.9988747 28.2103618,34.631848 L27.8275306,35.7883919 L28.4213096,35.4601835 C28.7494507,35.2804504 29.3432296,34.920984 29.7260608,34.663106 Z M6.72493774,29.7790523 C7.22496216,29.5680611 8.1781337,29.2085948 8.83441574,28.9819747 C9.49851067,28.7553546 10.068851,28.5443635 10.1079154,28.5131055 C10.1469798,28.4818476 10.1079154,27.989535 10.0141608,27.3721906 C9.70164559,25.3404243 9.45163338,22.8632322 9.45163338,21.7066883 L9.45163338,21.1753033 L5.93583671,21.1753033 L2.41222716,21.1753033 L2.45910445,21.6676159 C2.67786513,23.7618981 3.26383124,25.8405514 4.17793838,27.700399 C4.72484008,28.825685 5.62332145,30.2557359 5.74051467,30.208849 C5.78739196,30.1854055 6.22491333,29.9978579 6.72493774,29.7790523 Z M34.8278725,29.4742873 C36.2732555,27.2549733 37.2576786,24.4339439 37.5389423,21.6676159 L37.5858196,21.1753033 L34.0622101,21.1753033 L30.5464134,21.1753033 L30.5464134,21.7066883 C30.5464134,22.8632322 30.2964012,25.3404243 29.9838859,27.3721906 C29.8901314,27.989535 29.8510669,28.4818476 29.8901314,28.5131055 C29.9291958,28.5443635 30.507349,28.7631691 31.1714439,28.9897892 C31.8355388,29.2085948 32.8043361,29.5836901 33.3199863,29.8103102 C33.8356365,30.0369303 34.2731579,30.224478 34.2965965,30.2322924 C34.3200352,30.2322924 34.5622345,29.8962696 34.8278725,29.4742873 Z M13.2565067,27.7863584 C14.5612579,27.5050369 17.06138,27.1924574 17.9286098,27.1924574 C18.1551834,27.1924574 18.4520729,27.169014 18.5848918,27.1455705 L18.8270912,27.0986836 L18.8270912,24.1369934 L18.8270912,21.1753033 L15.3503589,21.1753033 L11.8736266,21.1753033 L11.8736266,21.6676159 C11.8736266,22.2458878 12.0689487,24.629306 12.1861419,25.5123429 C12.2955222,26.3719364 12.4986572,27.6769555 12.5377216,27.8019873 C12.576786,27.9192046 12.6080375,27.9192046 13.2565067,27.7863584 Z M27.5540798,27.2706023 C27.8275306,25.6686327 28.1244201,22.7460149 28.1244201,21.6676159 L28.1244201,21.1753033 L24.6476879,21.1753033 L21.1709556,21.1753033 L21.1709556,24.1369934 L21.1709556,27.0986836 L21.4131549,27.1455705 C21.5459739,27.169014 21.8428634,27.1924574 22.069437,27.1924574 C22.9522926,27.1924574 25.9133747,27.5753672 26.8743591,27.8176163 C27.405635,27.9504626 27.4446994,27.9192046 27.5540798,27.2706023 Z M9.45163338,18.3073869 C9.45163338,17.1430285 9.70164559,14.6658365 10.0141608,12.6340701 C10.1079154,12.0167257 10.1469798,11.5244131 10.1079154,11.4931552 C10.068851,11.4618972 9.49069779,11.2430916 8.82660286,11.0164715 C8.16250793,10.7898515 7.17808487,10.4225706 6.63899604,10.188136 C6.1077201,9.96151594 5.66238586,9.78178277 5.65457298,9.78959725 C5.38893501,10.1178057 4.54514381,11.5478566 4.17012549,12.3058617 C3.26383124,14.1735239 2.67786513,16.2443626 2.45910445,18.3464593 L2.41222716,18.8309575 L5.93583671,18.8309575 L9.45163338,18.8309575 L9.45163338,18.3073869 Z M18.8270912,15.8692673 L18.8270912,12.9153916 L18.5848918,12.8606902 C18.4520729,12.8372468 18.1551834,12.8138033 17.9286098,12.8138033 C17.0535671,12.8138033 15.0065921,12.5559253 13.4440158,12.2511603 C12.9986816,12.165201 12.6080375,12.1261285 12.576786,12.165201 C12.3970897,12.3683776 11.8814395,16.9320374 11.8736266,18.3464593 L11.8736266,18.8309575 L15.3503589,18.8309575 L18.8270912,18.8309575 L18.8270912,15.8692673 Z M28.1244201,18.3464593 C28.1166073,16.9320374 27.6009571,12.3683776 27.4212608,12.165201 C27.3900093,12.1261285 26.9993652,12.165201 26.554031,12.2511603 C24.9914547,12.5559253 22.9444797,12.8138033 22.069437,12.8138033 C21.8428634,12.8138033 21.5459739,12.8372468 21.4131549,12.8606902 L21.1709556,12.9153916 L21.1709556,15.8692673 L21.1709556,18.8309575 L24.6476879,18.8309575 L28.1244201,18.8309575 L28.1244201,18.3464593 Z M37.5389423,18.3464593 C37.3201816,16.2443626 36.7342155,14.1735239 35.8279213,12.3058617 C35.452903,11.5478566 34.6091118,10.1178057 34.3434738,9.78959725 C34.3356609,9.78178277 33.8903267,9.96151594 33.3590507,10.188136 C32.8199619,10.4225706 31.8355388,10.7898515 31.1714439,11.0164715 C30.507349,11.2430916 29.9291958,11.4618972 29.8901314,11.4931552 C29.8510669,11.5244131 29.8901314,12.0167257 29.9838859,12.6340701 C30.2964012,14.6658365 30.5464134,17.1430285 30.5464134,18.3073869 L30.5464134,18.8309575 L34.0622101,18.8309575 L37.5858196,18.8309575 L37.5389423,18.3464593 Z M18.8270912,6.43718279 L18.8270912,2.41272253 L18.3817569,2.45960945 C17.6942234,2.53775431 16.1003955,2.80344683 15.6628742,2.91284963 L15.2722301,3.01443795 L15.014405,3.63178234 C14.420626,5.06183326 13.233068,8.75027062 13.1080619,9.57079165 C13.0846233,9.70363791 13.1783779,9.74271034 13.9674789,9.89118557 C15.0065921,10.0943622 16.6707359,10.3131678 17.7723522,10.3913127 C18.2020606,10.4225706 18.6161434,10.4538286 18.6942722,10.461643 C18.8192783,10.4694575 18.8270912,10.2272085 18.8270912,6.43718279 Z M23.4366912,10.2662809 C24.4054885,10.1646926 25.9680648,9.92244351 26.6399727,9.77396828 C26.9681137,9.70363791 26.9837394,9.8208552 26.4759021,8.01570894 C26.0774452,6.58565802 25.4446018,4.72581037 24.9836418,3.63178234 L24.7258167,3.01443795 L24.3351726,2.91284963 C23.8976513,2.80344683 22.3038234,2.53775431 21.6241027,2.45960945 L21.1709556,2.41272253 L21.1709556,6.43718279 L21.1709556,10.4538286 L21.7803604,10.4225706 C22.1085014,10.3991272 22.858538,10.3287968 23.4366912,10.2662809 Z M11.1001514,7.64842811 C11.3032863,6.90605194 11.6314273,5.8198384 11.8267494,5.25719541 L12.1705161,4.21786878 L11.5767371,4.54607719 C10.7173202,5.01494635 9.68601983,5.71043559 8.82660286,6.41373933 C8.07656624,7.02326923 7.28746521,7.78908885 7.34996826,7.83597577 C7.51403877,7.97663652 10.529811,9.06285006 10.6548171,9.03159212 C10.6938815,9.02377763 10.8970165,8.39861876 11.1001514,7.64842811 Z M30.2338981,8.75808511 C31.0542507,8.4845781 32.5699497,7.90630614 32.6480785,7.83597577 C32.7105816,7.78908885 32.0074222,7.10141409 31.2105083,6.45281176 C30.3276527,5.72606457 29.3119781,5.03057532 28.4213096,4.54607719 L27.8275306,4.21786878 L28.1712974,5.25719541 C28.3666195,5.8198384 28.6791347,6.86697951 28.8744568,7.57809773 C29.2651008,9.01596314 29.2807266,9.06285006 29.319791,9.06285006 C29.3276039,9.06285006 29.7416866,8.9300038 30.2338981,8.75808511 Z" id="Shape"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg><a class="open-social-medialinks" href="javascript:void(0)">Social Media Links</a>
                                    </li>
                                @endif
                                @php
                                    $checkSlot = findSlot('', $vendor->id, '');
                                @endphp

                                <li class="vendor-timing">
                                                                                    <?xml version="1.0" encoding="UTF-8"?>
                                    <svg width="40px" height="40px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>clock</title>
                                        <g id="design-update" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="clock" fill="#FFFFFF" fill-rule="nonzero">
                                                <g id="Group" transform="translate(20.000000, 20.000000) scale(-1, 1) rotate(-180.000000) translate(-20.000000, -20.000000) translate(0.000000, 0.000000)">
                                                    <path d="M18.0039139,39.9761222 C17.1898239,39.8900174 15.7181996,39.6238752 14.888454,39.412527 C7.99217221,37.6278088 2.38747554,32.0309951 0.587084149,25.1191259 C0.0939334638,23.2013366 0.00782778865,22.4498763 5.15640758e-16,20.0311135 C5.15640758e-16,17.4010025 0.11741683,16.4773325 0.75146771,14.3012288 C2.66927593,7.65550176 8.18786693,2.30134716 14.888454,0.571422933 C16.81409,0.0782771141 17.5499022,0 20,0 C22.4500978,0 23.18591,0.0782771141 25.111546,0.571422933 C32.1722114,2.39527969 37.7847358,8.12516445 39.5146771,15.2953481 C39.9373777,17.0174446 40,17.6749724 40,20.0311135 C39.9921722,22.4498763 39.9060665,23.2013366 39.4129159,25.1191259 C37.6125245,32.0309951 32.0078278,37.6278088 25.111546,39.412527 C23.334638,39.8665342 22.4970646,39.9682945 20.3131115,39.9917776 C19.2172211,40.007433 18.1761252,39.9999225 18.0039139,39.9761222 Z M22.4266145,36.9389702 C25.4168297,36.4927906 28.3913894,35.2012182 30.6927593,33.3460506 C32.555773,31.8509577 34.3091977,29.6591985 35.334638,27.5613719 C36.5636008,25.0486765 37.0958904,22.7473294 37.0958904,19.991975 C37.0958904,18.3794664 36.9706458,17.3305531 36.5949119,15.8354602 C35.0919765,9.77681156 30.2152642,4.90014735 24.1565558,3.39722675 C22.6614481,3.02149661 21.6125245,2.89625322 20,2.89625322 C18.3874755,2.89625322 17.3385519,3.02149661 15.8434442,3.39722675 C9.78473581,4.90014735 4.90802348,9.77681156 3.40508806,15.8354602 C3.02935421,17.3305531 2.90410959,18.3794664 2.90410959,19.991975 C2.90410959,24.6886018 4.71232877,28.9468768 8.10958904,32.2579987 C9.02544031,33.1503578 9.53424658,33.5652265 10.6223092,34.2932037 C12.962818,35.8509183 15.7573386,36.8058991 18.8258317,37.0876967 C19.4833659,37.1503184 21.6046967,37.0563858 22.4266145,36.9389702 Z" id="Shape"></path>
                                                    <path d="M19.2563601,32.0857891 C19.2172211,32.0701337 19.0841487,32.0388228 18.9667319,32.0153397 C18.6614481,31.9448903 18.2778865,31.5926433 18.1135029,31.2247408 C17.9726027,30.9272878 17.964775,30.5593854 17.964775,24.7668789 C17.964775,18.958717 17.9726027,18.60647 18.1135029,18.309017 C18.2857143,17.9332868 18.5362035,17.6906278 18.9197652,17.5262459 C19.1780822,17.4244856 19.9452055,17.4088302 24.9080235,17.4088302 C30.3013699,17.4088302 30.6223092,17.4166579 30.927593,17.5575567 C31.4285714,17.7845603 31.6868885,18.1837736 31.7260274,18.7786797 C31.7651663,19.3892412 31.5694716,19.8197653 31.0998043,20.125046 L30.7710372,20.344222 L25.8551859,20.3677051 L20.9393346,20.3911882 L20.9393346,25.5731332 C20.9393346,28.9468768 20.9080235,30.8568384 20.853229,31.0525312 C20.7279843,31.4987107 20.3600783,31.8666132 19.8982387,32.007512 C19.5068493,32.1249276 19.4050881,32.1327554 19.2563601,32.0857891 Z" id="Path"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    @if ($vendor->is_vendor_closed == 0 && $vendor->show_slot == 0)
                                        {{ $vendor->opening_time }} – {{ $vendor->closing_time }}
                                        <span class="badge badge-success">{{ __('Open') }}</span>
                                    @elseif($vendor->is_vendor_closed == 0 && $vendor->show_slot == 1)
                                        24 x 7 <span class="badge badge-success">{{ __('Open') }}</span>
                                    @elseif($vendor->closed_store_order_scheduled == 1 && $checkSlot != 0)
                                        <span class="badge badge-danger">{{ __('Closed') }}</span>
                                        <p class="p-0 m-0">{{ __('We are not accepting orders right now. You can schedule this for ') . $checkSlot }}.</p>
                                    @else
                                        <span class="badge badge-danger">{{ __('Closed') }}</span>
                                    @endif
                                    </span>
                                    </span>

                                </li>
                                @if ($vendor->order_min_amount > 0)
                                    <span class="badge badge-danger">{{ __('Minimum order value') }}
                                        {{ Session::get('currencySymbol') . decimal_format($vendor->order_min_amount) }}</span>
                                @endif

                            </ul>
                        </div>
                </div>
            </div>
         </div>
    </div>
</div>