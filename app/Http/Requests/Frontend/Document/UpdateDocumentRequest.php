<?php
namespace App\Http\Requests\Frontend\Document;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'business_license'    => 'nullable|mimes:pdf,doc,docx,jpeg,png,jpg',
            'rcic_license'    => 'nullable|mimes:pdf,doc,docx,jpeg,png,jpg',
            'pmr_course_certificate'    => 'nullable|mimes:pdf,doc,docx,jpeg,png,jpg',
            'google_review_link'    => 'nullable|url',
            'trustpilot_link'    => 'nullable|url',
            'social_score'    => 'nullable|array',
            'physical_office'    => 'nullable|array',
            'reference_details'    => 'nullable|array',
            'previous_client_details'    => 'nullable|array',
            'case_approval'    => 'nullable',
        ];
    }
}
