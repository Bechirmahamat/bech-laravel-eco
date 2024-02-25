<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>
        <div class="row">

            @foreach ($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ route('single_product', $product->id) }}" class="option1">
                                    {{ 'Show Details' }}
                                </a>
                                <a href="{{ route('add_to_cart', $product->id) }}" class="option2">
                                    Add to cart
                                </a>
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="storage/{{ $product->image }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ $product->title }}
                            </h5>
                            @if ($product->discount_price > 0)
                                <div class=" py-2" class="indirim">
                                    <h6 class="indirim text-danger">

                                        %{{ $product->discount_price }} off <br>
                                        price: <span
                                            style="text-decoration:
                                        line-through">{{ $product->price }}</span>
                                    </h6>

                                    <h6>
                                        <span class="text-primary">
                                            ${{ $product->price - ($product->discount_price / 100) * $product->price }}</span>
                                    </h6>
                                </div>
                            @else
                                <h6>
                                    ${{ $product->price }}
                                </h6>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
            <div class="pagination">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
</section>
