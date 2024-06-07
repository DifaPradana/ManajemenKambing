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
                                    <form action="{{ route('create-penjualan') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="id_kambing">
                                                Kambing</label>
                                            <select class="form-control" id="id_kambing" name="id_kambing">
                                                <option disabled selected>Pilih Kambing
                                                </option>
                                                @foreach ($kambing as $s)
                                                    <option value="{{ $s->id_kambing }}">{{ $s->kode_kambing }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="exampleInputTotalPenerimaan">Nomor Telepon Pembeli</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1"
                                                placeholder="Nomor Telepon Pembeli" name="no_telp_pembeli">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputTotalPenerimaan">Alamat Pembeli</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                placeholder="Alamat Pembeli" name="alamat_pembeli">
                                        </div>
                                        <div class="form-group">
                                            <label for="kode_kambing">Kode Kambing:</label>
                                            <select type="text" class="form-control" id="id_kambing"
                                                name="id_kambing" required value="">
                                                <option disabled selected value="">Pilih Kode Kambing</option>
                                                @foreach ($kambing as $k)
                                                    <option value="{{ $k->id_kambing }}">{{ $k->kode_kambing }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputTotalPenerimaan">Catatan</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                placeholder="Catatan" name="catatan">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputTotalPenerimaan">Total Harga</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                placeholder="Total Harga" name="total_harga" readonly>
                                        </div> --}}

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>



                    <!-- Modal Logout -->
                    @include('partials.modal-logout')

                </div>
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">
                                DataTables with Hover
                            </h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Kode Kambing</th>
                                        <th>Harga</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($item_penjualan as $i)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $i->kambing->kode_kambing }}</td>
                                            <td>{{ $i->kambing->harga_jual }}</td>
                                            <td>
                                                <div class="mb-2">
                                                    <form id="deleteForm{{ $i->id_item_penjualan }}"
                                                        action="{{ route('delete-penjualan', $i->id_item_penjualan) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-block"
                                                            onclick="confirmDelete({{ $i->id_item_penjualan }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>


                                                <script>
                                                    function confirmDelete(id) {
                                                        Swal.fire({
                                                            title: "Are you sure?",
                                                            text: "You won't be able to revert this!",
                                                            icon: "warning",
                                                            showCancelButton: true,
                                                            confirmButtonColor: "#3085d6",
                                                            cancelButtonColor: "#d33",
                                                            confirmButtonText: "Yes, delete it!"
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                // Get the form element
                                                                const form = document.getElementById('deleteForm' + id);
                                                                // Submit the form
                                                                form.submit();
                                                                // Show a success message
                                                                Swal.fire({
                                                                    title: "Deleted!",
                                                                    text: "Your file has been deleted.",
                                                                    icon: "success"
                                                                });
                                                            }
                                                        });
                                                    }
                                                </script>

                                            </td>
                                        </tr>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada data
                                                penerimaan yang
                                                tersedia.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            @if (isset($total_harga))
                                <h3>Total Harga: Rp. {{ number_format($total_harga, 0, ',', '.') }}</h3>
                            @endif
                            {{-- @dd($penjualan) --}}


                            @if ($penjualan)
                                <div class="form-group">
                                    <a href="{{ route('checkoutView', $penjualan->id_penjualan) }}"
                                        class="btn btn-success">Checkout</a>
                                </div>
                            @endif
                        </div>

                    </div>
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
        {{-- @elseif($message = Session::get('success'))
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "{{ $message }}",
                showConfirmButton: true,
                timer: 1000
            });
        </script> --}}
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





    {{-- <script>
        function addNewInput() {
            var inputContainer = document.getElementById('inputContainer');
            var newInput = document.createElement('div');
            newInput.innerHTML = `
        <div class="form-group">
            <label for="exampleInputTotalPenerimaan">Kode Kambing</label>
            <input type="text" class="form-control" placeholder="Kode Kambing" name="kode_kambing" >
            <br>
            <span class="ml-2">Harga</span>
            <br>
        </div>
    `;
            inputContainer.appendChild(newInput);
        }

        function removeInput(button) {
            var inputContainer = button.parentNode.parentNode; // Parent dari parent (form-group) adalah inputContainer
            var inputToRemove = button.parentNode; // Parent dari button adalah form-group
            inputContainer.removeChild(inputToRemove); // Hapus form-group dari inputContainer
        }
    </script> --}}
</body>

</html>
