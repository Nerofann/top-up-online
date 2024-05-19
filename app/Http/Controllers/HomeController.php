<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $kategori   = collect([
            'topup', 'pulsa', 'join-reseller', 
            'voucher', 'token-listrik', 'paket-data', 
            'voucher-data', 'telpon-&-sms', 
            'inject-voucher-kosong', 'tv', 
            'pascabayar', 'e-toll'
        ]);

        return view('dashboard.home', [
            'title' => "Home",
            'heading' => "Produk Serupa",
            'kategori' => $kategori
        ]);
    }
}
