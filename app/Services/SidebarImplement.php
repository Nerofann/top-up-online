<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class SidebarImplement implements Sidebar
{
    public function getSidebar(): array|object
    {
        $sidebars   = [
            [
                'title' => "Home",
                'auth'  => false,
                'child' => [
                    [
                        'cTitle'    => "Products",
                        'cIcon'     => "fa-light fa-cart-shopping-fast",
                        'cRoute'    => "home",
                    ],
                ]
            ],
            [
                'title' => "Informasi",
                'auth'  => true,
                'child' => [
                    [
                        'cTitle'    => "Dompet",
                        'cIcon'     => "fa-light fa-credit-card",
                        'cRoute'    => "dompet",
                    ],
                ]
            ]
        ];

        return  $sidebars;
    } 
}