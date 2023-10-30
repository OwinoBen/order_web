@extends('layouts.store', ['title' => __('Register')])
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/intlTelInput.css') }}">
    <style type="text/css">
        
        body{
        overflow-x: hidden;
    }
    header{
        display: none;
    }
    footer{
        display: none;
    }
    article#content-wrap {
    padding: 0!important;
}
.section-t-space, section{
    padding: 0!important;
}
        .file>label,
        .file.upload-new>label {
            width: 100%;
            border: 1px solid #ddd;
            padding: 30px 0;
            height: 216px;
        }

        .file .update_pic img,
        .file.upload-new img {
            height: 130px;
            width: auto;
        }

        .update_pic,
        .file.upload-new .update_pic {
            width: 100%;
            height: auto;
            margin: auto;
            text-align: center;
            border: 0;
            border-radius: 0;
        }

        .file--upload>label {
            margin-bottom: 0;
        }

        .errors {
            color: #F00;
            background-color: #FFF;
        }
        .al_body_template_one .iti__selected-flag{
            height:auto;
            padding: 10px 6px;
        }
        .image img {
            width: 100%; 
            height: 100vh;
        }
        .register_body .img {
        margin-bottom: 38px;
}
.login_title {
    font-size: 28px;
    color: rgba(0, 0, 0, 0.720853);
    margin-top: 0;
    font-weight: 600;
}
p.login_disc {
    margin-bottom: 44px;
}
#register input {
    background: #F4F4F4;
    border: unset;
    height: 54px;
    border-radius: 6px;
    max-width: 100%;
}
#register  .form-check input#html {
    height: auto;
}
form#register {
    max-width: 710px;
    margin: 0 auto;
    padding: 0 15px;
}
#register .mb-3 {
    margin-bottom: 16px!important;
}
.drak_img{
    display: none
}
.dark  .drak_img{
    display: block;
}
.dark .light_img{
    display: none;
}
.register_body  .img img {
    max-width: 150px;
    margin: 0 auto;
}

@media (max-width:1400px){
    p.login_disc{
        margin-bottom:10px; 
    }
    .register_body .img{
        margin-bottom: 15px;
    }
    #register .mb-3 {
    margin-bottom: 10px!important;
}

}

@media (max-width:991px){
    .image img {
    width: 100%;
    height: 40vh;
    object-fit: cover;
    object-position: center;
}
}
@media (max-width:767px){
    .image img {
    width: 100%;
    height: 40vh;
    object-fit: cover;
    object-position: center;
}
.register_body .img {
    margin-bottom: 30px;
}
p.login_disc {
    margin-bottom: 40px;
}
}
.dark p.text-center.pt-3 {
    color: #cfd4da!important;
}
    </style>
