
@extends('teacher.layout')

@section('content')
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Styles -->
        <style>
            .alert.parsley {
                margin-top: 5px;
                margin-bottom: 0px;
                padding: 10px 15px 10px 15px;
            }
            .check .alert {
                margin-top: 20px;
            }
            .credit-card-box{
                margin: auto;
                background-color: #fff;
                background-clip: border-box;
                border: 1px solid rgba(0,0,0,0.125);
                border-radius: .25rem;
                padding: 25px 50px;
                margin-bottom: 200px;
                margin-top: 40px;
                max-width: 700px;
                width: 60%;
            }
            .credit-card-box .panel-title {
                display: inline;
                font-weight: bold;
            }
            .credit-card-box .display-td {
                width: 100%;
                text-align: center;
            }
            .credit-card-box .display-tr {
                display: table-row;
            }
            .btn-order {
                background: #412A7F;
            }
            .btn-order:hover {
                background: #513A8F;
            }
        </style>
        <!-- JavaScripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    </head>
    <body id="app-layout">
    <div class="container">
        <div class="row" style="margin-top: 100px;">
            <div style="width: 100%; margin-top: 60px;">
                <img class="img-responsive" src="{{asset('/public/assets/img/logo2.png')}}" style="margin: auto;">
            </div>
                <div class="panel panel-default credit-card-box">
                    <div class="display-table" >
                        <div class="row display-tr"  style="display: flex">
                            <div style="margin: auto;">

                                <h3 class="display-td" >Payment Details</h3>
                                <div class="display-td" >
                                    <img class="img-responsive" style="width: 100%;" src="{{asset('/public/assets/img/accepted_c22e0.png')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            {!! Form::open(['url' => route('order-post'), 'data-parsley-validate', 'id' => 'payment-form']) !!}
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <div class="form-group" id="product-group">
                                {!! Form::label('plane', 'Select Plan:') !!}
                                {!! Form::select('plane', ['price_1HdcDnD7UXW8UA7jEfdpQtpQ' => 'EDUCATOR ($20)'], null, [
                                    'class'                       => 'form-control',
                                    'required'                    => 'required',
                                    'data-parsley-class-handler'  => '#product-group'
                                    ]) !!}
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div id="card-element"></div>
                                    </div>
                                </div>

                            </div>
                            <img class="img-responsive pull-right" src="{{asset('/public/assets/img/stripe-payment-logo.png')}}" style="margin-bottom: 30px; width: 150px; height: 80px;">
                            <div style="font-size: 14px; font-weight: normal; color: black; margin-bottom: 20px;">
                                Note: This is a $20 per month subscription. Your method of payment will be charged automatically each month.
                                You can cancel your subscription at any time from your educator account.
                            </div>
                            <div class="form-group">
                                <button id="card-button" class="btn btn-lg btn-block btn-primary btn-order">Place order!</button>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="payment-errors" id="card-errors" style="color: red;margin-top:10px;"></span>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
        </div>

    </div>
    </body>

<!-- PARSLEY -->
<script>
    window.ParsleyConfig = {
        errorsWrapper: '<div></div>',
        errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
        errorClass: 'has-error',
        successClass: 'has-success'
    };
</script>

<script src="https://parsleyjs.org/dist/parsley.js"></script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    var style = {
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    const stripe = Stripe('{{ env("STRIPE_KEY") }}', { locale: 'en' }); // Create a Stripe client.
    const elements = stripe.elements(); // Create an instance of Elements.
    const card = elements.create('card', { style: style }); // Create an instance of the card Element.

    card.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

    card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');


    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>

@endsection
@include('layouts.analytics')
