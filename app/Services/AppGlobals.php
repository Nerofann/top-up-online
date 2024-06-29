<?php

namespace App\Services;

interface AppGlobals {
    public function getSidebar(): array|object;
    public function errorAjax(array $errors);
}