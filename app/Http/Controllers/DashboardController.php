<?php

namespace App\Http\Controllers;

use App\Charts\GrafikPemakaianKendaraan;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function index(){
    $pendingOrdersCount = Order::whereIn('status', ['pending', 'approved1'])->count();
    $rejectedOrdersCount = Order::where('status', 'rejected')->count();
    $successOrdersCount = Order::where('status', 'approved2')->count();
    $doneOrdersCount = Order::where('status', 'done')->count();
    $totalOrdersCount = Order::count();

    $vehicles = Vehicle::all();
    $vehicleNames = $vehicles->pluck('name');
    $orderCounts = $vehicles->map(function ($vehicle) {
        return $vehicle->orders()
            ->where('status', 'done')
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();
    });
    
    $doneOrdersCountPerVehicle = DB::table('orders')
    ->join('vehicles', 'orders.vehicle_id', '=', 'vehicles.id')
    ->select('vehicles.vehicle_name', DB::raw('count(*) as total'))
    ->where('orders.status', 'done')
    ->groupBy('vehicles.vehicle_name')
    ->pluck('total', 'vehicles.vehicle_name');
    

    return view('dashboard', compact('pendingOrdersCount', 'successOrdersCount', 'rejectedOrdersCount', 'doneOrdersCount','totalOrdersCount', 'vehicleNames', 'orderCounts', 'doneOrdersCountPerVehicle'));
    }
}
