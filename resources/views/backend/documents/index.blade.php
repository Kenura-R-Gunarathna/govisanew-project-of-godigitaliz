@extends('backend.layouts.admin')
@push('scripts_head')  
     <link href="{{ asset('backend/css/jquery.dataTables.min.css') }}" rel="stylesheet">
     <link href="{{ asset('backend/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
	 <link href="{{ asset('backend/css/responsive.dataTables.min.css') }}" rel="stylesheet">
	 <link href="{{ asset('backend/css/dialog.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Verification</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li><a href=""><span>Verification</span></a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('backend.layouts.shared.notification')
                <div class="panel panel-default border-panel card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Profile Verification</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                            <table class="table mb-0" id="dataTableElement">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($documents)   
                                        @foreach($documents as $document)                 
                                            <tr>
                                                <td>{{ $document->user->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($document->created_at)->format('Y-m-d') }}</td>
                                                <td>
                                                   <a href="{{ route('admin.documents.edit',   $document->id) }}" class="btn btn-xs btn-primary">Edit</a>  
                                                  <button type="button" id="delete" data-id="{{ $document->id }}" class="btn btn-xs btn-default">Delete</button>  
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
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>  
    <script src="{{ asset('backend/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/dialog.js') }}"></script>
    <script type="text/javascript">
    	jQuery(document).ready(function(){
            
            $('#dataTableElement').DataTable();

            $('#dataTableElement').delegate('#delete', 'click', function(){
                    let id = $(this).attr('data-id');  
                    lnv.confirm({
                        title: 'Confirm',
                        content: 'Are you sure you want to delete this document?',
                        confirmBtnText: 'Yes',
                        confirmHandler: function(){
                            var url = '{{ route('admin.documents.delete', ':id') }}';
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
                    })	
            });
    	});    		
	</script>
    
@endpush
