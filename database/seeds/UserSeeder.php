<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user = new User();

        $user->name = 'Pippo';
        $user->email = 'pippo@pluto.com';
        $user->password = bcrypt('pippo');

        $user->save();

        for($i = 0; $i < 5; $i++){
            $user = new User();
            
            $user->name = $faker->firstName();
            $user->email = $faker->email();
            $user->password = bcrypt($faker->password());

            $user->save();

        }
    }
}
