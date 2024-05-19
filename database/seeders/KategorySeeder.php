<?php

namespace Database\Seeders;

use App\Models\Kategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategory   = [
            'TOPUP', 
            'PULSA', 
            'JOIN RESELLER', 
            'VOUCHER', 
            'TOKEN LISTRIK', 
            'PAKET DATA', 
            'VOUCHER DATA', 
            'TELPON & SMS', 
            'INJECT VOUCHER KOSONG', 
            'TV', 
            'PASCABAYAR', 
            'E-TOLL', 
        ];

        foreach($kategory as $kat) {
            Kategory::create([
                'kt_name'   => $kat,
                'kt_code'   => rtrim(base64_encode($kat), '='),
                'created_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
