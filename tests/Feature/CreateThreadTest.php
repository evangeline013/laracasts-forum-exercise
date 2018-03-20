<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function guests_cannot_create_threads()
    {
        $this->withExceptionHandling();

        $this->get('/threads/create')
            ->assertRedirect('/login');

        //this is from the point when user hits the store method
        $this->post('/threads',[])
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticate_user_can_create_new_threads()
    {
        //Given we have a signed in user
        $this->signIn();
        $thread = make('App\Thread');
        //use make since we want to ensure we can see the thread after the post request
        //since we use make, it hasn't been persisted, so there's no thread ID

        //We hit the endpoint to create a new thread
        $response = $this->post('/threads', $thread->toArray());
        //accept the response and expect the header to figure out where it gets redirected

        //when we visit the thread page
        //we should see the new thread
        $this->get($response->headers->get('location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_requires_a_valid_channel()
    {
        factory('App\Channel',2)->create();
        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 9999])
            ->assertSessionHasErrors('channel_id');
    }

    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();
        $thread = make('App\Thread', $overrides);
        return $this->post('/threads', $thread->toArray());
    }
}
