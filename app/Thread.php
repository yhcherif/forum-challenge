<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

  protected $fillable = [
      'title',
      'body',
      'slug',
      'user_id',
      'channel_id',
  ];

  /**
   * Get the value of the model's route key.
   *
   * @return mixed
   */
  public function getRouteKeyName()
  {
    return 'slug';
  }

  /**
   * A thread belongs to a creator
   * @return [App\User] 
   */
  public function creator()
  {
    return $this->belongsTo('App\User', 'user_id');
  }

  /**
   * A thread is assigned to a channel
   * @return [App\Channel] 
   */
  public function channel()
  {
    return $this->belongsTo('App\Channel');
  }

  /**
   * A thread has many replies
   * @return Illuminate\Support\Collection
   */
  public function replies()
  {
    return $this->hasMany('App\Reply');
  }

  /**
   * Generate thread path string
   * @return string
   */
  public function link()
  {
    return "/threads/{$this->channel->slug}/{$this->slug}";
  }

  /**
   * Add a reply to the thread.
   * @param App\Reply $reply
   */
  public function addReply($reply)
  {
    if (is_array($reply)) {
        $reply['user_id'] = auth()->id();
        return $this->replies()->create($reply);
    } else if ($reply instanceof Reply)
    {
        $reply->user_id = auth()->id();
        return $this->replies()->save($reply);
    }
    throw new \Exception("Argument must be an array or an instance of App\Reply", 1);
  }
}
