<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function unauthenticated_users_may_not_add_replies()
    {
        $this->post('/threads/slug/1/replies', [])
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->withoutExceptionHandling();
        // Given we have an authenticated user
        $this->be($user = create('App\User'));

        // And an existing thread
        $thread = create('App\Thread');

        //When a user add a reply to the thread
        $reply = make('App\Reply');
        $this->post($thread->path().'/replies', $reply->toArray());

        // Then there reply should be visible on the page
        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    public function a_replies_require_a_body()
    {
        $this->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }
}
