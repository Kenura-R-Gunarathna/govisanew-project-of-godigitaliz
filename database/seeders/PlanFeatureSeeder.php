<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlanFeature;

class PlanFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans_items = [
            [
                'plan_id' => 1, 
                'name' => 'Unlimited account, listing and review support to optimize your presence',
            ],
            [
                'plan_id' => 1, 
                'name' => 'Enhanced profile page to showcase exclusive Clutch\' features',
            ],
            [
                'plan_id' => 1, 
                'name' => 'Customized landing pages and tracking capabilities Elimination of Recommended Providers section on your profile',
            ],
            [
                'plan_id' => 1, 
                'name' => 'Unlocked advanced analytics',
            ],
            [
                'plan_id' => 1, 
                'name' => 'Customizable marketing tools',
            ],
            


            [
                'plan_id' => 2, 
                'name' => 'Unlimited account, listing and review support to optimize your presence',
            ],
            [
                'plan_id' => 2, 
                'name' => 'Enhanced profile page to showcase exclusive Clutch\' features',
            ],
            [
                'plan_id' => 2, 
                'name' => 'Customized landing pages and tracking capabilities Elimination of Recommended Providers section on your profile',
            ],
            [
                'plan_id' => 2, 
                'name' => 'Unlocked advanced analytics',
            ],
            [
                'plan_id' => 2, 
                'name' => 'Customizable marketing tools',
            ],
            [
                'plan_id' => 2, 
                'name' => 'Get more visibility and leads at the top of a directory',
            ],
            [
                'plan_id' => 2, 
                'name' => ' Be found by high intent leads searching for services in your location',
            ],



            [
                'plan_id' => 3, 
                'name' => 'Guarantee your exact position across dozens of directories',
            ],
            [
                'plan_id' => 3, 
                'name' => 'Promote your company on directories not available through Sponsorship',
            ],
            [
                'plan_id' => 3, 
                'name' => 'Get Featured on',
            ],
        ];
  
        foreach ($plans_items as $item) {
            PlanFeature::create($item);
        }
    }
}
