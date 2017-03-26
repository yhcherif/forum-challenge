<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

  protected $fillable = ['body', 'user_id', 'thread_id'];

  /**
   * A reply is belongs to a user
   * @return App\User
   */
  public function owner()
  {
    return $this->belongsTo('App\User', 'user_id');
  }

  /**
   * A reply is associated to a thread
   * @return App\Thread
   */
  public function thread()
  {
    return $this->belongsTo('App\Thread');
  }
}
