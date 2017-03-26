<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StartConversationTest extends TestCase
{
  use DatabaseMigrations;

  /** @test */
  public function guests_may_not_create_conversation()
  {
    // When guest submit a conversation
    $thread = factory('App\Thread')->make();
    $this->post('/threads', $thread->toArray())
    // Then he should be redirected to login
    // And the thread should not be created
        ->assertRedirect('/login');
  }

  /** @test */
  public function a_user_can_start_a_conversation()
  {
    //Given an authenticated user
    $user = factory(\App\User::class)->create();
    $this->actingAs($user);
    // When user submit a conversation
    $thread = factory('App\Thread')->make();
    $this->post('/threads', $thread->toArray())
    // Then a thread should be created
        ->assertRedirect('/threads');
    $this->get('/threads')
        ->assertSee($thread->title);
    //  And we should see evidence in database
     $this->assertDatabaseHas('threads', [
        'title' =>  $thread->title,
        'body' =>  $thread->body
      ]);
  }

  /** @test */
  public function a_conversation_requires_a_title_a_slug_and_body()
  {
    //Given an authenticated user
    $user = factory(\App\User::class)->create();
    $this->actingAs($user);
    // When user submit a conversation
    $thread = new \App\Thread;
    $this->post('/threads', $thread->toArray())
    // Then a thread should not be created
        ->assertSessionHasErrors('title')
        ->assertSessionHasErrors('slug')
        ->assertSessionHasErrors('body');
  }

}
