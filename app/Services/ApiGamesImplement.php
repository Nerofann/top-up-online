<?php

namespace App\Services;

class ApiGamesImplement implements ApiGames {
    public function endpoint(): string
    {
        return "https://v1.apigames.id/";
    }

    public function endpointV2(): string
    {
        return "https://v1.apigames.id/v2/";
    }
}