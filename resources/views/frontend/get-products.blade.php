@extends('layouts.store', [
'title' => $slug == "new_products"? "New Products" : ($slug == "top_rated" ? "Recommended Products" : "Featured Products") ,
'meta_title'=>(!empty($category->translation) && isset($category->translation[0])) ? $category->translation[0]->meta_title:'',
'meta_keyword'=>(!empty($category->translation) && isset($category->translation[0])) ? $category->translation[0]->meta_keyword:'',
'meta_description'=>(!empty($category->translation) && isset($category->translation[0])) ? $category->translation[0]->meta_description:'',
])

@section('css')
<style type="text/css">
.main-menu .brand-logo {display: inline-block;padding-top: 20px;padding-bottom: 20px;}.slick-track{margin-left: 0px;}.product-box .product-detail h4, .product-box .product-info h4{font-size: 16px;}
</style>
<link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/price-range.css')}}">
@endsection
@section('content')
@if(!empty($category))
{{-- @include('frontend.included_files.categories_breadcrumb') --}}
@endif
@php
$additionalPreference = getAdditionalPreference(['is_token_currency_enable']);
@endphp
<section class="section-b-space ratio_asos">
    <div class="collection-wrapper">
        <div class="container" id="divFirst">
            <div class="row">
                <div class="col-12">
                    <div class="top-banner-wrapper text-center">

                       @include('frontend.vendor-category-topbar-banner')

                        <div class="top-banner-content small-section">
                            <h4>{{ @$category->translation_name }}</h4>
                            {{-- @if(!empty($category->childs) && count($category->childs) > 0)
                                <div class="row">
                                    <div class="col-12">

                                        <div class="slide-6 no-arrow">
                                            @foreach($category->childs->toArray() as $cate)
                                            <div class="category-block">
                                                <a href="{{route('categoryDetail', $cate['slug'])}}">
                                                    <div class="category-image"><img alt="" class="blur-up lazyload" data-src="{{$cate['icon']['image_fit'] . '300/300' . $cate['icon']['image_path']}}" ></div>
                                                </a>
                                                <div class="category-details">
                                                    <a href="{{route('categoryDetail', $cate['slug'])}}">
                                                        <h5>{{$cate['translation_name']}}</h5>
                                                    </a>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5 homepageSix">
                <div class="collection-filter col-lg-3 main-fillter">
                        <!-- <ul class="breadcrumb p-0 mb-2 mt-3">
                            <li class="breadcrumb-item align-items-center"><a href="javascript:void(0)">Home <i class="fa fa-angle-right" aria-hidden="true"></i> <span>Pharmacy <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </span><span class="active">Healthcare Device</span></a>
                            </li>
                        </ul> -->


                    <!--- Left Sidebar filters -->
                        @include('frontend.category-left-sidebar')
                    <!---End Left Sidebar filters -->

                </div>
                <div class="col-lg-9 ">
                    <div class="category_topbar">
                        <h5>{{$productCount}} items in <b>{{$slug == "new_products"? "New Products" :  ($slug == "top_rated" ? "Recommended Products" : "Featured Products")}}</b> </h5>

                        <div class="right">
                           @if(@$category->type_id != 13)
                             <div class="col-12 custom_filtter mt-3 mb-3">
                             <select name="order_type" id='order_type' class="form-control sortingFilter p-1 mb-0">
                                <option value="">{{__('Sort By')}}</option>
                                 <option value="featured">{{__('Featured')}}</option>
                                 <option value="a_to_z">{{__('A to Z')}}</option>
                                 <option value="z_to_a">{{__('Z to A')}}</option>
                                 <option value="low_to_high">{{__('Cost : Low to High')}}</option>
                                 <option value="high_to_low">{{__('Cost : High to Low')}}</option>
                                 <option value="rating">{{__('Avg. Customer Review')}}</option>
                                 <option value="newly_added">{{__('Newest Arrivals')}}</option>
                               </select>
                              </div>
                             @endif
                             <ul>
                               <li class="item_grid"><img src="https://s3.us-west-2.amazonaws.com/royoorders2.0-assets/prods/YqicsNE9Q7cLbUTaqIvFomU2JJpKzEaiVONcINGR.png" alt=""></li>
                               <li class="item_row"><img src="https://s3.us-west-2.amazonaws.com/royoorders2.0-assets/prods/qz6g13dwSJ0cjWJ7oFQOQJQYmREznoj15lPUx1VF.png" alt=""></li>
                             </ul>
                        </div>

                    </div>
                <div class="collection-content outter-fillter-data fillter_product">
                    <div class="page-main-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="collection-product-wrapper">
                                    <div class="product-top-filter">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="filter-main-btn">
                                                    <span class="filter-btn btn btn-theme">
                                                       {{__('Filters')}} >
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="product-filter-content">
                                                    <!-- <div class="collection-view">
                                                        <ul>
                                                            <li><i class="fa fa-th grid-layout-view"></i></li>
                                                            <li><i class="fa fa-list-ul list-layout-view"></i></li>
                                                        </ul>
                                                    </div> -->
                                                    {{-- <div class="collection-grid-view">
                                                        <ul>
                                                            <li><img class="blur-up lazyload" data-src="{{asset('front-assets/images/icon/2.png')}}" alt="" class="product-2-layout-view"></li>
                                                            <li><img class="blur-up lazyload" data-src="{{asset('front-assets/images/icon/3.png')}}" alt="" class="product-3-layout-view"></li>
                                                            <li><img class="blur-up lazyload" data-src="{{asset('front-assets/images/icon/4.png')}}" alt="" class="product-4-layout-view"></li>
                                                            <li><img class="blur-up lazyload" data-src="{{asset('front-assets/images/icon/6.png')}}" alt="" class="product-6-layout-view"></li>
                                                        </ul>
                                                    </div> --}}
                                                    {{-- <div class="product-page-per-view">
                                                        <?php $pagiNate = (Session::has('cus_paginate')) ? Session::get('cus_paginate') : 8; ?>
                                                        <select class="customerPaginate">
                                                            <option value="8" @if($pagiNate == 8) selected @endif>Show 8
                                                            </option>
                                                            <option value="12" @if($pagiNate == 12) selected @endif>Show 12
                                                            </option>
                                                            <option value="24" @if($pagiNate == 24) selected @endif>Show 24
                                                            </option>
                                                            <option value="48" @if($pagiNate == 48) selected @endif>Show 48
                                                            </option>
                                                        </select>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="displayProducts main_category" id="category_products_filter">

                                    {{-- @include('frontend.ajax.product-card') --}}

                                    @php
                                    $additionalPreference = getAdditionalPreference(['is_service_product_price_from_dispatch','is_service_price_selection']);
                                    $is_service_product_price_from_dispatch_forOnDemand = 0;

                                    $getOnDemandPricingRule = getOnDemandPricingRule(Session::get('vendorType'), (@Session::get('onDemandPricingSelected') ?? ''),$additionalPreference);
                                    if($getOnDemandPricingRule['is_price_from_freelancer']==1){
                                        $is_service_product_price_from_dispatch_forOnDemand =1;
                                    }
                                    @endphp
                                    <div class="product-wrapper-grid">
                                        <div class="row margin-res vendor_first">
                                            @if(@$products)
                                            @foreach($products as $key => $data)
                                            <div class="col-xl-3 col-md-3 col-6 mt-3">
                                                <a href="{{route('productDetail', [@$data->vendor->slug,@$data->url_slug])}}" target="_blank" class="product-box scale-effect mt-0 product-card-box position-relative al_box_third_template al">
                                                    <div class="product-image">
                                                        <img class="img-fluid blur-up lazyload" data-src="{{@$data->media[0]->image['path']['original_image']}}" alt="">
                                                    </div>
                                                    <div class="media-body align-self-center">
                                                        <div class="inner_spacing w-100">
                                                            <h3 class="d-flex align-items-center justify-content-between">
                                                                <label class="mb-0"><b> {{ @$data->category->categoryDetail->translation[0]['name'] }}</b></label>
                                                                @if($client_preference_detail)
                                                                    @if($client_preference_detail->rating_check == 1)
                                                                        @if($data->averageRating > 0)
                                                                            <span class="rating">{{ number_format($data->averageRating, 1, '.', '') }} <i class="fa fa-star text-white p-0"></i></span>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            </h3>
                                                            <div class="product-description_list border-bottom">
                                                                @if($dicountPercentage = productDiscountPercentage(@$data->variant[0]->price, @$data->variant_compare_at_price))
                                                                    <span class="flag-discount">{{$dicountPercentage}}% Off</span>
                                                                @endif
                                                                <h6 class="mt-0 mb-1"><b>{{@$data->translation[0]['title']}}</b></h6>
                                                                @if(@$data->vendor->is_seller == 1)
                                                                    <h6 class="sold-by d-flex">
                                                                        <b> <img class="blur-up lazyload" data-src="{{$favicon}}" alt="{{$data->vendor->Name}}" style="width: 25px !important; height: 25px;"></b> <b> Order by clickokart </b>
                                                                    </h6>
                                                                @endif
                                                                </div>

                                                                @if(@$category->type_id == 13)
                                                                 @if(!empty($data->ProductAttribute))
                                                                    @foreach ($data->ProductAttribute as $attribute)
                                                                        @if(@$attribute && $attribute->key_name == "Location")
                                                                            <div class="d-flex align-items-center justify-content-between prod_location pt-2">
                                                                                <b class="flex nowrap"><span class="loction ellips"><i class="fa fa-map-marker" aria-hidden="true"></i>   {{$attribute->key_value}}</span></b>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                                <div class="d-flex align-items-center justify-content-between al_clock pt-2 update_year">
                                                                    <b>Updated {{ convertDateToHumanReadable($data->updated_at) }} </b>
                                                                </div>
                                                                <div class="product-price-chat-sec">
                                                                    @if($data->inquiry_only == 0)
                                                                        <h4 class="mt-1">{{Session::get('currencySymbol').' '.(decimal_format($$data->variant[0]->price* $data->variant_multiplier))}}</h4>
                                                                    @endif
                                                                    <div class="prod-details">
                                                                        <div class="chat-button">
                                                                            @if(getAdditionalPreference(['chat_button'])['chat_button'])
                                                                            <button class="start_chat chat-icon btn btn-solid"  data-vendor_order_id="" data-chat_type="userToUser" data-vendor_id="{{$data->vendor->id}}" data-orderid="" data-order_id="" data-product_id="{{$data->id}}" style="margin-right: 5px !important;"><i class="fa fa-comments" aria-hidden="true"></i></button>

                                                                                @endif
                                                                                @if(getAdditionalPreference(['call_button'])['call_button'])
                                                                                    <button class="call-icon btn btn-solid" href="tel:"><i class="fa fa-phone-square" aria-hidden="true"></i></button>

                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                               @else
                                                                       @if((@$data->inquiry_only == 0) && ($is_service_product_price_from_dispatch_forOnDemand !=1) )
                                                                        @if (@$additionalPreference['is_token_currency_enable'] )
                                                                        <i class='fa fa-money' aria-hidden='true'></i> {{ getInToken($data->variant_price * $data->variant_multiplier)}}
                                                                        @else
                                                                            <h4 class="mt-1">{{Session::get('currencySymbol').' '.(decimal_format(@$data->variant[0]->price))}}</h4>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="col-xl-12 col-12 mt-4"><h5 class="text-center">{{ __('No Product Found') }}</h5></div>
                                            @endif
                                        </div>
                                    </div>






                                    </div>
                                    <div class="pagination pagination-rounded justify-content-end mb-0 page-m-20">
                                        @if(!empty($products))
                                            {{ $products->links() }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="vendor_id" value="{{ isset($vendor_id) ? $vendor_id : ''}}">
</section>
@endsection
@section('script')
<script src="{{asset('front-assets/js/rangeSlider.min.js')}}"></script>
<script src="{{asset('front-assets/js/my-sliders.js')}}"></script>
<script>
    @if(!empty($category->image) && $category->image['is_original'])
    $(document).ready(function() {
        $("body").addClass("homeHeader");
    });
    @endif
</script>
<script>
    var order_type = "";
    $('.js-range-slider').ionRangeSlider({
        type: 'double',
        grid: false,
        min: 0,
        max: {{ $maxPrice??50000 }},
        from: 0,
        to: {{ $maxPrice??50000 }},
        prefix: " "
    });
    var ajaxCall = 'ToCancelPrevReq';
    $('.js-range-slider').change(function(){
        filterProducts();
    });
    $('.productFilter').click(function(){
        filterProducts();
    });

    $(document).on('click', '#category_products_filter .pagination a.page-link', function(e){
        e.preventDefault();
        var link = $(this).attr('href');
        var urlParams = new URL(link).searchParams;
        var page = urlParams.get('page');
        filterProducts(page);
    });

    $(document).on('change','.sortingFilter',function(){
        order_type = $(this).val();
        filterProducts();
    });
    $('.js-range-slider').change(function(){
        filterProducts();
    });

    function filterProducts(page='', limit=''){
        var brands = [];
        var variants = [];
        var options = [];
        var vendor_id =$("#vendor_id").val();
        $('.productFilter').each(function () {
            var that = this;
            if(this.checked == true){
                var forCheck = $(that).attr('used');
                if(forCheck == 'brands'){
                    brands.push($(that).attr('fid'));
                }else{
                    variants.push($(that).attr('fid'));
                    options.push($(that).attr('optid'));
                }
            }
        });
        var range = $('.rangeSliderPrice').val();
        var ajaxData = {
            "_token": "{{ csrf_token() }}",
            "brands": brands,
            "vendor_id": vendor_id,
            "variants": variants,
            "options": options,
            "range": range,
            "order_type" : order_type,
            "productType" : "{{$slug}}",
        };

        if(limit != ''){
            ajaxData.limit = limit;
        }
        if(page != ''){
            ajaxData.page = page;
        }
        ajaxCall = $.ajax({
            type: "post",
            dataType: "json",
            url: "{{ route('filterProducts') }}",
            data: ajaxData ?? "",
            beforeSend : function() {
                if(ajaxCall != 'ToCancelPrevReq' && ajaxCall.readyState < 4) {
                    ajaxCall.abort();
                }
                $('.spinner-overlay').show();
            },
            success: function(response) {
                $('.displayProducts').html(response.html);
            },
            complete: function() {
                $('.spinner-overlay').hide();
            },
            error: function (data) {
                //location.reload();
            },
        });
    }
    $(".page-link").on("click" ,function(){
        document.getElementById("divFirst").scrollIntoView();

});
</script>
@endsection
