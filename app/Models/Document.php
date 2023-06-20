<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Document extends Model
{

    protected $fillable = [
        'user_id',
        'business_license',
        'business_license_status',
        'rcic_license',
        'rcic_license_status',
        'pmr_course_certificate',
        'pmr_course_certificate_status',
        'client_review_links',
        'client_review_links_status',
        'reference_details',
        'reference_details_status',
        'physical_office',
        'physical_office_status',
        'previous_client_details',
        'previous_client_details_status',
        'case_approval',
        'case_approval_status',
        'social_score',
        'social_score_value',
        'social_score_status',
        'case_approval_rate',
        'trust_score'
    ];

    /**
     * many to one
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
