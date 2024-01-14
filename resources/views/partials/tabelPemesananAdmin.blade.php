<div class="justify-content-start mb-4">
    <a href="{{route('formPemesanan')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2">
        <i class="fas fa-download fa-sm text-white-50"></i> Tambah Pesanan
    </a>
    <a href="{{ route('pemesanan.export') }}" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm ml-auto">
        <i class="fas fa-download fa-sm text-white-50"></i> Download Laporan Periodik
    </a>
</div>


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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
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
                                    <form action="{{ route('pemesanan.complete', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success shadow-sm" {{ $order->status != 'approved2' ? 'disabled' : '' }}>Selesai</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>