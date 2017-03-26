<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
  use DatabaseMigrations;

  /** @test */
  public function a_user_has_many_threads()
  {
    $user = factory('App\User')->make();
    $this->assertInstanceOf('Illuminate\Support\Collection', $user->threads);
  }

  /** @test */
  public function a_user_can_start_a_conversation()
  {
    $user = factory('App\User')->create();
    $thread = factory('App\Thread')->make();
    $thread = factory('App\Thread')->make();

    $user->startConversation($thread);
    $user->startConversation($thread->toArray());

    $this->assertTrue($user->threads->contains($thread));
    $this->assertTrue($user->threads->contains($thread));
  }
  
}
