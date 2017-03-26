<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadTest extends TestCase
{

  use DatabaseMigrations;

  /** @test */
  public function a_thread_has_a_creator()
  {
    $thread = factory('App\Thread')->create();
    $this->assertInstanceOf('App\User', $thread->creator);
  }

  /** @test */
  public function a_thread_can_generate_a_link()
  {
    $thread = factory('App\Thread')->create();

    $this->assertEquals("/threads/{$thread->channel->slug}/{$thread->slug}", $thread->link());
  }


  /** @test */
  public function a_thread_has_many_replies()
  {
    $thread = factory('App\Thread')->make();

    $this->assertInstanceOf('Illuminate\Support\Collection', $thread->replies);
  }

  /** @test */
  public function a_thread_can_add_a_reply()
  {
    $this->signin();
    $thread = factory('App\Thread')->create();
    $reply = factory('App\Reply')->make();
    $thread->addReply($reply);

    $this->assertTrue($thread->replies->contains($reply));
  }



}
