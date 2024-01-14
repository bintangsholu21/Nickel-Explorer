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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-start mb-3">
                        <h1 class="h3 mb-0 text-gray-800">Pemesanan Kendaraan</h1>
                    </div>


                    @php
                        $role = Auth::user()->role; // Ambil role pengguna saat ini
                    @endphp
                    
                    @if ($role == 'admin')
                        @include('partials.tabelPemesananAdmin')
                    @elseif ($role == 'approver1')
                        @include('partials.tabelPemesananApprover1')
                    @elseif ($role == 'approver2')
                        @include('partials.tabelPemesananApprover2')
                    @endif

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