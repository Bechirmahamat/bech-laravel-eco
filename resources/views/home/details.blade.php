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
        <section class="container my-5  cart">
            <div class="container my-1">
                <h4 class="my-3">Your <span class="text-danger">Orders </span></h4>
                <div class="content-of-cart overflow">
                    {{-- @if (!$orders->isEmpty()) --}}
                    <table class="table">
                        <thead>
                            <tr class="tr text-dark">
                                <th>Images</th>
                                <th>title</th>
                                <th>Price</th>
                                <th>quantity</th>
                                <th>date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                {{-- products 1 --}}
                                <tr class="tr">
                                    <td>
                                        <img height="50px" src="storage/{{ $order->image }}" alt="">
                                    </td>
                                    <td>{{ $order->title }}</td>
                                    <td class="danger">${{ $order->price }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->created_at }}</td>
                                </tr>
                                {{-- end ofproducts 1 --}}
                            @endforeach
                            {{-- <p class="my-5">You did not order any item yet.</p> --}}


                        </tbody>
                    </table>
                    @if ($order_status)
                        <form class="mr-1 text-right mb-1" action="{{ route('paynow', $order_id) }}" method="get">
                            <button type="submit" class="btn btn-danger">paynow</button>
                        </form>
                    @endif

                </div>

            </div>
        </section>

    </div>

    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>
