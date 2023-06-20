@component('mail::message')
# You have a new inquiry
 
##### Name
{{ $data['name'] }}

##### Email
{{ $data['email'] }}

##### Subject
{{ $data['subject'] }}

##### Message
{{ $data['message'] }}

@endcomponent