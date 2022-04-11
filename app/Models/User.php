<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'is_admin'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function reports() {
        return $this->hasMany(Report::class);
    }

    public function account() {
        return $this->hasOne(Account::class);
    }

    public function posts_viewed() {
        return $this->belongsToMany(Post::class, 'unique_post_views');
    }

    public function users_friendship_requests_sent_to() {
        return $this->belongsToMany(
            User::class, 'friendship_requests',
            'sender_user_id', 'receiver_user_id'
        );
    }

    public function users_friendship_requests_received_from() {
        return $this->belongsToMany(
            User::class, 'friendship_requests',
            'receiver_user_id', 'sender_user_id'
        );
    }

    public function friends() {
        $to = $this->users_friendship_requests_sent_to;
        $from = $this->users_friendship_requests_received_from;
        return $to->intersect($from);
    }
}
