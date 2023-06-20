@extends('frontend.layouts.account')
@section('content')
<div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Verify</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{route('account.dashboard')}}">Dashboard</a></li>
                    <li><a href=""><span>Verify</span></a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('frontend.layouts.shared.notification')
                <div class="panel panel-default border-panel card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Profile Verification</h6>
                        </div>
                        <div class="pull-right">
                           @if(isset($document) && !empty($document))
                             <a href="{{route('account.documents.edit', $document->id)}}" class="btn btn-sm btn-primary"><span class="btn-text">Update Now</span></a>
                           @else
                             <a href="{{route('account.documents.create')}}" class="btn btn-sm btn-primary"><span class="btn-text">Verify Now</span></a>
                           @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                       function status($class){
                                          if($class == 'approved'){
                                            return 'default';
                                          }elseif($class == 'rejected'){
                                            return 'danger';
                                          }else{
                                            return 'primary';
                                          }
                                       }
                                    @endphp
                                    <tr>
                                        <td>1</td>
                                        <td>Business license</td>
                                        <td>
                                            @if(isset($document))
                                              <span class="label label-{{ status($document->business_license_status)  }}">{{ $document->business_license_status }}</span> 
                                            @else
                                              <span class="label label-primary">pending</span> 
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>RCIC license</td>
                                        <td>
                                            @if(isset($document))
                                            <span class="label label-{{ status($document->rcic_license_status)  }}">{{ $document->rcic_license_status }}</span>
                                            @else
                                              <span class="label label-primary">pending</span> 
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>3</td>
                                        <td>PMR course certificate</td>
                                        <td>
                                            @if(isset($document))
                                            <span class="label label-{{ status($document->pmr_course_certificate_status)  }}">{{ $document->pmr_course_certificate_status }}</span>
                                            @else
                                              <span class="label label-primary">pending</span> 
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>4</td>
                                        <td>Client review links</td>
                                        <td>
                                            @if(isset($document))
                                            <span class="label label-{{ status($document->client_review_links_status)  }}">{{ $document->client_review_links_status }}</span> 
                                            @else
                                              <span class="label label-primary">pending</span> 
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>5</td>
                                        <td>Reference details</td>
                                        <td>
                                            @if(isset($document))
                                            <span class="label label-{{ status($document->reference_details_status)  }}">{{ $document->reference_details_status }}</span> 
                                            @else
                                              <span class="label label-primary">pending</span> 
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>6</td>
                                        <td>Physical office</td>
                                        <td>
                                            @if(isset($document))
                                            <span class="label label-{{ status($document->physical_office_status)  }}">{{ $document->physical_office_status }}</span> 
                                            @else
                                              <span class="label label-primary">pending</span> 
                                            @endif
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>7</td>
                                        <td>Previous client details </td>
                                        <td>
                                            @if(isset($document))
                                            <span class="label label-{{ status($document->previous_client_details_status)  }}">{{ $document->previous_client_details_status }}</span> 
                                            @else
                                              <span class="label label-primary">pending</span> 
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>8</td>
                                        <td>Case approval</td>
                                        <td>
                                            @if(isset($document))
                                            <span class="label label-{{ status($document->case_approval_status)  }}">{{ $document->case_approval_status }}</span>
                                            @else
                                              <span class="label label-primary">pending</span> 
                                            @endif
                                         </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>	
            </div>
		</div>
	</div>
@endsection