@endsection
@section('content')
    <section class="wrapper-main p-0 alSectionTop d-flex align-items-center">
        <div class="container-full w-100">
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-6 mb-lg-0 mb-3">
                    <div class="image">
                        <img src="https://s3.us-west-2.amazonaws.com/royoorders2.0-assets/prods/kIgi0POVnTjEp8r84PaYzEWVCQG2XwyQMYF4Q1Io.png" alt="">
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 mb-lg-0 mb-3 text-center">
                    <div class="img">
                        <a href="{{ route('userHome') }}">
                            <img class="light_img" src="https://s3.us-west-2.amazonaws.com/royoorders2.0-assets/Clientlogo/6479bda35e187.png" alt="">
                            <img class="drak_img" src="https://s3.us-west-2.amazonaws.com/royoorders2.0-assets/Clientlogo/644649358492e.png" alt="">
                        </a>
                    </div>
                    <h3 class="login_title  mb-2">{{ __('Create Account') }}</h3>
                    <p class="login_disc">Create your account to access all the products offered by us.</p>

                    @if (session('preferences'))
                        @if (@session('preferences')->fb_login == 1 || @session('preferences')->twitter_login == 1 || @session('preferences')->google_login == 1 || @session('preferences')->apple_login == 1)
                            <ul class="social-links d-none align-items-center mx-auto mb-4 mt-3 " >
                                @if (session('preferences')->google_login == 1)
                                    <li>
                                        <a href="{{ url('auth/google') }}">
                                            <img src="{{ asset('front-assets/images/google.svg') }}">
                                        </a>
                                    </li>
                                @endif
                                @if (@session('preferences')->fb_login == 1)
                                    <li>
                                        <a href="{{ url('auth/facebook') }}">
                                            <img src="{{ asset('front-assets/images/facebook.svg') }}">
                                        </a>
                                    </li>
                                @endif
                                @if (@session('preferences')->twitter_login)
                                    <li>
                                        <a href="{{ url('auth/twitter') }}">
                                            <img src="{{ asset('front-assets/images/twitter.svg') }}">
                                        </a>
                                    </li>
                                @endif
                                @if (@session('preferences')->apple_login == 1)
                                    <li>
                                        <a href="javascript::void(0);">
                                            <img src="{{ asset('front-assets/images/apple.svg') }}">
                                        </a>
                                    </li>
                                @endif
                            </ul>
                            {{-- <div class="divider_line m-auto">
                                <span>{{ __('OR') }}</span>
                            </div> --}}
                        @endif
                    @endif
                    <div class="row mt-3">
                        @if (session('preferences'))
                        <div class="{{ (@session('preferences')->concise_signup == 1)? 'mx-auto':' col-xl-12 text-left' }}">
                            <form name="register" id="register" enctype="multipart/form-data" action="{{ route('customer.register') }}"
                                class="px-lg-4" method="post"> @csrf
                                @if(@session('preferences')->concise_signup == 1)
                                <input type="hidden" name="name" value="guest">
                                <input type="hidden" name="email" id="guest-email" value="">
                                @endif
                                <div class="row form-group mb-0 {{ (@session('preferences')->concise_signup == 1)? 'mx-auto':'' }}">
                                    @if(@session('preferences')->concise_signup == 0)
                                    <div class="col-md-12 mb-3">
                                        {{-- <label for="">{{ __('Full Name') }}</label> --}}
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('Full Name') }}" name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    @endif
                                    <div class="col-md-{{ (@session('preferences')->concise_signup == 1)? '12 text-left':'12' }} mb-3">
                                        {{-- <label for="">{{ __('Phone No.') }}</label> --}}
                                        <input type="tel"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            id="phone" placeholder="{{ __('Phone No.') }}" name="phone_number"
                                            value="{{ old('full_number') }}">

                                        <input type="hidden" id="dialCode" name="dialCode"
                                            value="{{ old('dialCode') ? old('dialCode') : Session::get('default_country_phonecode', '1') }}">
                                        <input type="hidden" id="countryData" name="countryData"
                                            value="{{ old('countryData') ? old('countryData') : Session::get('default_country_code', 'US') }}">
                                            @error('phone_number')
                                            <span class="invalid-feedback" role="alert" style="display:block">
                                                <strong>{{ __($message) }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group mb-0 {{ (@session('preferences')->concise_signup == 1)? 'mx-auto':'' }}">
                                    @if(@session('preferences')->concise_signup == 0)
                                    <div class="col-md-12 mb-3">
                                        {{-- <label for="">{{ __('Email') }}</label> --}}
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            placeholder="{{ __('Email') }}" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ __($message) }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    @endif
                                    <div class="col-md-{{ (@session('preferences')->concise_signup == 1)? '12 text-left':'12' }} mb-3">
                                        {{-- <label for="">{{ __('Password') }}</label> --}}
                                        <div class="position-relative">
                                            <input type="password" id="password-field"
                                                class="form-control @error('password') is-invalid @enderror" id="review"
                                                placeholder="{{ __('Enter Your Password') }}" name="password">
                                            <!-- <input id="password-field" type="password" class="form-control pr-3" name="password" placeholder="{{ __('Password') }}"> -->
                                            <span toggle="#password-field" class="fa fa-eye-slash toggle-password"
                                                style="right:20px"></span>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ __($errors->first('password')) }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                @if (count($user_registration_documents) > 0)    
                                    <div class="user-info d-block w-100">
                                        <h5 class="py-1">User Document</h5>
                                    </div>
                                @endif
                                <div class="row form-group mb-0 ">
                                    @foreach ($user_registration_documents as $vendor_registration_document)
                                        @if (isset($vendor_registration_document->primary->slug) && !empty($vendor_registration_document->primary->slug))
                                            @if (strtolower($vendor_registration_document->file_type) == 'selector')
                                                <div class="col-md-12 mb-3"
                                                    id="{{ $vendor_registration_document->primary->slug ?? '' }}Input">
                                                    <label
                                                        for="">{{ $vendor_registration_document->primary ? $vendor_registration_document->primary->name : '' }}</label>
                                                    <select
                                                        class="form-control {{ !empty($vendor_registration_document->is_required) ? 'required' : '' }}"
                                                        name="{{ $vendor_registration_document->primary->slug }}"
                                                        id="input_file_selector_{{ $vendor_registration_document->id }}">
                                                        <option value="">
                                                            {{ __('Please Select ') .($vendor_registration_document->primary ? $vendor_registration_document->primary->name : '') }}
                                                        </option>
                                                        @foreach ($vendor_registration_document->options as $key => $value)
                                                            <option value="{{ $value->id }}">
                                                                {{ $value->translation ? $value->translation->name : '' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="invalid-feedback"
                                                        id="{{ $vendor_registration_document->primary->slug }}_error"><strong></strong></span>
                                                </div>
                                            @else
                                                <div class="col-md-12 mb-3"
                                                    id="{{ $vendor_registration_document->primary->slug ?? '' }}Input">
                                                    <label
                                                        for="">{{ $vendor_registration_document->primary ? $vendor_registration_document->primary->name : '' }}</label>
                                                    @if (strtolower($vendor_registration_document->file_type) == 'text')
                                                        <input id="input_file_logo_{{ $vendor_registration_document->id }}"
                                                            type="text"
                                                            name="{{ $vendor_registration_document->primary->slug }}"
                                                            class="form-control {{ !empty($vendor_registration_document->is_required) ? 'required' : '' }}">

                                                        @error($vendor_registration_document->primary->slug)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first($vendor_registration_document->primary->slug) }}</strong>
                                                            </span>
                                                        @enderror
                                                    @else
                                                        <div class="file file--upload">
                                                            <label
                                                                for="input_file_logo_{{ $vendor_registration_document->id }}">
                                                                <span class="update_pic pdf-icon">
                                                                    <img src=""
                                                                        id="upload_logo_preview_{{ $vendor_registration_document->id }}">
                                                                </span>
                                                                <span class="plus_icon"
                                                                    id="plus_icon_{{ $vendor_registration_document->id }}">
                                                                    <i class="fa fa-plus"></i>
                                                                </span>
                                                            </label>
                                                            @if (strtolower($vendor_registration_document->file_type) == 'image')
                                                                <input
                                                                    class="{{ !empty($vendor_registration_document->is_required) ? 'required' : '' }}"
                                                                    id="input_file_logo_{{ $vendor_registration_document->id }}"
                                                                    type="file"
                                                                    name="{{ $vendor_registration_document->primary->slug }}"
                                                                    accept="image/*"
                                                                    data-rel="{{ $vendor_registration_document->id }}">
                                                            @else
                                                                <input
                                                                    class="{{ !empty($vendor_registration_document->is_required) ? 'required' : '' }}"
                                                                    id="input_file_logo_{{ $vendor_registration_document->id }}"
                                                                    type="file"
                                                                    name="{{ $vendor_registration_document->primary->slug }}"
                                                                    accept=".pdf"
                                                                    data-rel="{{ $vendor_registration_document->id }}">
                                                            @endif

                                                            @error($vendor_registration_document->primary->slug)
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first($vendor_registration_document->primary->slug) }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                                <div class="form-check mb-4">
                                    <input type="checkbox" name="term_and_condition" class="form-check-input @error('term_and_condition') is-invalid @enderror" id="html">
                                    <label for="html" class="mr-3">{{ __('I accept the') }}
                                        <a href="{{ $terms ? route('extrapage', $terms->slug) : '#' }}"
                                            target="_blank">{{ __('Terms And Conditions') }} </a>
                                        {{ __('and have read the') }}
                                        <a href="{{ $privacy ? route('extrapage', $privacy->slug) : '#' }}"
                                            target="_blank">
                                            {{ __('Privacy Policy') }}.
                                        </a>
                                    </label>
                                    @if($errors->first('term_and_condition'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('term_and_condition') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="row form-group mb-0 align-items-center">
                                    <!-- <div class="col-12 checkbox-input">
                                        <input type="checkbox" id="html" name="term_and_condition"
                                            class="form-control @error('term_and_condition') is-invalid @enderror">



                                        <label for="html">{{ __('I accept the') }}
                                            <a href="{{ $terms ? route('extrapage', $terms->slug) : '#' }}"
                                                target="_blank">{{ __('Terms And Conditions') }} </a>
                                            {{ __('and have read the') }}
                                            <a href="{{ $privacy ? route('extrapage', $privacy->slug) : '#' }}"
                                                target="_blank">
                                                {{ __('Privacy Policy') }}.
                                            </a>
                                        </label>
                                        @if ($errors->first('term_and_condition'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('term_and_condition') }}</strong>
                                            </span>
                                        @endif



                                    </div> -->
                                    <div class="col-md-12 position-absolute d-none">
                                        {{-- <label for="">Referral Code</label> --}}
                                        <input type="text" class="form-control" id="refferal_code"
                                            placeholder="Refferal Code" name="refferal_code"
                                            value="{{ old('refferal_code', $code ?? '') }}">
                                        @if ($errors->first('refferal_code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('refferal_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row  my-0">
                                    <div class="col-md-12">
                                        <input type="hidden" name="device_type" value="web">
                                        <input type="hidden" name="device_token" value="web">
                                        <button type="submit"
                                            class="btn btn-solid submitLogin w-100">{{ __('Create An Account') }}</button>
                                    </div>
                                </div>
                            </form>
                            <p class="text-center pt-3" style="color:#000;font-weight:500;">Already have an account? <a href="{{route('customer.login')}}"> Login</a></p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="{{ asset('assets/js/intlTelInput.js') }}"></script>
    <script src="{{asset('js/phone_number_validation.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            @if (session('preferences'))
                @if(@session('preferences')->concise_signup == 1)
                    $('#phone').change(function() {
                        var custPhone = $(this).val();
                        $('#guest-email').val(custPhone+'@gmail.com');
                    });
                @endif
            @endif
            $("#register").validate({
                errorClass: 'errors',
                rules: {
                    name : {
                        required: true,
                    },
                    phone_number: {
                        required: true,
                        number: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                onfocusout: function(element) {
                    this.element(element); // triggers validation
                },
                onkeyup: function(element, event) {
                    this.element(element); // triggers validation
                },
                messages : {
                    name: "{{ __('Please enter your name')}}",
                    phone_number: {
                        required: "{{ __('Please enter your phone')}}",
                        number: "{{ __('Please enter a numerical value')}}"
                    },
                    email: "{{ __('The email should be in the format:')}} abc@domain.tld",
                    password: "{{ __('Please enter your password')}}",
                }
            });

            $("#register").submit(function() {
                if($("#phone").hasClass("is-invalid")){
                    $("#phone").focus();
                    return false;
                }
            });
        });
        jQuery(window.document).ready(function () {
            jQuery("body").addClass("register_body");
        });
        jQuery(document).ready(function($) {
            setTimeout(function(){
                var footer_height = $('.footer-light').height();
                console.log(footer_height);
                $('article#content-wrap').css('padding-bottom',footer_height);
            }, 500);
            setTimeout(function(){
                $("#phone").val({{ old('phone_number') }});
            }, 2500);
        });
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            separateDialCode: true,
            hiddenInput: "full_number",
            utilsScript: "{{ asset('assets/js/utils.js') }}",
            initialCountry: "{{ Session::get('default_country_code', 'US') }}",
        });

        phoneNumbervalidation(iti, input);

        $(document).ready(function() {
            $("#phone").keypress(function(e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
                return true;
            });
        });
        $('.iti__country').click(function() {
            var code = $(this).attr('data-country-code');
            $('#countryData').val(code);
            var dial_code = $(this).attr('data-dial-code');
            $('#dialCode').val(dial_code);
        });
        $(document).on('change', '[id^=input_file_logo_]', function(event) {
            var rel = $(this).data('rel');
            // $('#plus_icon_'+rel).hide();
            readURL(this, '#upload_logo_preview_' + rel);
        });

        function getExtension(filename) {
            return filename.split('.').pop().toLowerCase();
        }

        function readURL(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var extension = getExtension(input.files[0].name);
                reader.onload = function(e) {
                    if (extension == 'pdf') {
                        $(previewId).attr('src', "{{ asset('assets/images/pdf-icon-png-2072.png') }}");
                    } else if (extension == 'csv') {
                        $(previewId).attr('src', text_image);
                    } else if (extension == 'txt') {
                        $(previewId).attr('src', text_image);
                    } else if (extension == 'xls') {
                        $(previewId).attr('src', text_image);
                    } else if (extension == 'xlsx') {
                        $(previewId).attr('src', text_image);
                    } else {
                        $(previewId).attr('src', e.target.result);
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
