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
            SponsorshipSeeder::class,
            UserSeeder::class,
            UserDetailSeeder::class,
            MessageSeeder::class,
            ReviewSeeder::class,
    ]);
    }
}
