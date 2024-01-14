<?php
namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromQuery, WithHeadings
{
    public function query()
    {
        return Order::query()
            ->join('drivers', 'orders.driver_id', '=', 'drivers.id')
            ->join('vehicles', 'orders.vehicle_id', '=', 'vehicles.id')
            ->select('orders.id', 'drivers.name as driver_name', 'orders.order_date', 'orders.end_date', 'vehicles.vehicle_name', 'orders.status');
    }

    public function headings(): array
    {
        return [
            'No',
            'Driver Name',
            'Order Date',
            'End Date',
            'Vehicle Name',
            'Status',
        ];
    }
}