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

    public function AdminViewReportPage($id)
{
    $report = DB::table('reports')
        ->leftJoin('auth.users', 'auth.users.id', '=', 'reports.user_id')
        ->select(
            'reports.*',
            'auth.users.email as author_email'
        )
        ->where('reports.id', $id)
        ->first();

    if (!$report) {
        abort(404);
    }

    return view('admin.reports.view', compact('report'));
}

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:verified,resolved'
    ]);

    DB::table('reports')
        ->where('id', $id)
        ->update([
            'status' => $request->status
        ]);

    return response()->json([
        'success' => true,
        'status' => ucfirst($request->status)
    ]);
}


}