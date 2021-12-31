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
        // User::truncate();
        // Message::truncate();
        // Attachment::truncate();

        //Create new users
        $users = User::factory(2)->create();
        $firstUserId = $users->first()->id;
        $lastUserId = $users->last()->id;

        //Create new messages
        $user_id = $firstUserId;
        $to = $lastUserId;
        $messages = [];
        for($x = 1; $x <= 4; $x++){
            $data = [
                'user_id'           => $user_id,
                'message'           => $faker->realText(200),
                'messageable_type'  => 'App\Models\User',
                'messageable_id'    => $to
            ];
            $messages[$x] = Message::create($data);
            $user_id = $user_id == $firstUserId ? $lastUserId : $firstUserId;
            $to = $to == $firstUserId ? $lastUserId : $firstUserId;
            sleep(2);
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
