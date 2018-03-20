<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function unauthenticated_users_may_not_add_replies()
    {
        $this->withExceptionHandling()
            ->post('/threads/some-channel/1/replies', [])
            ->assertRedirect('/login');
        //We don't need to use factories to whip up instance since it shouldn't be able to reach the addReply method.
    }
    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        //given we have an authenticated user
        $this->signIn();

        //and an existing thread
        $thread = create('App\Thread');

        //when the user add a reply to the thread
        $reply = make('App\Reply');
        $this->post($thread->path().'/replies', $reply->toArray());

        //the reply should be visible in the thread
        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
