@extends('frontend.layouts.guest')
@push('scripts_head')  
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style type="text/css">
    .select2-container--default .select2-selection--single {
        border: none !important;
        background-color: #fff5eb !important;
    }
    </style>
@endpush
@section('content')
    <section id="homeSectionHero">
        <div class="container">
            <div id="heroContentRow" class="row">
                <div class="col-md-6">
                    <h1 class="display-5 fw-bold">Top 1% Trusted and Verified Immigration Consultant near you</h1>
                    <p class="lead mb-5 fw-semibold">Work with the best immigration consultants Risk-Free and save thousands of dollars in the process. </p>
                   
                   
                    <form method="get" action="{{url('search')}}" class="row m-0 g-3 mb-3 mt-5" style="border: 1px solid #969696; border-radius: 4px;">
                        <input name="keyword" class="col-md-8 mt-1 pb-1" placeholder="What are you looking for?"style="outline: none;">
                          
                        
                        <div class="col-md-4 mt-2 pb-2">
                            <button type="submit" class="btn btn-primary w-100">Search</button>
                        </div>
                    </form>
                  
                  
                  
                    <p class="fw-semibold">Popular Searches : <span class="text-muted fw-normal"><a href="{{ route('category', 'consultant') }}" class="text-decoration-none">Immigration Consultant</a>, <a href="{{ route('category', 'lawyer') }}" class="text-decoration-none">Immigration Lawyer</a></span></p>
                    <hr>
                     <p class="fw-semibold d-inline">Popular Cities :
                        @foreach($popularLocations as $pl)
                          <div class="d-inline"><a href="{{ route('search', ['location' => $pl->id]) }}" class="text-decoration-none">{{ $pl->name }}, </a></div>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>

    </section>
   
    <section style="background-color: #FFFFFF;">
        <div class="container">
            <h2 class="fw-bold">Most recommended consultants</h2>
            <p class="mb-5">These consultants have tons of clients who think they're simply the best.</p>
            <div class="cus-user-card-row row">
                @if($mostRecommendedProviders)
                    @foreach($mostRecommendedProviders as $data)
                    
                        <div class="col-md-3 ">
                            <a href="{{ route('profile', $data->slug) }}" class="card d-flex justify-content-center p-3 text-decoration-none h-100">
                                <div class="row m-0">
                                    <div class="col p-0 text-center">
                                        <img class="rounded-circle user-img" src="{{ ($data->profile && $data->profile->avatar) ? $data->profile->avatar : asset('backend/images/avatar.png') }}" alt="{{ $data->name }}">
                                        <h5>{{ $data->name }}</h5>
                                        <p>{{ ($data->profile->position) ? $data->profile->position : '-' }} - {{ ($data->profile->company) ? $data->profile->company : '-' }}</p>
                                       
                                        <button class="btn btn-pill btn-light rounded-pill cus-btn-user-card-1">
                                            <i class="bi-star-fill"></i><span>{{ $data->review_positve() }} Recommendations</span>
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    
                    
                    @endforeach
                @endif
            </div>
        </div>
    </section>


    <section style="background-color: #F1F1FE;">
        <div class="container">
            <h2 class="fw-bold">Local consultants in surrey</h2>
            <p class="mb-5">Experienced guides who can help you navigate your new neighbourhood.</p>
            <div class="cus-user-card-row row">
                @if($mostRecommendedProviders2)
                    @foreach($mostRecommendedProviders2 as $data)

                    <div class="col-md-3 ">
                        <a href="{{ route('profile', $data->slug) }}" class="card d-flex justify-content-center p-3 text-decoration-none h-100">
                            <div class="row m-0">
                                <div class="col p-0 text-center">
                                    <img class="rounded-circle user-img" src="{{ ($data->profile && $data->profile->avatar) ? $data->profile->avatar : asset('backend/images/avatar.png') }}" alt="{{ $data->name }}">
                                    <h5>{{ $data->name }}</h5>
                                    <p>{{ ($data->profile->position) ? $data->profile->position : '-' }} - {{ ($data->profile->company) ? $data->profile->company : '-' }}</p>
                                   
                                    <button class="btn btn-pill btn-light rounded-pill cus-btn-user-card-1">
                                        <i class="bi-star-fill"></i><span>{{ $data->review_positve() }} Recommendations</span>
                                    </button>
                                </div>
                            </div>
                        </a>
                    </div>

                    @endforeach
                @endif
            </div>
        </div>
    </section>


    <section style="background-color: #FFFFFF;">
        <div class="container">
            <h2 class="fw-bold">Local consultants in vancouver</h2>
            <p class="mb-5">Experienced guides who can help you navigate your new neighbourhood.</p>
            <div class="cus-user-card-row row">
                @if($mostRecommendedProviders3)
                    @foreach($mostRecommendedProviders3 as $data)
                         <div class="col-md-3 ">
                            <a href="{{ route('profile', $data->slug) }}" class="card d-flex justify-content-center p-3 text-decoration-none h-100">
                                <div class="row m-0">
                                    <div class="col p-0 text-center">
                                        <img class="rounded-circle user-img" src="{{ ($data->profile && $data->profile->avatar) ? $data->profile->avatar : asset('backend/images/avatar.png') }}" alt="{{ $data->name }}">
                                        <h5>{{ $data->name }}</h5>
                                        <p>{{ ($data->profile->position) ? $data->profile->position : '-' }} - {{ ($data->profile->company) ? $data->profile->company : '-' }}</p>
                                       
                                        <button class="btn btn-pill btn-light rounded-pill cus-btn-user-card-1">
                                            <i class="bi-star-fill"></i><span>{{ $data->review_positve() }} Recommendations</span>
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts_footer')  
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            var url = "{{ route('search.suggestions') }}";
            $('.search').select2({
                placeholder: 'What are you looking for?',
                width: 'resolve',
                ajax: {
                  url: url,
                  dataType: 'json',
                  processResults: function (data) {
                    return {
                      results:  $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.name
                            }
                        })
                    };
                  },
                  cache: true
                }
            });
        });         
    </script>
    
@endpush