<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EvacuationController extends Controller
{
    public function AdminEvacuationPage()
    {
        $evacuationSites = DB::table('evacuation_sites')->get();

        return view('admin.evacuation', compact('evacuationSites'));
    }

    public function AdminAddEvacuationRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
            'capacity' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        DB::table('evacuation_sites')->insert([
            'name' => $request->name,
            'lat' => $request->lat,
            'lon' => $request->lon,
            'capacity' => $request->capacity,
            'current_occupancy' => 0,
            'is_open' => DB::raw('1::boolean'),
            'description' => $request->description,
        ]);



        return redirect()->back()->with('success', 'Evacuation site added successfully!');
    }

    public function AdminUpdateEvacuationRequest(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
            'capacity' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        DB::table('evacuation_sites')->where('id', $id)->update([
            'name' => $request->name,
            'lat' => $request->lat,
            'lon' => $request->lon,
            'capacity' => $request->capacity,
            'description' => $request->description,
            'is_open' => $request->has('is_open') 
                ? DB::raw('true')   // sets it to TRUE
                : DB::raw('false'), // sets it to FALSE
        ]);


        return redirect()->back()->with('success', 'Evacuation site updated successfully!');
    }

    public function AdminDeleteEvacuationRequest($id)
    {
        DB::table('evacuation_sites')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Evacuation site deleted successfully!');
    }

}
