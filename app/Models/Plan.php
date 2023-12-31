<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'name',
        'slug',
        'stripe_plan',
        'price',
        'currency',
        'description',
    ];
    
    public function features()
    {
        return $this->hasMany(PlanFeature::class, 'plan_id');
    }
}
