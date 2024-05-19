<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Sidebar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function __construct(private Sidebar $sidebar) {
    }

    public function index()
    {
        return view('dashboard.dashboard', [
            'title' => "Dashboard",
            'heading' => "Dashboard"
        ]);
    }
}
