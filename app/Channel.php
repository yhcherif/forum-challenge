<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{

  protected $fillable = [
    'name', 'slug'
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
   * A channel has many threads
   * @return Illuminate\Support\Collection
   */
  public function threads()
  {
    return $this->hasMany('App\Thread');
  }

  /**
   * Generate thread path string
   * @return string
   */
  public function link()
  {
    return "/threads/{$this->slug}";
  }
}
