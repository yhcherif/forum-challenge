<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function threads()
    {
        return $this->hasMany('App\Thread');
    }

    /**
     * Create a new thread on the forum
     * @param  array|App\Thread $thread
     * @return mixed
     */
    public function startConversation($thread)
    {
        if (is_array($thread)) {
            return $this->threads()->create($thread);
        } else if ($thread instanceof Thread)
        {
            return $this->threads()->save($thread);
        }
        throw new \Exception("Argument must be an array or an instance of App\Thread", 1);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
