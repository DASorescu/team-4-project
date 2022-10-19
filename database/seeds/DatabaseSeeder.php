<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SpecializationSeeder::class,
            UserSeeder::class,
            UserDetailSeeder::class,
    ]);
    }
}
