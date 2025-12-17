<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvacuationSite;

class HomeController extends Controller
{
    public function HomePage()
    {
        $sites = EvacuationSite::all();
        return view('index', compact('sites'));
    }
}
