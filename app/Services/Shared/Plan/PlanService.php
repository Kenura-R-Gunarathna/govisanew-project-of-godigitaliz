<?php

namespace App\Services\Shared\Plan;

use App\Models\Plan;
use App\Models\PlanFeature;

class PlanService
{
  
    public function getAll()
    {
        return Plan::all();
    }

    public function getById($id)
    {
        return Plan::find($id);
    }

    public function getFeatureById($id)
    {
        return PlanFeature::find($id);
    }

    public function deleteFeature($id)
    {
        $feature = $this->getFeatureById($id);
        return $feature->delete();
    }

    
    public function updateFeature($id, $data)
    {
        $feature = $this->getFeatureById($id);
        $feature->update($data);
        return  $feature;
    }

    public function delete($id)
    {
        $plan = $this->getById($id);
        return $plan->delete();
    }
}
