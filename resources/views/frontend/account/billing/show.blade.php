@extends('frontend.layouts.account')
@push('scripts_head')  
    <script src="https://js.stripe.com/v3/"></script>
@endpush
@section('content')
<div class="container">
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Billing</h5>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{route('account.dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('account.billing')}}"><span>Billing</span></a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @include('frontend.layouts.shared.notification')
            <div class="panel panel-default border-panel card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Billing</h6>
                    </div>
                    <div class="pull-right">
                        <a href="{{route('account.billing')}}" class="btn btn-sm btn-primary"><span class="btn-text">Back</span></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper">
                    <div class="panel-body">
                        <div class="card-header">
                            <span style="color:black;font-weight:bold;"> You have selected <span style="color:red;font-weight:bold;"> {{ $plan->name }} </span> Plan for $ {{ number_format($plan->price, 2) }} </span>
                        </div>
                        <br />
                        <div class="card-body">
                            <p>
                            You'll be charged automatically based on the purchase date of each month.
                            </p></br>
                            <form id="payment-form" action="{{ route('account.billing.create') }}" method="POST">
                                @csrf
                                <input type="hidden" name="plan" id="plan" value="{{ $plan->id }}">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Card holder name : </label>
                                            <input type="text" name="name" id="card-holder-name" class="form-control" value="{{ auth()->user()->name }}" readonly>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Card details</label>
                                    <div id="card-element"></div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <hr>
                                <button type="submit" class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">Purchase</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    @endsection

@push('scripts_footer')  
   
    <script>
        const stripe = Stripe("{{config('services.stripe.key')}}");
        const elements = stripe.elements()
        const cardElement = elements.create('card')

        cardElement.mount('#card-element')

        const form = document.getElementById('payment-form')
        const cardBtn = document.getElementById('card-button')
        const cardHolderName = document.getElementById('card-holder-name')

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

@endpush