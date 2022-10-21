<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user_ids = User::pluck('id')->toArray();

        foreach($user_ids as $id){
            $new_review = new Review();

            $new_review->user_id = $id;
            $new_review->guest_name = $faker->name();
            $new_review->guest_email = $faker->email();
            $new_review->rating = $faker->randomDigit() + 1;
            $new_review->content = $faker->text(100);

            $new_review->save();
    }
}
}