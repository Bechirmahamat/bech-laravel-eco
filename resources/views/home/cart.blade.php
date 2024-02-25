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
    <!-- boostrap icons cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <style>
        @media(max-width:500px) {}

        .dlfex {
            display: flex;
            justify-content: space-between;
            padding-right: 20px
        }

        hr {
            width: 30px;
            height: 2px;
            text-align: left !important;
            margin-top: -5px;
            display: inline-block;
        }


        table tr {
            height: 50px;
            padding: 2px auto !important;
        }

        thead tr {
            background: rgb(8, 87, 107) !important;
            color: aliceblue !important;
        }

        thead tr th {

            color: aliceblue !important;
        }

        td {
            color: black;
        }

        table tr:nth-child(even) {
            background: #fff;
        }

        table tr:nth-child(odd) {
            background: #efefef;
        }

        .checkout {
            /* background: red; */
            display: flex;
            justify-content: right;
            flex-direction: column;
            align-items: right;
            width: 30%;
            margin-left: auto;

        }

        .checkout h6 {}

        @media(max-width:700px) {
            .overflow {
                overflow-x: scroll;
            }

            .checkout {
                width: 100%;
                /* background: blue !important; */
            }

        }
    </style>
</head>

<body>

    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <section class=" my-5  cart">
            <div class="container cart_container">

                <h2>Your <span class="text-danger">cart</span> </h2>
                <hr class="bg-danger">
                @if (!$carts->isEmpty())


                    <div class="content-of-cart overflow">
                        <table class="table">
                            <thead>
                                <tr class="tr text-dark">
                                    <th>Images</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>quantity</th>
                                    <th>action</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0; ?>
                                @foreach ($carts as $cart)
                                    <tr class="tr">

                                        <td><img width="50px" height="50px" src="storage/{{ $cart->product_image }}"
                                                alt=""></td>
                                        <td>
                                            <span>{{ $cart->title }}</span>

                                        </td>
                                        <td>${{ $cart->product_price }}</td>
                                        <td>
                                            <form class="d-flex gap-2" action="{{ route('edit_quantity') }}"
                                                method='post'>
                                                @csrf
                                                <input style="width: 70px" type="number" min="1" name="quantity"
                                                    class="form-control mr-1" value="{{ $cart->product_quantity }}">
                                                <input type="hidden" name="id" value="{{ $cart->id }}">
                                                <button type="submit" class="btn btn-primary">edit</button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('delete_cart', $cart->id) }}"><button
                                                    class="btn btn-danger">delete</button></a>
                                        </td>
                                        <td>${{ (float) $cart->product_price * (float) $cart->product_quantity }}</td>
                                        <?php $total += (float) $cart->product_price * (float) $cart->product_quantity; ?>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="checkout my-2">
                        <h6 class="dlfex"><span>Total price:</span> <span
                                class="text-right text-danger">${{ $total }}</span></h6>
                        {{-- <form > --}}
                        <a class="text-right my-3" href="{{ route('checkout') }}"> <button
                                class="btn btn-danger text-right">Check
                                Out</button></a>
                        {{-- </form> --}}
                    </div>
                @else
                    <p class="my-3">You have no item in the cart yet</p>
                @endif

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
