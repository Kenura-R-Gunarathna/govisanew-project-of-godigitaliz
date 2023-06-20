@extends('backend.layouts.admin')
@push('scripts_head')  
	 <link href="{{ asset('backend/css/dialog.css') }}" rel="stylesheet">
@endpush
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
                            <h6 class="panel-title txt-dark">Plan Features - {{ $plan->name }}</h6>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('admin.billing') }}" class="btn btn-sm btn-primary"><span class="btn-text">Back</span></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                            <table id="dataTableElement" class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Value</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($plan->features)
                                        @foreach($plan->features as $feature)
                                        <tr>
                                            <td>{{ $feature->name }}</td>
                                            <td>
                                              <a href="{{ route('admin.billing.edit.feature', ['plan_id' => $plan->id, 'feature_id' => $feature->id]) }}" class="btn btn-xs btn-primary">Edit</a>
                                              <button type="button" id="delete" data-id="{{$feature->id}}" class="btn btn-xs btn-default">Delete</button>
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
@push('scripts_footer')  
    <script src="{{ asset('backend/js/dialog.js') }}"></script>

    <script type="text/javascript">
    	jQuery(document).ready(function(){
            $('#dataTableElement').delegate('#delete', 'click', function(){
                let id = $(this).attr('data-id');  
                var url = '{{ route('admin.billing.feature.delete', ':id') }}';
                lnv.confirm({
                    title: 'Confirm',
                    content: 'Are you sure you want to delete this feature?',
                    confirmBtnText: 'Yes',
                    confirmHandler: function(){
                        $.ajax({
                            type: 'DELETE',
                            url: url.replace(':id', id),     
                            dataType  : 'json',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(response){
                                if(response.type == "success"){
                                    location.reload();
                                }else{
                                    lnv.alert({
                                        title: 'Error',
                                        content: 'Something went wrong, Please try again later!'
                                    }); 
                                }
                            },
                            error : function (error){
                                lnv.alert({
                                    title: 'Error',
                                    content: 'Something went wrong, Please try again later!'
                                });
                            }
                        });
                    },
                    cancelBtnText: 'No',
                    cancelHandler: function(){
                
                    }
                });	
            });


    	});    		
	</script>
    
@endpush

