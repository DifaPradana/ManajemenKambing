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
                                    <form action="{{ route('create-pelanggan') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nama_pelanggan">Nama Pelanggan</label>
                                            <input type="text" class="form-control" id="nama_pelanggan"
                                                placeholder="Nama pelanggan" name="nama_pelanggan">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat Pelanggan</label>
                                            <input type="text" class="form-control" id="alamat"
                                                placeholder="Alamat pelanggan" name="alamat">
                                        </div>
                                        <div class="form-group">
                                            <label for="telp">Nomor Telp Pelanggan</label>
                                            <input type="number" class="form-control" id="telp"
                                                placeholder="Nomor Telp pelanggan" name="telp">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Table --}}
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
                                            <th>Nama Pelanggan</th>
                                            <th>Alamat</th>
                                            <th>Telp</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($pelanggan as $pelanggan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pelanggan->nama_pelanggan }}</td>
                                                <td>{{ $pelanggan->alamat }}</td>
                                                <td>{{ $pelanggan->telp }}</td>
                                                <td>
                                                    <div class="mb-2">
                                                        <button type="button" class="btn btn-primary btn-block"
                                                            data-toggle="modal"
                                                            data-target="#editModal{{ $pelanggan->id_pelanggan }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </div>
                                                    <!-- Modal -->
                                                    <div class="modal fade"
                                                        id="detailModal{{ $pelanggan->id_pelanggan }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <!-- Details modal content here -->
                                                    </div>

                                                    <!-- Edit Modal -->
                                                    <div class="modal fade"
                                                        id="editModal{{ $pelanggan->id_pelanggan }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="editModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModalLabel">Edit
                                                                        pelanggan
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form
                                                                    action="{{ route('update-pelanggan', $pelanggan->id_pelanggan) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <!-- Input fields for editing -->
                                                                        <div class="form-group">
                                                                            <label for="editNamaPelanggan">Nama
                                                                                Pelangganr</label>
                                                                            <input type="text" class="form-control"
                                                                                id="editNamaPelanggan"
                                                                                placeholder="Nama Pelanggan"
                                                                                name="nama_pelanggan"
                                                                                value="{{ $pelanggan->nama_pelanggan }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="editalamatPelanggan">Alamat
                                                                                Pelanggan</label>
                                                                            <input type="text" class="form-control"
                                                                                id="editalamatPelanggan"
                                                                                placeholder="Alamat Pelanggan"
                                                                                name="alamat"
                                                                                value="{{ $pelanggan->alamat }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="telp">telp
                                                                                Pelanggan</label>
                                                                            <input type="text" class="form-control"
                                                                                id="telp"
                                                                                placeholder="telp Pelanggan"
                                                                                name="telp"
                                                                                value="{{ $pelanggan->telp }}">
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-2">
                                                        <form id="deleteForm{{ $pelanggan->id_pelanggan }}"
                                                            action="{{ route('delete-pelanggan', $pelanggan->id_pelanggan) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-block"
                                                                onclick="confirmDelete({{ $pelanggan->id_pelanggan }})">
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
                                                <td colspan="6" class="text-center">Belum ada data pelanggan yang
                                                    tersedia.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
</body>

</html>
