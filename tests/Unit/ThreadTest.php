<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadTest extends TestCase
{

    use DatabaseMigrations;

    protected $thread;

    /** @test */
    public function setUp()
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }
    /** @test */
    public function a_thread_can_have_replies()
    {
        $this->assertInstanceOf(Collection::class, $this->thread->replies);
    }

    public function a_thread_has_a_creator()
    {
        $this->assertInstanceOf(Collection::class, $this->thread->user);
    }

    /** @test */
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }
}