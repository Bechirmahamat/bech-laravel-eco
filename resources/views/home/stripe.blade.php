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

</head>

<body>

    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <div class="container my-2 mb-5 mx-auto">

            <h3 class="text-left mb-3">payment using <span class="text-danger">stripe</span></h3>

            @if (Session::has('success'))
                <div class="">
                    <p class=" alert alert-success text-center"">{{ Session::get('success') }} <a href="#"
                            class="close" data-dismiss="alert" aria-label="close">×</a>
                    </p>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-10 mx-auto "
                        style=" padding:20px; box-shadow:0 0 10px rgba(0,0,0,0.1)">
                        <div class="panel panel-default credit-card-box ">

                            <div class="">
                                <div class="mb-3 text-center">
                                    <h4>total price: <span class="text-danger">${{ session('total') }}</span></h4>
                                    <hr>
                                </div>


                                {{-- " --}}
                                <form role="form" action="{{ route('stripe.post', $id) }}" method="post"
                                    class="require-validation mx-auto" data-cc-on-file="false"
                                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                    @csrf

                                    <div class='form-group my-2 required'>
                                        <label class='form-label'>Name on Card</label>
                                        <input class='form-control' size='4' type='text'>
                                    </div>
                                    <div class='form-group my-2 required'>
                                        <label class='form-label'>Card Number</label>
                                        <input autocomplete='off' class='form-control card-number' size='20'
                                            type='text'>
                                    </div>
                                    <div class=' my-2 row'>
                                        <div class='col-md-4 form-group cvc required'>
                                            <label class='form-label'>CVC</label> <input autocomplete='off'
                                                class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                type='text'>
                                        </div>
                                        <div class='col-md-4 form-group expiration required'>
                                            <label class='form-label'>Exp Month</label> <input
                                                class='form-control card-expiry-month' placeholder='MM' size='2'
                                                type='text'>
                                        </div>
                                        <div class='col-md-4 form-group expiration required'>
                                            <label class='form-label '>Exp Year</label> <input
                                                class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                type='text'>
                                        </div>
                                    </div>

                                    <div class='form-group '>
                                        <div class=' error hide'>
                                            <p class='alert-danger alert '>Please correct the errors and try
                                                again.</p>
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <button class="btn btn-primary w-100 btn-block" type="submit">Pay Now
                                        </button>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    @include('home.footer')
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function() {

            /*------------------------------------------
            --------------------------------------------
            Stripe Payment Code
            --------------------------------------------
            --------------------------------------------*/

            var $form = $(".require-validation");

            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            /*------------------------------------------
            --------------------------------------------
            Stripe Response Handler
            --------------------------------------------
            --------------------------------------------*/
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];

                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>

</html>
