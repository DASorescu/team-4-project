<?php


use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use App\Models\Message;


class MessageSeeder extends Seeder
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
            for($i=0;$i<15;$i++ ){
                $new_message = new Message();
    
                $new_message->user_id = $id;
                $new_message->name = $faker->name();
                $new_message->email = $faker->email();
                $new_message->content = $faker->text(100);
                $new_message->date = $faker->dateTimeThisYear();
                $new_message->created_at = $new_message->date;
                
    
                $new_message->save();

            }
        }
    }
}
