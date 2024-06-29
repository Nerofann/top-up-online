<?php

namespace App\Http\Controllers;

use App\Models\Kategory;
use App\Services\ApiTokoVoucher;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __construct(private ApiTokoVoucher $tokoVoucher) {
    
    }

    public function index()
    {
        $productKategori = Kategory::with('providers')->get();
        
        return view('dashboard.home', [
            'title' => "Home",
            'heading' => "Produk Serupa",
            'kategori' => $productKategori->toArray(),
        ]);
    }

    public function products($code, $ket = 0)
    {
        $list = Storage::allFiles('public/');
        foreach($list as $f) {
            if(str_contains($f, ".json")) {
                echo $f . "<br>";
            }
        }
        // $insert = ($ket != 0) ? true : false;
        // $products = $this->tokoVoucher->get("produk", ['kode' => $code], $insert);

        // echo "<pre>";
        // print_r($products);
    }
}
