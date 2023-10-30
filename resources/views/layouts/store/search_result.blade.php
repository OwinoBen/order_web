<a class="text-right d-block mr-2 mb-1" id="search_viewall" href="#">{{ __('View All') }}</a>
    <div class="row mx-0">
			@if(!empty($title))
            <div class="result-item-name product_heading">
                <h4>{{$title}}</h4>
            </div>
        @endif
        @foreach($result as $product)

        @php
        if($type == 'product'){
        	 $redirect_url = route('productDetail', [$product->vendor_slug, $product->url_slug]);
            $image_url = $product->media->first() ? $product->media->first()->image->path['proxy_url'] . '80/80' . $product->media->first()->image->path['image_path'] : '';
        }else if($type == 'brand'){
            $redirect_url = route('brandDetail', $product->id);
            $image_url = $product->image['proxy_url'] . '80/80' . $product->image['image_path'];
        }else if($type == 'vendor'){
        	  $redirect_url = route('vendorDetail', $product->slug);
            $image_url = $product->logo['proxy_url'] . '80/80' . $product->logo['image_path'];
        }else{
            $redirect_url = route('categoryDetail', $product->slug);
            $image_url = $product->image['proxy_url'] . '80/80' . $product->image['image_path'];
       }

        @endphp
        <a class="col-12 text-center list-items pt-2" href="{{$redirect_url}}">
            <img class="blur-up lazyload" data-src="{{$image_url}}" alt="">
            <div class="result-item-name">
                <b>{{$product->name}}</b>
            </div>
        </a>
         @endforeach
    </div>
