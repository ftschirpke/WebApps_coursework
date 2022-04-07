<?php

namespace App\ServiceContainers;

interface GameAccountInformation
{
    public function playerInfo($player_name);
}