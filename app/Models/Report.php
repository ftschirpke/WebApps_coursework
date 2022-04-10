<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public static $categories = [
        'intended misinformation',
        'offensive content',
        'other'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * You can report on Posts or Comments
     */
    public function reportable() {
        return $this->morphTo();
    }
}
