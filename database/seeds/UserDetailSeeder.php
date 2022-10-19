<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\UserDetail;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;


class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user_ids = User::pluck('id')->toArray();
        $cities = config('cities');

        foreach($user_ids as $id){
            $user_detail = new UserDetail();
            $user_detail->user_id = $id;
            $user_detail->first_name = $faker->firstName();
            $user_detail->last_name = $faker->lastName();
            $user_detail->phone = $faker->phoneNumber();
            if(config('cities')){
                $user_detail->address = Arr::random($cities);   
            }else{

                $user_detail->address = $faker->city();
            }
            $user_detail->save();

            
        }
    }
}
