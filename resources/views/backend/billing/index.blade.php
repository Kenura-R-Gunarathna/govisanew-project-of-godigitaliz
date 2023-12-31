@extends('backend.layouts.admin')
@section('content')
<div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Billing</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.billing') }}"><span>Billing</span></a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('backend.layouts.shared.notification')
                <div class="panel panel-default border-panel card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Billing</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                            <table id="dataTableElement" class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Stripe Plan</th>
                                        <th>Price</th>
                                        <th>currency</th>
                                        <th>Created</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($plans)
                                        @foreach($plans as $plan)
                                        <tr>
                                            <td>{{ $plan->name }}</td>
                                            <td>{{ $plan->stripe_plan }}</td>
                                            <td>{{ $plan->price }}</td>
                                            <td>{{ ucfirst($plan->currency) }}</td>
                                            <td>{{  \Carbon\Carbon::parse($plan->created_at)->format('Y-m-d') }}</td>
                                            <td>
                                              <a href="{{ route('admin.billing.show', $plan->id) }}" class="btn btn-xs btn-default">Update</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>	
            </div>
		</div>
	</div>
@endsection
