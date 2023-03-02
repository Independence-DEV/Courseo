<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $account->name }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        .card-element {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            background-color: #f9f9fa;
        }
    </style>

@yield('style')

<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="antialiased">
<header class="text-gray-600 body-font">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0" href="{{ route('account.index', ['domain' => $domain]) }}">
            <img style="max-height: 50px;" src="{{ $config->logo }}" alt="">
            <span class="ml-3 text-xl">{{ $account->name }}</span>
        </a>
    </div>
</header>


<section class="text-gray-600 body-font relative">
    <div class="container px-5 py-6 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">{{ $course->title }}</h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">{{ __('Please fill this form to process the payement and have access to the course.') }}</p>
        </div>
        <div class="lg:w-1/2 md:w-2/3 mx-auto">
            <form id="payment-form"
                  action="{{ route('account.memberarea.course.processpayment', ['domain' => $domain, 'courseSlug' => $course->slug, 'prospectId' => $prospect->id]) }}"
                  method="POST">
            @csrf
            <input id="client_secret" name="client_secret" type="hidden" value="{{$intent['client_secret']}}">
            <input id="stripe_id" name="stripe_id" type="hidden" value="{{$intent['id']}}">
            <div class="flex flex-wrap -m-2">
                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                        <input type="text" id="name" name="name" value="{{ $prospect->name }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                </div>
                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                        <input type="email" id="email" name="email" value="{{ $prospect->email }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                </div>
                <div class="p-2 w-full">
                        <div class="form-row">
                            <label for="card-element">Carte de crédit ou débit :</label>
                            <div id="card-element" class="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                </div>
                <div class="p-2 w-full">
                    <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                        {{ __('Pay') }} {{ $course->price }} €</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>

<footer class="text-gray-600 body-font">
    <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
        <p class="text-sm text-gray-500 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">
            {{ __('Powered by') }}<a href="https://courseo.xyz/" class="underline text-gray-600 ml-1" rel="noopener noreferrer" target="_blank">Courseo</a>
        </p>
    </div>
</footer>
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ $configPayment->stripe_publishable_key }}');
    var elements = stripe.elements();
    var cardElement = elements.create('card', {
        style: {
        base: {
                fontWeight: '500',
                fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
                fontSize: '16px',
                fontSmoothing: 'antialiased',
            },
        },
    });
    cardElement.mount('#card-element');

    cardElement.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        let secretIntent = jQuery('#client_secret').val();
        stripe.confirmCardPayment(
            secretIntent,
            {
                payment_method: {card: cardElement}
            }
        ).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the data to your server.
                form.submit();
            }
        });
    });

</script>
</html>

