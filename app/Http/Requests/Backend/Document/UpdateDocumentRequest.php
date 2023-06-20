<?php
namespace App\Http\Requests\Backend\Document;

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
            'business_license_status'    => 'required',
            'rcic_license_status'    => 'required',
            'pmr_course_certificate_status'    => 'required',
            'client_review_links_status'    => 'required',
            'reference_details_status'    => 'required',
            'physical_office_status'    => 'required',
            'previous_client_details_status'    => 'required',
            'case_approval_status'    => 'required',
            'business_license_status'    => 'required',
            'case_approval_rate' => 'required',
            'social_score_value' => 'required',
        ];
    }
}
