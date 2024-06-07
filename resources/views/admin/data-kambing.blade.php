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
                    {{-- Table --}}
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    Tabel {{ $title }}
                                </h6>
                            </div>
                            {{-- <div class="card-header">
                                <label for="idFilter">Filter berdasarkan Id Penerimaan:</label>
                                <input type="text" id="idFilter" class="form-control" placeholder="Filter dengan ID"
                                    style="width: 200px;">
                            </div> --}}
                            <div class="card-header">
                                <label for="categoryFilter">Filter berdasarkan Status:</label>
                                <select id="categoryFilter" class="form-control" style="width: 200px;">
                                    <option value="">All Categories</option>
                                    <option value="Penggemukan">Penggemukan</option>
                                    <option value="Siap Jual">Siap Jual</option>
                                    <option value="Terjual">Terjual</option>
                                </select>
                            </div>
                            <div class="card-header">
                                <button id="clearFilterBtn" class="btn btn-secondary">Hapus Filter</button>
                            </div>

                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Kambing</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Umur Hewan</th>
                                            <th>Berat Hewan Awal</th>
                                            <th>Tinggi Hewan Awal</th>
                                            <th>Poel Awal</th>
                                            <th>Berat Hewan Akhir</th>
                                            <th>Tinggi Hewan Akhir</th>
                                            <th>Poel Akhir</th>
                                            <th>Status Hewan</th>
                                            <th>Biaya Operasional</th>
                                            <th>Harga Jual</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($datakambing as $datakambing)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $datakambing->kode_kambing }}</td>
                                                <td>{{ $datakambing->jenis_kelamin }}</td>
                                                <td>{{ $datakambing->umur }}</td>

                                                <td>{{ $datakambing->dataKambingAwal->berat_badan_awal }}</td>
                                                <td>{{ $datakambing->dataKambingAwal->tinggi_badan_awal }}</td>
                                                <td>{{ $datakambing->dataKambingAwal->poel_awal }}</td>


                                                <td>{{ $datakambing->dataKambingAkhir->berat_badan_akhir }}</td>
                                                <td>{{ $datakambing->dataKambingAkhir->tinggi_badan_akhir }}</td>
                                                <td>{{ $datakambing->dataKambingAkhir->poel_akhir }}</td>


                                                <td>
                                                    @if ($datakambing->status === 'Penggemukan')
                                                        <span class="badge badge-primary">Penggemukan</span>
                                                    @elseif($datakambing->status === 'Siap Jual')
                                                        <span class="badge badge-success">Siap Jual</span>
                                                    @elseif($datakambing->status === 'Terjual')
                                                        <span class="badge badge-success">Terjual</span>
                                                    @else
                                                        <span class="badge badge-secondary">Status Tidak Dikenal</span>
                                                    @endif
                                                </td>
                                                {{-- @dd($datakambing->kategoriKambing) --}}

                                                <td>{{ number_format($datakambing->kategoriKambing->biaya_operasional, 0, ',', '.') }}
                                                </td>
                                                <td>{{ number_format($datakambing->harga_jual, 0, ',', '.') }}</td>


                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Belum ada data penerimaan yang
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

    <script>
        // Menangani perubahan pada dropdown filter
        document.getElementById('categoryFilter').addEventListener('change', filterTable);


        // Menangani penghapusan filter
        document.getElementById('clearFilterBtn').addEventListener('click', clearFilter);

        function filterTable() {
            const selectedStatus = document.getElementById('categoryFilter').value; // Mengambil nilai status yang dipilih
            // Mendapatkan semua baris tabel
            const rows = document.querySelectorAll('#dataTableHover tbody tr');
            let dataFound = false; // Menandakan apakah data ditemukan atau tidak

            // Melooping setiap baris tabel untuk menyembunyikan/menampilkan baris berdasarkan kriteria yang dipilih
            rows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(7)'); // Kolom status berada pada indeks ke-7

                // Memeriksa apakah data cocok dengan kriteria filter
                const statusMatch = selectedStatus === '' || statusCell.textContent.trim() === selectedStatus;

                // Menampilkan atau menyembunyikan baris berdasarkan kriteria filter
                if (statusMatch) {
                    row.style.display = ''; // Tampilkan baris
                    dataFound = true; // Set dataFound menjadi true karena data ditemukan
                } else {
                    row.style.display = 'none'; // Sembunyikan baris
                }
            });

            // Jika tidak ada data yang ditemukan, tampilkan pesan "Data tidak ditemukan"
            if (!dataFound) {
                const tbody = document.querySelector('#dataTableHover tbody');
                tbody.innerHTML = '<tr><td colspan="9" class="text-center">Data tidak ditemukan</td></tr>';
            }
        }

        // Fungsi untuk menghapus filter dan menampilkan semua data serta merefresh halaman web

        function clearFilter() {
            document.getElementById('categoryFilter').value = ''; // Hapus nilai filter status

            // Panggil fungsi filterTable untuk menampilkan semua data
            filterTable();

            // Merefresh halaman web
            location.reload();
        }


        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            const hargaInput = document.getElementById('harga_hewan');

            // Function to update the state of the harga input
            function updateHargaInputState() {
                if (statusSelect.value !== 'Siap Jual') {
                    hargaInput.value = '';
                    hargaInput.disabled = true;
                } else {
                    hargaInput.disabled = false;
                }
            }

            // Initial check
            updateHargaInputState();

            // Add event listener to the status select
            statusSelect.addEventListener('change', updateHargaInputState);
        });
    </script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dapatkan semua dropdown status
            document.querySelectorAll('select[name="status"]').forEach(function(statusDropdown) {
                // Tambahkan event listener untuk setiap dropdown
                statusDropdown.addEventListener('change', function() {
                    let kambingKode = statusDropdown.id.replace('status', '');
                    let tinggiHewanAkhir = document.getElementById('tinggi_hewan_akhir' +
                        kambingKode);
                    let beratHewanAkhir = document.getElementById('berat_hewan_akhir' +
                    kambingKode);

                    if (statusDropdown.value === 'Proses Penggemukan') {
                        tinggiHewanAkhir.disabled = true;
                        beratHewanAkhir.disabled = true;
                    } else {
                        tinggiHewanAkhir.disabled = false;
                        beratHewanAkhir.disabled = false;
                    }
                });

                // Trigger change event on page load to set initial state
                statusDropdown.dispatchEvent(new Event('change'));
            });
        });
    </script> --}}





    {{-- <script>
        // Menangani perubahan pada dropdown filter
        document.getElementById('categoryFilter').addEventListener('change', function() {
            const selectedStatus = this.value; // Mengambil nilai status yang dipilih

            // Mendapatkan semua baris tabel
            const rows = document.querySelectorAll('#dataTableHover tbody tr');


            // Melooping setiap baris tabel untuk menyembunyikan/menampilkan baris berdasarkan status
            rows.forEach(row => {
                const statusCell = row.querySelector(
                    'td:nth-child(7)'); // Kolom status berada pada indeks ke-7

                if (selectedStatus === '' || statusCell.textContent.trim() === selectedStatus) {
                    // Jika status yang dipilih adalah semua status atau status pada baris ini sesuai dengan status yang dipilih
                    row.style.display = ''; // Tampilkan baris
                } else {
                    row.style.display = 'none'; // Sembunyikan baris
                }

            });
        });
    </script> --}}
</body>

</html>
