<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\UserDetail;
use Illuminate\Support\Arr;
use Faker\Factory as Faker;


class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker = Faker::create('it_IT');
        $user_ids = User::pluck('id')->toArray();
        $images = config('images');
        $cities = config('cities');

        foreach($user_ids as $id){
            $user_detail = new UserDetail();
            $user_detail->user_id = $id;
            $user_detail->image = $faker->imageUrl(350,350);
            $user_detail->first_name = $faker->firstName();
            $user_detail->last_name = $faker->lastName();
            $user_detail->phone = $faker->phoneNumber();
            $user_detail->image = Arr::random($images);
            $user_detail->city_address = $faker->address();
            if(config('cities')){
                $user_detail->address = Arr::random($cities);   
            }else{

                $user_detail->address = $faker->city();
            }
            $user_detail->save();

            
        }
    }
}
