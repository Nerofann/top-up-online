<?php

namespace App\Services;

use App\Models\Vendor;

class AppGlobalsImplement implements AppGlobals {
    public function getSidebar(): array|object
    {
        $vendors = [
            [
                'cTitle'    => "Add New",
                'cIcon'     => "fa-light fa-plus",
                'cRoute'    => ['name' => "AddNewVendor"],
            ]
        ];

        foreach(Vendor::select(['v_name', 'v_slug'])->get() as $vendor) {
            $vendors[] = [
                'cTitle'    => $vendor->v_name,
                'cIcon'     => "fa-light fa-bag-shopping",
                'cRoute'    => ['name' => "editVendor", 'params' => ['slug' => $vendor->v_slug]],
            ];
        }

        $sidebars   = [
            [
                'title' => "Home",
                'auth'  => false,
                'child' => [
                    [
                        'cTitle'    => "Dashboard",
                        'cIcon'     => "fa-light fa-cart-shopping-fast",
                        'cRoute'    => ['name' => "dashboard"],
                    ],
                ]
            ],
            [
                'title' => "Products",
                'auth'  => true,
                'child' => [
                    [
                        'cTitle'    => "Kategories",
                        'cIcon'     => "fa-light fa-bag-shopping",
                        'cRoute'    => ['name' => "adminKategory"],
                    ],
                    [
                        'cTitle'    => "Providers",
                        'cIcon'     => "fa-light fa-bag-shopping",
                        'cRoute'    => ['name' => "adminProviders"],
                    ],
                    [
                        'cTitle'    => "Products",
                        'cIcon'     => "fa-light fa-bag-shopping",
                        'cRoute'    => ['name' => "adminProducts"],
                    ],
                ]
            ],
            [
                'title' => "Payments",
                'auth'  => true,
                'child' => [
                    [
                        'cTitle'    => "Payment Method",
                        'cIcon'     => "fa-light fa-bag-shopping",
                        'cRoute'    => ['name' => "paymentList"],
                    ],
                ]
            ],
            [
                'title' => "Vendors",
                'auth'  => true,
                'child' => $vendors
            ]
        ];

        return  $sidebars;
    } 


    public function errorAjax(array $errors)
    {
        $error = array_map(function($err) {
            return $err[0];
        }, $errors);

        return $error;
    }
}