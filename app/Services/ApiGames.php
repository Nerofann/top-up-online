<?php

namespace App\Services;

interface ApiGames {
    public function endpoint():string;
    public function endpointV2():string;
}