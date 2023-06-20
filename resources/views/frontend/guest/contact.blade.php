@extends('frontend.layouts.guest')

@section('content')
    <div class="mt-5 conatiner">
        <div class="text-center">
            <h3 class="text-danger">How Can We Help You?</h3>
            <p class="lead">Lorem ipsum, dolor sit amet consectetur adipisic</p>
        </div>
        <div class=" d-flex align-items-center justify-content-center">
            <div class="bg-white col-md-4">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-warning">{{ session('error') }}</div>
                @endif
               <form method="POST" action='{{ route("contact.process") }}' class="p-4 rounded shadow-md">
                @csrf
                    <div>
                        <label for="name" class="form-label">Your Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="Your Name">
                        @error('name')
                        <div class="alert alert-danger">
                           {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="email" class="form-label">Your Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Your Email">
                        @error('email')
                        <div class="alert alert-danger">
                           {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="subject" class="form-label">Subject:</label>
                        <input type="text" name="subject" class="form-control" placeholder="Subject">
                        @error('subject')
                        <div class="alert alert-danger">
                           {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mt-3 mb-3">
                        <label for="message" class="form-label">Message:</label>
                        <textarea name="message" cols="20" rows="6" class="form-control"placeholder="message"></textarea>
                        @error('message')
                        <div class="alert alert-danger">
                           {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
               </form>
            </div>
        </div>
    </div>  
    
@endsection
