<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
    this model represents all the logic that has to do
    with the non-essential information of a user
    (i.e. display name, icon, social media links, ...)
*/
class Account extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
}
