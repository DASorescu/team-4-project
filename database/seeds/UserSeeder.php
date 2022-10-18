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
    public function run()
    {
        $user = new User();

        $user->name = 'Pippo';
        $user->email = 'pippo@pluto.com';
        $user->password = bcrypt('pippo');

        $user->save();
    }
}
