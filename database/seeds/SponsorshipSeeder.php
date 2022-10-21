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

        $plans = [
            [
                'name' => 'silver',
                'cost' => 2,99,
                'duration' => 24
            ],
            [
                'name' => 'gold',
                'cost' => 5,99,
                'duration' => 72
            ],
            [
                'name' => 'platinum',
                'cost' => 9,99,
                'duration' => 144
            ],
        ];

        foreach($plans as $plan){
            $new_sponsorship = new Sponsorship();

            $new_sponsorship->name = $plan['name'];
            $new_sponsorship->cost = $plan['cost'];
            $new_sponsorship->duration = $plan['duration'];

            $new_sponsorship->save();
        }
    }
}
