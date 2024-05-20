<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::create([
            'v_name'        => "TokoVoucher",
            'v_description' => "Api TokoVoucher",
            'v_api_url'     => "https://api.tokovoucher.id/",
            'v_private_key' => "private_key",
            'v_api_key'     => "api_key",
            'created_at'    => date("Y-m-d H:i:s")
        ]);
    }
}
