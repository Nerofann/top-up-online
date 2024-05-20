<?php

namespace App\Services;

interface ApiTokoVoucher {
    public function endpoint():string;
    public function get(string $query, array $data);
}