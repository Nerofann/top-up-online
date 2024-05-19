<?php

namespace App\Http\Controllers;

use App\Models\Kategory;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $productKategori = Kategory::with('providers')->get();

        return view('dashboard.home', [
            'title' => "Home",
            'heading' => "Produk Serupa",
            'kategori' => $productKategori->toArray(),
        ]);
    }
}
