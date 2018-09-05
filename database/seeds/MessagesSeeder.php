<?php

use Illuminate\Database\Seeder;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 50)->create();

        $users->each(function(App\User $user) use ($users) {
            $messages = factory(App\Message::class)->times(2)->create([
                'user_id' => $user->id,
            ]);

            $messages->each(function (App\Message $message) use ($users) {
                factory(App\Response::class, random_int(1,5))->create([
                    'message_id' => $message->id,
                    'user_id'    => $users->random(1)->first()->id,
                ]);
            });

            $user->follows()->sync(
                $users->random(10)
            );
        });
        
        // DB::table('messages')->insert($messages);
    }
}
