<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class)->latest();
    }

    public function users_viewed_by() {
        return $this->belongsToMany(User::class, 'unique_post_views');
    }

    public function reports() {
        return $this->morphMany(Report::class, 'reportable');
    }
}
