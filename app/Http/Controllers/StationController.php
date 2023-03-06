<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function getStations($id){
        $stations = Station::where('route_id', $id)->get();
        return response()->json([
            'stations' => $stations,
        ]);
    }

    public function getTooltips(Request $request) {
        $tooltips = Station::select('route_id')
        ->where('station_name', $request->input('stationName'))
        ->get();
        return response()->json([
            'tooltips' => $tooltips,
        ]);
    }
}
