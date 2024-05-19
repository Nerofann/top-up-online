<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provider = [
            [
                'kategory' => 1,
                'name'  => 'Free Fire',
                'code'  => 'Free Fire',
                'image' => 'icon-ff-gif.gif',
                'banner'=> 'main-bg-4.jpg',
            ],
            [
                'kategory' => 1,
                'name'  => 'Mobile Legends',
                'code'  => 'Mobile Legends',
                'image' => 'icon-ml-gif.gif',
                'banner'=> 'main-bg-4.jpg',
            ],
            [
                'kategory' => 1,
                'name'  => 'PUBG Mobile',
                'code'  => 'PUBG Mobile',
                'image' => 'icon-pubg-gif.gif',
                'banner'=> 'main-bg-4.jpg',
            ],
            [
                'kategory' => 1,
                'name'  => 'Genshin Impact',
                'code'  => 'Genshin Impact',
                'image' => 'genshing-impact.webp',
                'banner'=> 'main-bg-4.jpg',
            ],
            [
                'kategory' => 1,
                'name'  => 'Blood Strike',
                'code'  => 'Blood Strike',
                'image' => 'bloodstrike.webp',
                'banner'=> 'main-bg-4.jpg',
            ],
            [
                'kategory' => 1,
                'name'  => 'Garena Undawn',
                'code'  => 'Garena Undawn',
                'image' => 'garena-undawn.webp',
                'banner'=> 'main-bg-4.jpg',
            ]
        ];

        foreach($provider as $prov) {
            Provider::create([
                'pv_kategoryid' => $prov['kategory'],
                'pv_code'   => $prov['code'],
                'pv_name'   => $prov['name'],
                'pv_image'  => $prov['image'],
                'pv_banner' => $prov['banner'],
                'pv_slug'   => Str::slug($prov['name']),
                'created_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
