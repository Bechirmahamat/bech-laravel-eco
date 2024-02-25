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

        .flex {
            display: grid !important;
            grid-template-columns: 1fr 1fr;
            gap: 10px;


        }

        .form-group {
            margin: 5px 0 !important;
        }

        label {
            margin-bottom: 5px !important;
        }

        .info {
            padding: 0 10px;
        }

        textarea {
            height: 120px !important;
            resize: none;
        }

        .checkout h6 {}

        table thead {
            border: none !important;
        }

        table tr th {
            border: none !important;
        }

        .space {
            display: flex;
            justify-content: space-between;
            padding: 0 2rem 0 1rem;
        }

        .space span {
            font-size: 14px;
        }

        @media(max-width:700px) {}
    </style>
</head>

<body>

    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <section class="container my-5  cart">
            <div class="container my-1">
                <div class="row ">
                    <div class="col-lg-7 col-sm-10 info">
                        <h4 class="mb-2">Pick up <span class="text-danger">info</span></h4>
                        <form action="{{ route('add_order') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-5 col-md-6">
                                    <label class="" for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ $user->name }}"
                                        class="form-control" placeholder="Enter your name" id="" readonly>
                                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-danger" />
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label class="" for="">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{ $user->email }}"
                                        class="form-control" placeholder="Enter your email" id="" readonly>
                                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger" />
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-lg-5 col-md-6">
                                    <label class="" for="">City <span class="text-danger">*</span></label>
                                    <input type="text" name="city" class="form-control"
                                        placeholder="Enter your phone city" id="">
                                    <x-input-error :messages="$errors->get('city')" class="mt-1 text-danger" />
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label class="" for="">phone <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" name="phone" value="{{ $user->phone }}"
                                        class="form-control" placeholder="Enter your number" id="">
                                    <x-input-error :messages="$errors->get('phone')" class="mt-1 text-danger" />
                                </div>
                            </div>
                            <div class="row mt-1">

                                <div class="col-lg-11 col-md-12 mb-3">
                                    <label class="form-label" for="">Address <span
                                            class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control" placeholder="Enter your address" id="">{{ $user->address }}</textarea>
                                    <x-input-error :messages="$errors->get('address')" class="mt-1 text-danger" />
                                </div>
                            </div>

                            <button type="submit" name="submit" value="1"
                                class="btn btn-danger my-3 ">CheckOut</button>
                        </form>
                    </div>
                    <div class="col-lg-4 col-sm-10 info ">
                        <h4 class="mb-2">In your <span class="text-danger">bag</span></h4>
                        <table class="table bg-light">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0; ?>
                                @foreach ($carts as $cart)
                                    <tr class="tr">
                                        <td>
                                            <img width="50px" height="50px" src="storage/{{ $cart->product_image }}"
                                                alt="">
                                        </td>
                                        <td>{{ $cart->product_quantity }}</td>
                                        <td>*</td>
                                        <td class="text-danger">$ {{ $cart->product_price }}</td>
                                    </tr>
                                    <?php $total += (float) $cart->product_price * $cart->product_quantity; ?>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="bg-light">
                            <div class="space">
                                <span>Suptotal:</span>
                                <span class="text-danger text-end">${{ $total }}</span>
                            </div>
                            <div class="space">
                                <span>Shipping:</span>
                                <span class="text-danger text-end">$0.00</span>
                            </div>
                            <div class="space">
                                <span>Sale Taxes:</span>
                                <span class="text-danger text-end">$0.00</span>
                            </div>
                            <div class="space my-2">
                                <h6>Total:</h6>
                                <h6 class="text-danger text-end">${{ $total }}</h6>
                            </div>
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
