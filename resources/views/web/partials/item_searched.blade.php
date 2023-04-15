{{-- @if(isset($products)) --}}
    @foreach($products as $product)
    <li>
        <a href="{{route('web-product.show',['title'=> $product->slug, 'id' => $product->id, 'slug' =>  $product->slug])}}">
    <img src="{{asset($product->path_image)}}" alt="{{$product->name_image}}">
    <div class="box-search-suggestions">
        <p>{{$product->name}} </p>
        <div class="box-price-suggestions">
            <del style="opacity: 0.5;">@formatMoney($product->retail_price * 11 / 10)</del>
            <span>@formatMoney($product->retail_price)</span>
        </div>
    </div>
        </a>
    </li>
    @endforeach
{{-- @endif --}}