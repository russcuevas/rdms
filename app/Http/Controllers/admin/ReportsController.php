<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class ReportsController extends Controller
{
    public function AdminReportsPage()
    {
        // Make sure you use the correct schema 'auth'
        $reports = DB::table('reports')
            ->leftJoin('auth.users', 'auth.users.id', '=', 'reports.user_id')
            ->select(
                'reports.*',
                'auth.users.email as author_email' // fetch email from auth.users
            )
            ->get();

        return view('admin.reports', compact('reports'));
    }
}