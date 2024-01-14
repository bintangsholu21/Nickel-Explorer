<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <style>
        body {
            background-image: url('{{ asset('template/img/bgLogin.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>

<body>
    <div class="container my-3">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5" style="border-radius: 20px; ">
                    <div class="card-body p-0 ">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-gradient-primary py-5">
                                <div class="p-5 my-5 text-center">
                                    <i class="fas fa-atom fa-5x text-white"></i>
                                    <h1 class="h3 font-weight-bolder text-white my-3">Nickel Explorer</h1>
                                    <h2 class="h6 text-white mb-4">Sistem Informasi Pemesanan Kendaraan</h2>
                                </div>
                            </div>
                            <div class="col-lg-6" style="background-color: white; ">
                                <div class="p-5">
                                    <div class="text-center mt-3">
                                        <div class="text-center">
                                            <h1 class="h3 font-weight-bolder text-gray-900 mb-2">LOGIN</h1>
                                            <h2 class="h6 font-weight-normal text-gray-900 mb-4">Masuk dengan akun anda
                                                untuk melakukan pemesanan Kendaraan</h2>
                                        </div>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        @if (session('error'))
                                            <script>
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Login Gagal',
                                                    text: '{{ session('error') }}',
                                                })
                                            </script>
                                        @endif

                                        <div class="form-group mt-5 mb-3">
                                            <label class="form-label font-weight-bold ">Email</label>
                                            <div class="input-group input-group-md">
                                                <div class="input-group">
                                                    <input class="no-border form-control"
                                                        aria-describedby="inputGroup-sizing-md"
                                                        placeholder="Silahkan masukkan email anda" type="email"
                                                        name="email" required autofocus>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mt-2 mb-5">
                                            <label class="form-label font-weight-bold ">Password</label>
                                            <div class="input-group input-group-md">
                                                <div class="input-group">
                                                    <input class="no-border form-control"
                                                        aria-describedby="inputGroup-sizing-md" name="password"
                                                        placeholder="Silahkan masukkan password anda" type="password"
                                                        value="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mt-2">
                                            <button type="submit"
                                                class="d-sm-inline-block btn btn-primary shadow-sm mt-1"
                                                style="border-radius: 15px; font-size: 1.2rem; font-weight: 600; border-width: 2pt ; padding: 8px 15px; margin: auto;">
                                                Sign In
                                            </button>
                                        </div>

                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>



    </div>
    @include('partials.scriptJs')

</body>

</html>
