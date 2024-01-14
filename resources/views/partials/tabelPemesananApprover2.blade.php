<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Pemesanan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Driver</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Jenis Kendaraan</th>
                        <th>Status</th>
                        <th>Persetujuan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($orders as $key => $order)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $order->driver->name }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->end_date}}</td>
                            <td>{{ $order->vehicle->vehicle_name }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-6 d-inline-block">
                                        <form action="{{ route('pemesanan.approve', $order->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success shadow-sm" {{ $order->status == 'pending' && Auth::user()->role == 'approver2' || $order->status == 'done' ? 'disabled' : '' }}>Setujui</button>
                                        </form>
                                    </div>
                                    <div class="col-6 d-inline-block">
                                        <form action="{{ route('pemesanan.reject', $order->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger shadow-sm" {{ $order->status == 'pending' && Auth::user()->role == 'approver2' || $order->status == 'done' ? 'disabled' : '' }}>Tolak</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>