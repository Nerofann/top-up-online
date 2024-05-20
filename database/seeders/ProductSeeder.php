<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = json_decode(Storage::get('public/TKV-GAMES.json'));
        if(is_array($products)) {
            $data   = [];
            foreach($products as $product) {
                $data[] = [
                    "vendor_id"     => 1,
                    "provider_id"   => 1,
                    "type"          => "diamond",
                    "name"          => $product->nama_produk,
                    "description"   => $product->deskripsi,
                    "price_vendor"  => $product->price,
                    "price_real"    => $product->price,
                    "price_discount"=> $product->price,
                    "code"          => $product->code,
                    "status"        => $product->status == 1 ? "tersedia" : "gangguan",
                    "published"     => "52f97cea-3a2e-4688-b45f-c72a84985cf5"
                
                ];
            }
            Product::upsert($data, ['code']);
        }
    }
}
