<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadThreadTest extends TestCase
{

  use DatabaseMigrations;

  /** @test */
  public function a_user_can_read_all_threads()
  {
    $thread = factory('App\Thread')->create();

    $this->get('/threads')
    ->assertStatus(200)
    ->assertSee($thread->title);
  }

  /** @test */
  public function a_user_can_view_all_thread_by_filtering_by_a_channel()
  {
    // Given a channel
    $channel = factory('App\Channel')->create();
    $threads = factory('App\Thread', 10)->create(['channel_id'=>$channel->id]);
    $thread= factory('App\Thread')->create();
    // When user filter by this channel
    $this->get($channel->link())
    ->assertStatus(200)
    // Then he should only see the channel threads
    ->assertSee($threads->first()->title)
    ->assertDontSee($thread->title);

  }

  /** @test */
  public function a_user_can_read_a_specific_thread()
  {
    $thread = factory('App\Thread')->create();
    $this->get($thread->link())
    ->assertStatus(200)
    ->assertSee($thread->title);
  }

  /** @test */
  public function a_user_can_read_a_thread_replies()
  {
    // Given a Thread
    $thread = factory('App\Thread')->create();
    $replyNotInThread = factory('App\Reply')->create();
    $replies = factory('App\Reply', 10)->create(['thread_id'=>$thread->id]);
    // When user hit the thread detail link
    $this->get($thread->link())
      ->assertStatus(200)
    // Then he should see thread all replies.
      ->assertSee($replies->first()->body)
      ->assertDontSee($replyNotInThread->body);
  }

  public function guest_may_not_reply_to_a_thread()
  {
    // Given a thread
    $thread = factory('App\Thread')->create();
    // When user submit a conversation
    $reply = factory('App\Reply')->make();
    $this->post($thread->link()."/reply", $reply->toArray())
    // Then a thread should be created
        ->assertRedirect('/login');
    $this->get($thread->link())
        ->assertDontSee($reply->body);
    $this->assertDatabaseMissing('replies', [
        'body' =>  $reply->body
      ]);
  }

  /** @test */
  public function an_authenticated_user_can_reply_to_a_thread()
  {
    // Given an authenticated user
    $this->signin();
    // Given a thread
    $thread = factory('App\Thread')->create();
    // When user submit a conversation
    $reply = factory('App\Reply')->make();
    $this->post($thread->link()."/reply", $reply->toArray())
    // Then a thread should be created
        ->assertRedirect($thread->link());
    $this->get($thread->link())
        ->assertSee($reply->body);
    $this->assertDatabaseHas('replies', [
        'body' =>  $reply->body
      ]);
  }


  /** @test */
  public function a_reply_requires_a_body()
  {
    // Given an authenticated user
    $this->signin();
    // Given a thread
    $thread = factory('App\Thread')->create();
    // When user submit a reply
    $reply = new \App\Reply;
    // When user submit a reply
    $this->post($thread->link()."/reply", $reply->toArray())
    // Then a reply should not be created
        ->assertSessionHasErrors('body');
  }
}
