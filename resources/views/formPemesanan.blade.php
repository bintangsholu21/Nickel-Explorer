<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('partials.topbar')

                <div class="container-fluid">

                    <!-- Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
                            <h6 class="m-0 font-weight-bold text-primary">Form Pemesanaan Kendaraan</h6>
                        </div>
                        <div class="card-body">

                            <form method="post" action="{{ route('storePemesanan') }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="mb-4 form-group">
                                    <label class="text-gray-900 font-weight-bold" for="driverName">Nama Driver</label>
                                    <input type="text" name="driverName" class="form-control form-control-alternative" id="driverName" placeholder="Masukkan nama driver" required>
                                </div>
                                <div class="mb-4 form-group">
                                    <label class="text-gray-900 font-weight-bold" for="orderDate">Tanggal Pemesanan</label>
                                    <input type="date" name="orderDate" class="form-control form-control-alternative" id="orderDate" required>
                                </div>
                                <div class="mb-4 form-group">
                                    <label class="text-gray-900 font-weight-bold" for="endDate">Tanggal Pengembalian</label>
                                    <input type="date" name="endDate" class="form-control form-control-alternative" id="endDate" required>
                                </div>
                                <div class="mb-4 form-group">
                                    <label class="text-gray-900 font-weight-bold" for="vehicleId">Kendaraan</label>
                                    <select class="form-select form-control" aria-label="Default select example" name="vehicleId" required>
                                        <option value="" selected disabled>Silahkan Pilih Kendaraan</option>
                                        @foreach ($availableVehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="d-sm-inline-block btn btn-primary shadow-sm ml-2 mt-2 mb-4">
                                    <i class="fas fa-sm text-white-50"></i>Submit
                                </button>

                                <a href="{{ route('pemesanan') }}" class=" d-sm-inline-block btn btn-danger shadow-sm ml-2 mt-2 mb-4">
                                    <i class="fas fa-sm text-white-50"></i>Cancel
                                </a>

                            </form>
                        </div>
                    </div>

                </div>
        <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('partials.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    @include('partials.logoutModal')

    @include('partials.scriptJs')

</body>

</html>