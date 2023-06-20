@extends('frontend.layouts.account')
@section('content')
<div class="container">
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">Billing</h5>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="{{route('account.dashboard')}}">Dashboard</a></li>
				<li><a href=""><span>Billing</span></a></li>
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
					<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper">
					<div class="panel-body">
						<div class="row">
							@foreach($plans as $plan)
							<div class="col-lg-4 col-md-6 col-sm-12 mb-15">
								<div class="panel panel-pricing mb-0">
									<div class="panel-heading text-center" style="background: #f0f2f7 !important;">
										<h6>{{ $plan->name }}</h6>
										<span class="panel-price">${{ $plan->price }}/Month</span>
									</div>
									<div class="panel-body pl-0 pr-0">
										@foreach($plan->features as $item)
										<ul class="list-group mb-0">
											<li class="list-group-item"><i class="fa fa-check"></i>{{$item->name}}</li>
											<li>
												<hr class="mt-5 mb-5" />
											</li>
										</ul>
										@endforeach
									</div>
									<div class="panel-footer pb-35 text-center">
									    @if(isset($active_subscription->stripe_price) && $active_subscription->stripe_price == $plan->stripe_plan)
										  <a class="btn btn-default btn-lg" href="{{ route('account.billing.cancel', $plan->id) }}">Usubscribe</a>
										@else
										  <a class="btn btn-primary  btn-lg" href="{{ route('account.billing.show', $plan->id) }}">subscribe now</a>
										@endif
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection