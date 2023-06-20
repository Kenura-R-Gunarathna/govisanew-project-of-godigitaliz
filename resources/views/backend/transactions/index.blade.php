@extends('backend.layouts.admin')
@push('scripts_head')  
     <link href="{{ asset('backend/css/jquery.dataTables.min.css') }}" rel="stylesheet">
     <link href="{{ asset('backend/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Transactions</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="">Dashboard</a></li>
                    <li><a href=""><span>Transactions</span></a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('backend.layouts.shared.notification')
                <div class="panel panel-default border-panel card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Transactions</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                            <table id="dataTableElement" class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Stripe ID</th>
                                        <th>Stripe Price</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Ends At</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($transactions)
                                        @foreach($transactions as $transaction)
                                        <tr>
                                            <td>{{$transaction->user_id}}</td>
                                            <td>{{$transaction->stripe_id }}</td>
                                            <td>{{$transaction->stripe_price }}</td>
                                            <td>{{$transaction->quantity }}</td>
                                            <td><span class="label label-primary">{{$transaction->stripe_status  }}</span></td>
                                            <td>{{ \Carbon\Carbon::parse($transaction->ends_at)->format('Y-m-d') }}</td>
                                            <td>{{  \Carbon\Carbon::parse($transaction->created_at)->format('Y-m-d') }}</td>
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

@push('scripts_footer')  
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.bootstrap.min.js') }}"></script>

    <script type="text/javascript">
    	jQuery(document).ready(function(){
			$('#dataTableElement').DataTable();
    	});    		
	</script>
    
@endpush
