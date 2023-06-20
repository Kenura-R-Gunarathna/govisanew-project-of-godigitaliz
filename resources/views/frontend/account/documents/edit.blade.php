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
                    <li><a href="{{route('account.documents.verify')}}"><span>Verify</span></a></li>
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
                            <a href="{{route('account.documents.verify')}}" class="btn btn-sm btn-primary"><span class="btn-text">Back</span></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper">
                        <div class="panel-body">
                   
                        <form method="POST" action='{{ route("account.documents.update", $document->id) }}'  enctype="multipart/form-data">
                                @csrf
                               <div class="row">
                                   <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="business_license">Business License:</label>
                                            <input class="form-control" type="file" name="business_license">      
                                            @error('business_license')
                                            <div class="alert alert-info alert-dismissable alert-style-1">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <i class="zmdi zmdi-info-outline"></i>{{ $message }}
                                            </div>
                                            @enderror
                                        </div>   
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="rcic_license">RCIC License:</label>
                                            <input class="form-control" type="file" name="rcic_license">      
                                            @error('rcic_license')
                                            <div class="alert alert-info alert-dismissable alert-style-1">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <i class="zmdi zmdi-info-outline"></i>{{ $message }}
                                            </div>
                                            @enderror
                                        </div>   
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="pmr_course_certificate">PMR Course Certificate:</label>
                                            <input class="form-control" type="file" name="pmr_course_certificate">     
                                            @error('pmr_course_certificate')
                                            <div class="alert alert-info alert-dismissable alert-style-1">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <i class="zmdi zmdi-info-outline"></i>{{ $message }}
                                            </div>
                                            @enderror
                                        </div>   
                                    </div> 
                                  
                                    <div class="col-md-12">
                                        <p>Case approvals:  <button  type="button" id="add_ca_row" class="btn btn-sm btn-default pull-right">Add New</button></p>
                                        <hr class="light-grey-hr">
                                    </div>

                                    <div class="col-md-12">
                                        <table class="table mb-0" id="TableCaseApprovals">
                                            <thead>
                                                <tr>
                                                    <th>File</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input class="form-control" type="file" name="case_approval[]"></td>
                                                    <td><button type="button" class="btn btn-primary btn-xs" id="delete_ca_row">delete</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-12">
                                        <p>Client Review Links:</p>
                                        <hr class="light-grey-hr">
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="google_review_link">Google Review Link:</label>
                                            @php
                                            if(isset($document->client_review_links)){
                                               $link = json_decode($document->client_review_links);
                                            }
                                            @endphp
                                            <input 
                                            class="form-control" 
                                            type="text" 
                                            name="google_review_link"
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
                                            name="trustpilot_link" 
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

                                    <div class="col-md-12">
                                        <p>Social Score:  <button  type="button" id="add_ss_row" class="btn btn-sm btn-default pull-right">Add Row</button></p>
                                        <hr class="light-grey-hr">
                                    </div>

                                    <div class="col-md-12">
                                        <table class="table mb-0" id="TableSocialScore">
                                            <thead>
                                                <tr>
                                                    <th>Link</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($document->social_score))
                                                    @php
                                                       $links = json_decode($document->social_score);
                                                    @endphp
                                                    @foreach($links as $link)
                                                    <tr>
                                                        <td><input class="form-control" type="text" name="social_score[]" value="{{ $link }}"></td>
                                                        <td><button type="button" class="btn btn-primary btn-xs" id="delete_ss_row">delete</button></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td><input class="form-control" type="text" name="social_score[]"></td>
                                                        <td><button type="button" class="btn btn-primary btn-xs" id="delete_ss_row">delete</button></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-12">
                                        <p>Physical Office:  <button  type="button" id="add_po_row" class="btn btn-sm btn-default pull-right">Add Row</button></p>
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
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($document->physical_office))
                                                    @php
                                                        $physical_offices = json_decode($document->physical_office);
                                                    @endphp
                                                    @foreach($physical_offices as $physical_office)
                                                    <tr>
                                                        <td><input class="form-control" type="text" name="physical_office[building][]" value="{{ (isset($physical_office->building)) ? $physical_office->building : '' }}"></td>
                                                        <td><input class="form-control" type="text" name="physical_office[address1][]" value="{{ (isset($physical_office->address1)) ? $physical_office->address1 : '' }}"></td>
                                                        <td><input class="form-control" type="text" name="physical_office[address2][]" value="{{ (isset($physical_office->address2)) ? $physical_office->address2 : '' }}"></td>
                                                        <td><input class="form-control" type="text" name="physical_office[city][]"     value="{{ (isset($physical_office->city)) ? $physical_office->city : '' }}"></td>
                                                        <td><input class="form-control" type="text" name="physical_office[province][]" value="{{ (isset($physical_office->province)) ? $physical_office->province : '' }}"></td>
                                                        <td><input class="form-control" type="text" name="physical_office[zip_code][]" value="{{ (isset($physical_office->zip_code)) ? $physical_office->zip_code : '' }}"></td>
                                                        <td><button type="button" class="btn btn-primary btn-xs" id="delete_po_row">delete</button></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td><input class="form-control" type="text" name="physical_office[building][]"></td>
                                                        <td><input class="form-control" type="text" name="physical_office[address1][]"></td>
                                                        <td><input class="form-control" type="text" name="physical_office[address2][]"></td>
                                                        <td><input class="form-control" type="text" name="physical_office[city][]"></td>
                                                        <td><input class="form-control" type="text" name="physical_office[province][]"></td>
                                                        <td><input class="form-control" type="text" name="physical_office[zip_code][]"></td>
                                                        <td><button type="button" class="btn btn-primary btn-xs" id="delete_po_row">delete</button></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-12">
                                        <p>Reference Details:  <button  type="button" id="add_rd_row" class="btn btn-sm btn-default pull-right">Add Row</button></p>
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
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($document->reference_details))
                                                    @php
                                                        $reference_details = json_decode($document->reference_details);
                                                    @endphp
                                                    @foreach($reference_details as $reference_detail)
                                                    <tr>
                                                        <td><input class="form-control" type="text" name="reference_details[name][]"    value="{{ (isset($reference_detail->name)) ? $reference_detail->name : '' }}"></td>
                                                        <td><input class="form-control" type="text" name="reference_details[company][]" value="{{ (isset($reference_detail->company)) ? $reference_detail->company : '' }}"></td>
                                                        <td><input class="form-control" type="email" name="reference_details[email][]"  value="{{ (isset($reference_detail->email)) ? $reference_detail->email : '' }}"></td>
                                                        <td><input class="form-control" type="text" name="reference_details[phone][]"   value="{{ (isset($reference_detail->phone)) ? $reference_detail->phone : '' }}"></td>
                                                        <td><button type="button" class="btn btn-primary btn-xs" id="delete_rd_row">delete</button></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td><input class="form-control" type="text" name="reference_details[name][]"></td>
                                                        <td><input class="form-control" type="text" name="reference_details[company][]"></td>
                                                        <td><input class="form-control" type="email" name="reference_details[email][]"></td>
                                                        <td><input class="form-control" type="text" name="reference_details[phone][]"></td>
                                                        <td><button type="button" class="btn btn-primary btn-xs" id="delete_rd_row">delete</button></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-12">
                                        <p>Previous Client Details:  <button  type="button" id="add_pcd_row" class="btn btn-sm btn-default pull-right">Add Row</button></p>
                                        <hr class="light-grey-hr">
                                    </div>

                                    
                                    <div class="col-md-12">
                                        <table class="table mb-0" id="TablePreviousClientDetails">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Contact</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               @if(isset($document->previous_client_details))
                                                    @php
                                                        $previous_client_details = json_decode($document->previous_client_details);
                                                    @endphp
                                                    @foreach($previous_client_details as $previous_client_detail)
                                                    <tr>
                                                        <td><input class="form-control" type="text" name="previous_client_details[name][]" value="{{ (isset($previous_client_detail->name)) ? $previous_client_detail->name : '' }}"></td>
                                                        <td><input class="form-control" type="text" name="previous_client_details[contact][]" value="{{ (isset($previous_client_detail->contact)) ? $previous_client_detail->contact : '' }}"></td>
                                                        <td><button type="button" class="btn btn-primary btn-xs" id="delete_pcd_row">delete</button></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td><input class="form-control" type="text" name="previous_client_details[name][]"></td>
                                                        <td><input class="form-control" type="text" name="previous_client_details[contact][]"></td>
                                                        <td><button type="button" class="btn btn-primary btn-xs" id="delete_pcd_row">delete</button></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
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

