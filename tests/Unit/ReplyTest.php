<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReplyTest extends TestCase
{

  use DatabaseMigrations;

  /** @test */
  public function a_replys_has_a_owner()
  {
    $reply = factory('App\Reply')->make();

    $this->assertInstanceOf('App\User', $reply->owner);
  }

  /** @test */
  public function a_reply_belongs_to_a_thread()
  {
    $reply = factory('App\Reply')->make();

    $this->assertInstanceOf('App\Thread', $reply->thread);
  }
  
}
