<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MentionUsersTest extends TestCase
{
   use DatabaseMigrations;

   /** @test */
   public function mentioned_users_in_a_reply_are_notified()
   {
        $john = factory(User::class)->create(['name'=>'JohnDoe']);
        $this->actingAs($john);

        $jane = factory(User::class)->create(['name'=>'JaneDoe']);

        $thread = factory(Thread::class)->create();

        $reply = factory(Reply::class)->make([
            'body'=>'@JaneDoe look at this. Also @FrankDoe.'
        ]);

        $this->json('post', $thread->path().'/replies', $reply->toArray());

        $this->assertCount(1, $jane->notifications);

   }
}
