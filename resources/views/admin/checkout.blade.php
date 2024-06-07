<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ $title }}</title>
    @include('partials.style')
</head>

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        @include('partials.sidebar')
        <!-- Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- TopBar -->
                @include('partials.topbar')
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Inputkan Datanya</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('checkout', $penjualan->id_penjualan) }}" method="POST">
                                        @method('PUT')
                                        @csrf

                                        <div class="form-group">
                                            <label for="exampleInputPelanggan">Pelanggan</label>
                                            <select class="form-control" id="exampleInputPelanggan" name="id_pelanggan"
                                                required>
                                                <option disabled selected>Pilih Pelanggan</option>
                                                @foreach ($pelanggan as $b)
                                                    <option value="{{ $b->id_pelanggan }}"
                                                        data-nama="{{ $b->nama_pelanggan }}"
                                                        data-alamat="{{ $b->alamat }}"
                                                        data-telp="{{ $b->telp }}">
                                                        {{ $b->nama_pelanggan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat">Alamat Pelanggan</label>
                                            <input type="text" class="form-control" id="alamat"
                                                placeholder="Alamat pelanggan" name="alamat"readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="telp">Telp Pelanggan</label>
                                            <input type="number" class="form-control" id="telp"
                                                placeholder="Telp pelanggan" name="telp"readonly>
                                        </div>

                                        {{-- @dd($penjualan->total_harga) --}}
                                        <div class="form-group">
                                            <label for="total_harga">Total Bayar</label>
                                            <h2 class="form-control" id="total_harga" name="total_harga">Rp.
                                                {{ number_format($penjualan->total_harga, 0, ',', '.') }}</h2>
                                        </div>


                                        <br>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Logout -->
                    @include('partials.modal-logout')

                </div>
                <!---Container Fluid-->
            </div>
            <!-- Footer -->
            @include('partials.footer')
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('partials.script')

    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "{{ $message }}",
                showConfirmButton: false,
                timer: 1000
            });
        </script>
    @elseif($message = Session::get('success'))
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "{{ $message }}",
                showConfirmButton: true,
                timer: 1000
            });
        </script>
    @elseif($message = Session::get('error'))
        <script>
            Swal.fire({
                position: "center",
                icon: "error",
                title: "{{ $message }}",
                showConfirmButton: true,
                timer: 1000
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#exampleInputPelanggan').change(function() {
                var selectedOption = $(this).find('option:selected');
                var alamat = selectedOption.data('alamat');
                var telp = selectedOption.data('telp');

                $('#alamat').val(alamat);
                $('#telp').val(telp);
            });
        });
    </script>
</body>

</html>