@push('scripts_footer')  

    <script type="text/javascript">
    	jQuery(document).ready(function(){

            $("#add_ss_row").click(function(){
                $('#TableSocialScore').find('tbody').append('<tr><td><input class="form-control" type="text" name="social_score[]"></td><td><button type="button" class="btn btn-primary btn-xs" id="delete_ss_row">delete</button></td></tr>');
            });

            $('#TableSocialScore').delegate('#delete_ss_row', 'click', function(){
                $(this).closest("tr").remove();
	        });

            $("#add_po_row").click(function(){
                $('#TablePhysicalOffice').find('tbody').append('<tr><td><input class="form-control" type="text" name="physical_office[building][]"></td><td><input class="form-control" type="text" name="physical_office[address1][]"></td><td><input class="form-control" type="text" name="physical_office[address2][]"></td><td><input class="form-control" type="text" name="physical_office[city][]"></td><td><input class="form-control" type="text" name="physical_office[province][]"></td><td><input class="form-control" type="text" name="physical_office[zip_code][]"></td><td><button type="button" class="btn btn-primary btn-xs" id="delete_po_row">delete</button></td></tr>');
            });

            $('#TablePhysicalOffice').delegate('#delete_po_row', 'click', function(){
                $(this).closest("tr").remove();
	        });


            $("#add_rd_row").click(function(){
                $('#TableReferenceDetails').find('tbody').append('<tr><td><input class="form-control" type="text" name="reference_details[name][]"></td><td><input class="form-control" type="text" name="reference_details[company][]"></td><td><input class="form-control" type="text" name="reference_details[email][]"></td> <td><input class="form-control" type="text" name="reference_details[phone][]"></td><td><button type="button" class="btn btn-primary btn-xs" id="delete_rd_row">delete</button></td></tr>');
            });

            $('#TableReferenceDetails').delegate('#delete_rd_row', 'click', function(){
                $(this).closest("tr").remove();
	        });

            $("#add_pcd_row").click(function(){
                $('#TablePreviousClientDetails').find('tbody').append('<tr><td><input class="form-control" type="text" name="previous_client_details[name][]"></td><td><input class="form-control" type="text" name="previous_client_details[contact][]"></td><td><button type="button" class="btn btn-primary btn-xs" id="delete_pcd_row">delete</button></td></tr>');  
            });

            $('#TablePreviousClientDetails').delegate('#delete_pcd_row', 'click', function(){
                $(this).closest("tr").remove();
	        });

            $("#add_ca_row").click(function(){
                $('#TableCaseApprovals').find('tbody').append('<tr><td><input class="form-control" type="file" name="case_approval[]"></td><td><button type="button" class="btn btn-primary btn-xs" id="delete_ca_row">delete</button></td></tr>');  
            });

            $('#TableCaseApprovals').delegate('#delete_ca_row', 'click', function(){
                $(this).closest("tr").remove();
	        });   
    	});    		
	</script>
    
@endpush
