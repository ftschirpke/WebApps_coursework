<?php

namespace App\ServiceContainers;

use Illuminate\Support\Facades\Http;

class LeagueOfLegends
{
    private $apiKey;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
        $this->regions = [
            'BR'    => 'br1',
            'EUN'   => 'eun1',
            'EUW'   => 'euw1',
            'JP'    => 'jp1',
            'KR'    => 'kr',
            'LA1'   => 'la1',
            'LA2'   => 'la2',
            'NA'    => 'na1',
            'OC'    => 'oc1',
            'TR'    => 'tr1',
            'RU'    => 'ru'
        ];
        $this->champions = $this->getChampions();
        // dd($this->champions);
    }

    private function getChampions() {
        $url = 'http://ddragon.leagueoflegends.com/cdn/12.6.1/data/en_US/champion.json';
        $response = Http::get($url)->body();
        return json_decode($response, true)['data'];
    }

    private function apiUrlByRegion($region) {
        return 'https://' . $this->regions[$region]
        . '.api.riotgames.com/lol/';
    }

    // calling the SUMMONER-V4 API by summoner name
    private function summonerV4($summoner_name, $region) {
        $url = $this->apiUrlByRegion($region)
            . 'summoner/v4/summoners/by-name/'
            . $summoner_name . '?api_key=' . $this->apiKey;
        $response = Http::get($url)->body();
        return json_decode($response, true);
    }

    // calling the CHAMPION-MASTERY-V4 API by summoner id
    private function championMasteryV4($summoner_id, $region) {
        $url = $this->apiUrlByRegion($region)
            . 'champion-mastery/v4/champion-masteries/by-summoner/'
            . $summoner_id . '?api_key=' . $this->apiKey;
        $response = Http::get($url)->body();
        return json_decode($response, true);
    }

    // calling the LEAGUE-V4 API by summoner id
    private function leagueV4($summoner_id, $region) {
        $url = $this->apiUrlByRegion($region)
            . 'league/v4/entries/by-summoner/'
            . $summoner_id . '?api_key=' . $this->apiKey;
        $response = Http::get($url)->body();
        return json_decode($response, true);
    }

    public function playerInfo($player_name, $region = 'EUW') {
        $summoner = $this->summonerV4($player_name, $region);
        $champion_mastery = $this->championMasteryV4($summoner['id'], $region);
        $favourite_champion = $champion_mastery[0];
        $fav_champion_name = "None";
        foreach ($this->champions as $name => $data) {
            if ($data['key'] == $favourite_champion['championId']) {
                $fav_champion_name = $name;
                break;
            }
        }
        $ranks = $this->leagueV4($summoner['id'], $region);
        $soloq = $ranks[array_search(
            'RANKED_SOLO_5x5', array_column($ranks, 'queueType')
        )];
        $soloq_info = $soloq['tier'] . ' ' . $soloq['rank'] . ' '
            . $soloq['leaguePoints'] . 'LP - Wins/Losses: '
            . $soloq['wins'] . '/' . $soloq['losses'];
        $flexq = $ranks[array_search(
            'RANKED_FLEX_SR', array_column($ranks, 'queueType')
        )];
        $flexq_info = $flexq['tier'] . ' ' . $flexq['rank'] . ' '
            . $flexq['leaguePoints'] . 'LP - Wins/Losses: '
            . $flexq['wins'] . '/' . $flexq['losses'];

        $info = [
            'summoner_name' => $player_name,
            'summoner_lv' => $summoner['summonerLevel'],
            'fav_champion_name' => $fav_champion_name,
            'fav_champion_mastery_lv' => $favourite_champion['championLevel'],
            'fav_champion_mastery_points' => $favourite_champion['championPoints'],
            'soloq' => $soloq_info,
            'flexq' => $flexq_info
        ];
        return $info;
    }

    public function shortPlayerInfo($player_name, $region = 'EUW') {
        $summoner = $this->summonerV4($player_name, $region);
        $champion_mastery = $this->championMasteryV4($summoner['id'], $region);
        $favourite_champion = $champion_mastery[0];
        $fav_champion_name = "None";
        foreach ($this->champions as $name => $data) {
            if ($data['key'] == $favourite_champion['championId']) {
                $fav_champion_name = $name;
                break;
            }
        }
        $ranks = $this->leagueV4($summoner['id'], $region);
        $soloq = $ranks[array_search(
            'RANKED_SOLO_5x5', array_column($ranks, 'queueType')
        )];
        $soloq_rank = $soloq['tier'] . ' ' . $soloq['rank'];
        $info = [
            'summoner_name' => $player_name,
            'fav_champion_name' => $fav_champion_name,
            'soloq' => $soloq_rank,
        ];
        return $info;
    }
}