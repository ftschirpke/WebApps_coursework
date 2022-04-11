<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function cod() {
        $cod_api = app()->make('CoD');
        return $cod_api->playerInfo("me");
    }

    public function lolInfo($long = false, $only = null) {
        $lol_api = app()->make('LoL');
        if ($only) {
            if ($long) {
                $long_info =  $lol_api->playerInfo($this->lol_name);
                return $long_info[$only];
            } else {
                $short_info =  $lol_api->shortPlayerInfo($this->lol_name);
                return $short_info[$only];
            }
        }
        if ($long) {
            $long_info =  $lol_api->playerInfo($this->lol_name);
            return $long_info;
        } else {
            $short_info =  $lol_api->shortPlayerInfo($this->lol_name);
            return $short_info['summoner_name'] . " - "
                . $short_info['soloq'] . " - Favourite Champion: "
                . $short_info['fav_champion_name'];
        }
    }
}
