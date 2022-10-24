<?php

use Illuminate\Database\Seeder;
use App\Models\Sponsorship;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $plans = config('sponsor_plans');

        $plans = config('sponsor_plans');

        foreach($plans as $plan){
            $new_sponsorship = new Sponsorship();

            $new_sponsorship->name = $plan['name'];
            $new_sponsorship->cost = $plan['cost'];
            $new_sponsorship->duration = $plan['duration'];

            $new_sponsorship->save();
        }
    }
}
