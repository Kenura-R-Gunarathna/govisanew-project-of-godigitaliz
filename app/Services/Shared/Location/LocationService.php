<?php

namespace App\Services\Shared\Location;

use App\Models\Location;

class LocationService
{
  
    public function getAll()
    {
        return Location::all();
    }
    
    public function getPopularLocations(){
        return Location::limit(6)->get();
    }
}
