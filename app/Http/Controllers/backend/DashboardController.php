<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Support\Facades\Artisan;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('backend.index');
    }
}
