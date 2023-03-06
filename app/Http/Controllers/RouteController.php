<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index(){
        return view('home');
    }

    public function getRoute($id){
        $route = Route::find($id);
        return response()->json([
            'route' => $route,
        ]);
    }

    public function fetchRoutes(){
        $routes = Route::all();
        return response()->json([
            'routes' => $routes,
        ]);
    }
}
