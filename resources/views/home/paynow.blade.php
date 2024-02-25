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
                <h4 class="my-3"> Payment <span class="text-danger">proccess </span></h4>
                <div class="row text-center mx-auto">
                    <div class="mx-auto col-lg-6 col-md-8 col-sm-10 text-center">
                        <h6>Total Amount: <span class="text-danger">{{ session('total') }}</span></h6>
                        <div id="paypal-button-container"></div>
                    </div>
                </div>

            </div>
        </section>

    </div>

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}"></script>


    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ session('total') }}' // Set the desired amount
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Payment is successful, you can perform further actions
                    console.log(details);
                });
            },
            onError: function(err) {
                // Handle error situations
                console.log(err);
            }
        }).render('#paypal-button-container');
    </script>

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
