<?php

namespace Database\Seeders;

use App\Models\Attachment;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //Truncate tables
        Attachment::truncate();
        Message::truncate();
        User::truncate();

        //Create new users
        User::factory(2)->create();

        //Create new messages
        $user_id = 1;
        $to = 2;
        $messages = [];
        for($x = 1; $x <= 4; $x++){
            $data = [
                'user_id'           => $user_id,
                'message'           => $faker->realText(200),
                'messageable_type'  => 'App\Models\User',
                'messageable_id'    => $to
            ];
            $messages[$x] = Message::create($data);
            $user_id = $user_id == 1 ? 2 : 1;
            $to = $to == 1 ? 2 : 1;
        }

        //Create new attachments
        $attachments = [];
        for($x = 1; $x <= 3; $x++){
            $message = $messages[rand(1,4)];
            $data = [
                'name'              => 'Image '.$x,
                'path'              => 'image-'.$x.'.jpg',
                'attachable_type'   => 'App\Models\Message',
                'attachable_id'     => $message->id
            ];
            $attachments[$x] = Attachment::create($data);
        }


    }
}
