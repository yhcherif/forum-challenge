<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChannelTest extends TestCase
{
  use DatabaseMigrations;
  
  /** @test */
  public function a_thread_can_generate_a_link()
  {
    $channel = factory('App\Channel')->create();

    $this->assertEquals("/threads/{$channel->slug}", $channel->link());
  }


  /** @test */
  public function a_thread_has_many_threads()
  {
    $channel = factory('App\Channel')->make();

    $this->assertInstanceOf('Illuminate\Support\Collection', $channel->threads);
  }
}
