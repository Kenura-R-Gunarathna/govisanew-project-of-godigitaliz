@extends('backend.layouts.admin')
@section('content')
<div class="container">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Verify</h5>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('admin.documents')}}"><span>Verify</span></a></li>
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
                        <div class="pull-right">
                            <a href="{{route('admin.documents')}}" class="btn btn-sm btn-primary"><span class="btn-text">Back</span></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                   
                        <form method="POST" action='{{ route("admin.documents.update", $document->id) }}'>
                                @csrf
                               <div class="row">
                                   <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="business_license">Business License:</label>
                                            <a class="btn btn-default btn-block" href="{{ (isset($document->business_license)) ? $document->business_license : ''  }}">{{ (isset($document->business_license)) ? 'attached' : 'N/A'  }}</a>     
                                            @error('business_license')
                                            <div class="alert alert-info alert-dismissable alert-style-1">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <i class="zmdi zmdi-info-outline"></i>{{ $message }}
                                            </div>
                                            @enderror

                                            <select name="business_license_status" id="business_license_status" class="form-control">
                                                <option value="pending"  {{ ($document->business_license_status == "pending") ? 'selected' : '' }}>Pending</option>
                                                <option value="approved" {{ ($document->business_license_status == "approved") ? 'selected' : '' }}>Approved</option>
                                                <option value="rejected" {{ ($document->business_license_status == "rejected") ? 'selected' : '' }}>Rejected</option>
                                            </select>

                                        </div>   
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="rcic_license">RCIC License:</label>
                                            <a class="btn btn-default btn-block" href="{{ (isset($document->rcic_license)) ? $document->rcic_license : ''  }}">{{ (isset($document->rcic_license)) ? 'attached' : 'N/A'  }}</a>     
                                            @error('rcic_license')
                                            <div class="alert alert-info alert-dismissable alert-style-1">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <i class="zmdi zmdi-info-outline"></i>{{ $message }}
                                            </div>
                                            @enderror
                                            <select name="rcic_license_status" id="rcic_license_status" class="form-control">
                                                <option value="pending"  {{ ($document->rcic_license_status == "pending") ? 'selected' : '' }}>Pending</option>
                                                <option value="approved" {{ ($document->rcic_license_status == "approved") ? 'selected' : '' }}>Approved</option>
                                                <option value="rejected" {{ ($document->rcic_license_status == "rejected") ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                        </div>   
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label mb-10">PMR Course Certificate:</label>
                                            <a class="btn btn-default btn-block" href="{{ (isset($document->pmr_course_certificate)) ? $document->pmr_course_certificate : ''  }}">{{ (isset($document->pmr_course_certificate)) ? 'attached' : 'N/A'  }}</a>     
                                            <select name="pmr_course_certificate_status" id="pmr_course_certificate_status" class="form-control">
                                                <option value="pending"  {{ ($document->pmr_course_certificate_status == "pending") ? 'selected' : '' }}>Pending</option>
                                                <option value="approved" {{ ($document->pmr_course_certificate_status == "approved") ? 'selected' : '' }}>Approved</option>
                                                <option value="rejected" {{ ($document->pmr_course_certificate_status == "rejected") ? 'selected' : '' }}>Rejected</option>
                                             </select>
                                        </div>   
                                    </div> 
                                  
                                    <div class="col-md-12">
                                        <p>Case approvals:</p>
                                        <hr class="light-grey-hr">
                                    </div>

                                    <div class="col-md-12">
                                        <table class="table mb-0" id="TableCaseApprovals">
                                            <thead>
                                                <tr>
                                                    <th>File</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($document->case_approval))
                                                    @php
                                                    $links = json_decode($document->case_approval);
                                                    @endphp
                                                    @foreach($links as $link)
                                                    <tr>
                                                       <td>
                                                        <a class="btn btn-default btn-block" href="{{ (isset($link)) ? $link : ''  }}"><i class="icon-cloud-download"></i></a>  
                                                       </td>   
                                                    </tr>
                                                    @endforeach
                                                @else
                                                <tr>
                                                    <td><input class="form-control" type="file"></td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Admin Approval:</label>
                                            <select name="case_approval_status" id="case_approval_status" class="form-control">
                                                <option value="pending"  {{ ($document->case_approval_status == "pending") ? 'selected' : '' }}>Pending</option>
                                                <option value="approved" {{ ($document->case_approval_status == "approved") ? 'selected' : '' }}>Approved</option>
                                                <option value="rejected" {{ ($document->case_approval_status == "rejected") ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Case Approval Rate:</label>
                                            <input 
                                            class="form-control" 
                                            name="case_approval_rate"
                                            type="text" 
                                            value="{{ (isset($document->case_approval_rate)) ? $document->case_approval_rate : '' }}"
                                            >      
                                            @error('case_approval_rate')
                                            <div class="alert alert-info alert-dismissable alert-style-1">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <i class="zmdi zmdi-info-outline"></i>{{ $message }}
                                            </div>
                                            @enderror
                                        </div>   
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Trust Score:</label>
                                            <input 
                                            class="form-control" 
                                            name="trust_score"
                                            type="text" 
                                            value="{{ (isset($document->trust_score)) ? $document->trust_score : '' }}"
                                            >      
                                            @error('trust_score')
                                            <div class="alert alert-info alert-dismissable alert-style-1">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <i class="zmdi zmdi-info-outline"></i>{{ $message }}
                                            </div>
                                            @enderror
                                        </div>   
                                    </div>

                                    <div class="col-md-12 mt-50">
                                        <p>Client Review Links:</p>
                                        <hr class="light-grey-hr">
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Google Review Link:</label>
                                            @php
                                            if(isset($document->client_review_links)){
                                               $link = json_decode($document->client_review_links);
                                            }
                                            @endphp
                                            <input 
                                            class="form-control" 
                                            type="text" 
                                            value="{{ (isset($link->google_review_link)) ? $link->google_review_link : '' }}"
                                            >      
                                            @error('google_review_link')
                                            <div class="alert alert-info alert-dismissable alert-style-1">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <i class="zmdi zmdi-info-outline"></i>{{ $message }}
                                            </div>
                                            @enderror
                                        </div>   
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="trustpilot_link">Trustpilot Link:</label>
                                            @php
                                            if(isset($document->client_review_links)){
                                               $link = json_decode($document->client_review_links);
                                            }
                                            @endphp
                                            <input 
                                            class="form-control" 
                                            type="text" 
                                            value="{{ (isset($link->trustpilot_link)) ? $link->trustpilot_link : '' }}"
                                            >     
                                            @error('trustpilot_link')
                                            <div class="alert alert-info alert-dismissable alert-style-1">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <i class="zmdi zmdi-info-outline"></i>{{ $message }}
                                            </div>
                                            @enderror
                                        </div>   
                                    </div> 

                                    <div class="col-md-4">
                                        <select name="client_review_links_status" id="client_review_links_status" class="form-control">
                                        <option value="pending"  {{ ($document->client_review_links_status == "pending") ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ ($document->client_review_links_status == "approved") ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ ($document->client_review_links_status == "rejected") ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                   </div> 

                                    <div class="col-md-12">
                                        <p>Social Score:</p>
                                        <hr class="light-grey-hr">
                                    </div>

                                    <div class="col-md-12">
                                        <table class="table mb-0" id="TableSocialScore">
                                            <thead>
                                                <tr>
                                                    <th>Link</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($document->social_score))
                                                    @php
                                                       $links = json_decode($document->social_score);
                                                    @endphp
                                                    @foreach($links as $link)
                                                    <tr>
                                                        <td><input class="form-control" type="text" value="{{ $link }}"></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td><input class="form-control" type="text"></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Social score:</label>
                                            <input 
                                            class="form-control" 
                                            name="social_score_value"
                                            type="text" 
                                            value="{{ (isset($document->social_score_value)) ? $document->social_score_value : '' }}"
                                            >      
                                            @error('social_score_value')
                                            <div class="alert alert-info alert-dismissable alert-style-1">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <i class="zmdi zmdi-info-outline"></i>{{ $message }}
                                            </div>
                                            @enderror
                                        </div>   
                                    </div>
                                    

                                    <div class="col-md-12">
                                        <p>Physical Office:</p>
                                        <hr class="light-grey-hr">
                                    </div>

                                    <div class="col-md-12">
                                        <table class="table mb-0" id="TablePhysicalOffice">
                                            <thead>
                                                <tr>
                                                    <th>Building #</th>
                                                    <th>Address 1</th>
                                                    <th>Address 2</th>
                                                    <th>City</th>
                                                    <th>Province</th>
                                                    <th>Zip Code</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($document->physical_office))
                                                    @php
                                                        $physical_offices = json_decode($document->physical_office);
                                                    @endphp
                                                    @foreach($physical_offices as $physical_office)
                                                    <tr>
                                                        <td><input class="form-control" type="text" value="{{ (isset($physical_office->building)) ? $physical_office->building : '' }}"></td>
                                                        <td><input class="form-control" type="text"  value="{{ (isset($physical_office->address1)) ? $physical_office->address1 : '' }}"></td>
                                                        <td><input class="form-control" type="text"  value="{{ (isset($physical_office->address2)) ? $physical_office->address2 : '' }}"></td>
                                                        <td><input class="form-control" type="text"   value="{{ (isset($physical_office->city)) ? $physical_office->city : '' }}"></td>
                                                        <td><input class="form-control" type="text"  value="{{ (isset($physical_office->province)) ? $physical_office->province : '' }}"></td>
                                                        <td><input class="form-control" type="text"  value="{{ (isset($physical_office->zip_code)) ? $physical_office->zip_code : '' }}"></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td><input class="form-control" type="text"></td>
                                                        <td><input class="form-control" type="text"></td>
                                                        <td><input class="form-control" type="text"></td>
                                                        <td><input class="form-control" type="text"></td>
                                                        <td><input class="form-control" type="text"></td>
                                                        <td><input class="form-control" type="text"></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-3 pl-10 pr-10">
                                        <select name="physical_office_status" id="physical_office_status" class="form-control">
                                        <option value="pending"  {{ ($document->physical_office_status == "pending") ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ ($document->physical_office_status == "approved") ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ ($document->physical_office_status == "rejected") ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                   </div> 

                                    <div class="col-md-12">
                                        <p>Reference Details:</p>
                                        <hr class="light-grey-hr">
                                    </div>

                                    <div class="col-md-12">
                                        <table class="table mb-0" id="TableReferenceDetails">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Company</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($document->reference_details))
                                                    @php
                                                        $reference_details = json_decode($document->reference_details);
                                                    @endphp
                                                    @foreach($reference_details as $reference_detail)
                                                    <tr>
                                                        <td><input class="form-control" type="text" value="{{ (isset($reference_detail->name)) ? $reference_detail->name : '' }}"></td>
                                                        <td><input class="form-control" type="text"  value="{{ (isset($reference_detail->company)) ? $reference_detail->company : '' }}"></td>
                                                        <td><input class="form-control" type="email"  value="{{ (isset($reference_detail->email)) ? $reference_detail->email : '' }}"></td>
                                                        <td><input class="form-control" type="text"     value="{{ (isset($reference_detail->phone)) ? $reference_detail->phone : '' }}"></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td><input class="form-control" type="text"></td>
                                                        <td><input class="form-control" type="text"></td>
                                                        <td><input class="form-control" type="email"></td>
                                                        <td><input class="form-control" type="text" ></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-3 pl-10">
                                        <select name="reference_details_status" id="reference_details_status" class="form-control">
                                        <option value="pending"  {{ ($document->reference_details_status == "pending") ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ ($document->reference_details_status == "approved") ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ ($document->reference_details_status == "rejected") ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                   </div> 
                                    
                                    <div class="col-md-12">
                                        <p>Previous Client Details:</p>
                                        <hr class="light-grey-hr">
                                    </div>

                                    
                                    <div class="col-md-12">
                                        <table class="table mb-0" id="TablePreviousClientDetails">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Contact</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               @if(isset($document->previous_client_details))
                                                    @php
                                                        $previous_client_details = json_decode($document->previous_client_details);
                                                    @endphp
                                                    @foreach($previous_client_details as $previous_client_detail)
                                                    <tr>
                                                        <td><input class="form-control" type="text" value="{{ (isset($previous_client_detail->name)) ? $previous_client_detail->name : '' }}"></td>
                                                        <td><input class="form-control" type="text"value="{{ (isset($previous_client_detail->contact)) ? $previous_client_detail->contact : '' }}"></td>
                                                        <td><button type="button" class="btn btn-primary btn-xs" id="delete_pcd_row">delete</button></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td><input class="form-control" type="text"></td>
                                                        <td><input class="form-control" type="text"></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select name="previous_client_details_status" id="previous_client_details_status" class="form-control">
                                            <option value="pending"  {{ ($document->previous_client_details_status == "pending") ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ ($document->previous_client_details_status == "approved") ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ ($document->previous_client_details_status == "rejected") ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                        </div> 
                                   </div> 

                                    <div class="col-md-12">
                                         <button type="submit" class="btn btn-sm btn-primary"><span class="btn-text">Save</span></button>
                                    </div>   
                                </div>
                            </form>

                        </div>
                    </div>
                </div>	
            </div>
		</div>
	</div>
@endsection