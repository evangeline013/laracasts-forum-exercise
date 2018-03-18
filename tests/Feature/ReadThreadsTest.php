<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreadsTest extends TestCase
{

    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->thread=factory('App\Thread')->create();
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);

    }

    /** @test */
    public function a_user_can_view_a_single_thread()
    {
        $this->get('/threads/'.$this->thread->id)
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_associated_with_a_thread()
    {
        //thread has associated replies
        $reply = factory('App\Reply')
            ->create(['thread_id'=> $this->thread->id]);

        //when we visit that thread page
        //we should see the replies
        $this->get('/threads/'.$this->thread->id)
            ->assertSee($reply->body);

    }
}
