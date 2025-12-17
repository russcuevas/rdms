<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function AdminDashboardPage()
    {
        // Total admins
        $totalAdmins = DB::table('profiles')
            ->where('role', 'admin')
            ->count();

        // Total citizens
        $totalCitizens = DB::table('profiles')
            ->where('role', 'citizen')
            ->count();

        // Total evacuation sites
        $totalEvacuations = DB::table('evacuation_sites')
            ->count();

        return view('admin.dashboard', compact(
            'totalAdmins',
            'totalCitizens',
            'totalEvacuations'
        ));
    }
}
