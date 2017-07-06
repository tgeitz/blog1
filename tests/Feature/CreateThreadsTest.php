<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;
    
    protected $user;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->user = factory('App\User')->create();
    }

    /** @test */
    public function a_guest_may_not_create_new_forum_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = factory('App\Thread')->make();

        $this->post('/threads', $thread->toArray());
    }

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        // Given we have an authenticated user
        $this->signIn($this->user);
        // When we hit the create thread endpoint
        $thread = factory('App\Thread')->make();
//        $thread = factory('App/Thread')->raw();  //  This creates an array instead of a Thread instance.
        $this->post('/threads', $thread->toArray());
//            ->assertStatus(200);
        // Then when we visit the thread page,
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
        // We should see the new thread
    }
}
