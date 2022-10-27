<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use App\Models\Specialization;
use App\Models\Sponsorship;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //recupero id specializzazioni
        $spec_ids = Specialization::pluck('id')->toArray();
        $plan_ids = Sponsorship::pluck('id')->toArray();

        // creo un nuovo user
        $user = new User();

        $user->name = 'Pippo';
        $user->email = 'pippo@pluto.com';
        $user->password = bcrypt('pippo');

        $user->save();

        // popolo gli user attraverso un ciclo
        for ($i = 0; $i < 20; $i++) {
            $user = new User();

            $user->name = $faker->firstName();
            $user->email = $faker->email();
            $user->password = bcrypt('password');

            $user->save();
            // creo un array vuoto per raggruppare un numero random di specializzazioni
            $specs = [];

            foreach ($spec_ids as $spec_id) {

                if ($faker->boolean()) $specs[] = $spec_id;
            }

            // genero un numero random fra 0 e gli sponsor
            $ranNum = rand(0, count($plan_ids));

            // se è un id presente nell'array, lo attacco alla relazione
            foreach ($plan_ids as $plan_id)
                if ($plan_id == $ranNum) $user->sponsorships()->attach($ranNum);

            $user->specializations()->attach($specs);
        }
    }
}
