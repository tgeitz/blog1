<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;
    protected $thread;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory('App\User')->create();
        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    public function an_unauthenticated_user_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        // Doesn't even need thread or replies; waste of memory
//        $reply = factory('App\Reply')->create();
//        $this->post($this->thread->path() . '/replies', $reply->toArray());

        $this->post('/threads/1/replies', []);
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        // Given we have an authenticated user
        $this->signIn($this->user);
        // And an existing thread

        // When the user adds a reply to the thread

        //  create() persists the reply, which we're already doing.  Use make() instead
//        $reply = factory('App\Reply')->create();
        $reply = factory('App\Reply')->make();
        $this->post($this->thread->path() . '/replies', $reply->toArray())
            ->assertRedirect($this->thread->path());

        // Then their reply should be visible on the page.
        $response = $this->get($this->thread->path());
        $response->assertSee($reply->body);

    }
}
