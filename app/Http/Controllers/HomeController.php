<?php

namespace App\Http\Controllers;

use App\Models\Kategory;
use App\Services\ApiTokoVoucher;
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

    public function products()
    {
        echo "<pre>";
        $products = $this->tokoVoucher->get("produk", ['kode' => "NSM"]);
        print_r($products);
    }
}
