@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        You will be charged Rs.{{ number_format($product->price, 2) }} for {{ $product->name }} OS
                    </div>
                    <div class="card-body">
                        <form id="payment-form" action="{{ route('subscription.create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="plan" id="plan" value="{{ $product->id }}">
                            <input type="hidden" name="plan_details" id="plan" value="{{ $product }}">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" id="card-holder-name" class="form-control"
                                            value="" placeholder="Name on the card">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2" id="card-element">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Credit card number</label>
                                        <input type="text" name="card-number" id="card-number" class="form-control"
                                            value="" placeholder="Please enter card number" maxlength="12">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-xl-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="">MM</label>
                                        <input type="text" name="exp-month" id="exp-month" class="form-control"
                                            value="" placeholder="MM" maxlength="2">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="">YY</label>
                                        <input type="text" name="exp-year" id="exp-year" class="form-control"
                                            value="" placeholder="YY" maxlength="2">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="">CVV</label>
                                        <input type="text" name="cvv" id="cvv" class="form-control"
                                            value="" placeholder="CVV" maxlength="3">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <hr>
                                <button type="submit" class="btn btn-primary" id="card-button"
                                    data-secret="{{ $intent->client_secret }}">Purchase</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}')
        const elements = stripe.elements()
        const cardElement = elements.create('card')
        cardElement.mount('#card-element')
        const form = document.getElementById('payment-form')
        const cardBtn = document.getElementById('card-button')
        const cardHolderName = document.getElementById('card-holder-name');
        form.addEventListener('submit', async (e) => {
            e.preventDefault()
            cardBtn.disabled = true
            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                cardBtn.dataset.secret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
            )
            if (error) {
                cardBtn.disable = false
            } else {
                let token = document.createElement('input')
                token.setAttribute('type', 'hidden')
                token.setAttribute('name', 'token')
                token.setAttribute('value', setupIntent.payment_method)
                form.appendChild(token)
                form.submit();
            }
        })
    </script>
@endsection
