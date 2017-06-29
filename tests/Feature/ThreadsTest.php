<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;
    protected $reply;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
        $this->reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {

        $response = $this->get('/threads');
        $response->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_a_single_thread()
    {

        $response = $this->get('/threads/' . $this->thread->id);
        $response->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $response = $this->get('/threads/' . $this->thread->id);
        $response->assertSee($this->reply->body);



    }
}
