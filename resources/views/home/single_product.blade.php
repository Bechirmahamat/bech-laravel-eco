<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <base href="/public">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <link rel="shortcut icon" href="/home/images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('home/css/bootstrap.css') }}?v={{ filemtime(public_path('home/css/bootstrap.css')) }}" />

    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />


    <style>
        .indirim {
            font-size: 12px;
        }

        .pagination {
            display: flex;
            /* flex-direction: column; */
            margin: 1rem auto;
            justify-content: center;
            align-items: center;
        }

        .spanler {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }

        @media(max-width:500px) {
            img {
                max-width: 345px !important;
            }
        }
    </style>
</head>

<body>

    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <section class=" my-5  single">
            <div class="container single_container">
                <div class="row">
                    <div class="col-lg-6 bg-light text-center py-4">
                        <img class="big-image" width="400px" height="400px" src="storage/{{ $product->image }}"
                            alt="" class="">
                    </div>
                    <div class="col-lg-6">
                        <h4 class="text-dark">{{ $product->category }}</h4>
                        <h2 class="my-3 text-capitalize">{{ $product->title }}</h2>
                        @if ($product->discount_price > 0)
                            <div>
                                <h6><span class="my-2 text-danger">{{ $product->discount_price }} %
                                        off indirim
                                </h6>
                                <h6></span><span style="text-decoration: line-through">{{ $product->price }}</span></h6>
                                <h4 class="text-danger">
                                    {{ $product->price - ($product->discount_price / 100) * $product->price }}</h4>
                            </div>
                        @else
                            <h3 class="price my-3 text-danger">${{ $product->price }}</h3>
                        @endif

                        <div class="my-2 gap-2">
                            <span class="border-rounded bg-danger spanler"></span>
                            <span class="border-rounded bg-primary spanler"></span>
                        </div>
                        <h4 class="my-2">description</h4>
                        <p>{{ $product->description }}
                        </p>

                        <div style="width: 200px" class="btn-container">

                            <form class="d-flex gap-2" action="{{ route('add_to_cart_single') }}" method="post">
                                @csrf
                                <input style="width: 70px" type="number" min="1" name="quantity"
                                    class="form-control mr-1" value="1">
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-danger">Add To Cart</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>
