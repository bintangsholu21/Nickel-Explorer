<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\Driver;
use Illuminate\Support\Facades\Auth;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\LogActivity;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['user', 'vehicle', 'driver'])->get();
        $orders = Order::orderBy('created_at', 'desc')->get();

        return view('pemesanan', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $availableVehicles = Vehicle::whereNotIn('id', function ($query) {
            $query->select('vehicle_id')
                ->from('orders')
                ->whereIn('status', ['pending', 'approved1', 'approved2']);
        })->get();

        return view('formPemesanan', compact('availableVehicles'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'driverName' => 'required|string',
            'orderDate' => 'required|date',
            'vehicleId' => 'required|exists:vehicles,id',
        ]);
        $driver = new Driver([
            'name' => $request->input('driverName'),
        ]);


        $vehicle = Vehicle::find($request->input('vehicleId'));

        $order = new Order([
            'driver_id' => $driver->id,
            'vehicle_id' => $request->input('vehicleId'),
            'order_date' => $request->input('orderDate'),
            'end_date' => $request->input('endDate'),
            'status' => 'pending',
        ]);


        $logActivites = new LogActivity([
            'user' => Auth::user()->name,
            'activity' => 'Admin membuat pemesanan ' . $vehicle->vehicle_name . ' dengan driver ' . $driver->name . ' pada tanggal ' . $order->order_date . ' hingga ' . $order->end_date . ' dengan status ' . $order->status,
        ]);

        $driver->save();
        $order->save();
        $logActivites->save();

        return redirect()->route('pemesanan');
    }

    public function approve(Order $order)
    {

        $vehicle = Vehicle::find($order->vehicle_id);
        $driver = Driver::find($order->driver_id);

        if (Auth::user()->role == 'approver1') {
            $order->status = 'approved1';
            $logActivites = new LogActivity([
                'user' => Auth::user()->name,
                'activity' => 'Approver 1 telah menyetujui Pemesanan ' . $vehicle->vehicle_name . ' dengan driver ' . $driver->name . ' pada tanggal ' . $order->order_date . ' hingga ' . $order->end_date . ' dengan status approved1',
            ]);
            $logActivites->save();
            $order->save();
        } else if (Auth::user()->role == 'approver2' && $order->status == 'approved1') {
            $order->status = 'approved2';
            $logActivites = new LogActivity([
                'user' => Auth::user()->name,
                'activity' => 'Approver 2 telah menyetujui Pemesanan ' . $vehicle->vehicle_name . ' dengan driver ' . $driver->name . ' pada tanggal ' . $order->order_date . ' hingga ' . $order->end_date . ' dengan status approved2',
            ]);
            $logActivites->save();
            $order->save();
        }

        return back();
    }

    public function reject(Order $order)
    {

        $vehicle = Vehicle::find($order->vehicle_id);
        $driver = Driver::find($order->driver_id);

        if (Auth::user()->role == 'approver1' && $order->status == 'pending') {
            $order->status = 'rejected';
            $logActivites = new LogActivity([
                'user' => Auth::user()->name,
                'activity' => 'Approver 1 telah menolak Pemesanan ' . $vehicle->vehicle_name . ' dengan driver ' . $driver->name . ' pada tanggal ' . $order->order_date . ' hingga ' . $order->end_date . ' dengan status rejected',
            ]);
            $logActivites->save();
            $order->save();
        } else if (Auth::user()->role == 'approver2' && $order->status == 'approved1') {
            $order->status = 'rejected';
            $logActivites = new LogActivity([
                'user' => Auth::user()->name,
                'activity' => 'Approver 2 telah menolak Pemesanan ' . $vehicle->vehicle_name . ' dengan driver ' . $driver->name . ' pada tanggal ' . $order->order_date . ' hingga ' . $order->end_date . ' dengan status rejected',
            ]);
            $logActivites->save();
            $order->save();
        }

        return back();
    }

    public function complete(Order $order)
    {

        $vehicle = Vehicle::find($order->vehicle_id);
        $driver = Driver::find($order->driver_id);

        $order->status = 'done';
        $logActivites = new LogActivity([
            'user' => Auth::user()->name,
            'activity' => 'Admin telah menyelesaikan pemesanan ' . $vehicle->vehicle_name . ' dengan driver ' . $driver->name . ' pada tanggal ' . $order->order_date . ' hingga ' . $order->end_date . ' dengan status done',
        ]);
        $logActivites->save();
        $order->push();

        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new OrdersExport, 'Laporan-Periodik-Pemesanan-Kendaraan.xlsx');
    }

    public function showLogs()
    {
        $logs = LogActivity::all();
        $logs = LogActivity::orderBy('created_at', 'desc')->get();

        return view('logPemesanan', ['logs' => $logs]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
