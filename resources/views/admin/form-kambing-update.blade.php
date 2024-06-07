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
                            <li class="breadcrumb-item active" aria-current="page">Penerimaan</li>
                        </ol>
                    </div>
                    <form action="{{ route('update-kambing', $penerimaan->id_penerimaan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            @if ($penerimaan)
                                @for ($i = 0; $i < $penerimaan->total_penerimaan; $i++)
                                    @php
                                        $existingKambing = $kambing[$i] ?? null;
                                        $existingKambingAwal = $kambingawal[$i] ?? null;
                                    @endphp
                                    <div class="col-lg-6">
                                        <div class="card mb-4">
                                            <div
                                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">Inputkan
                                                    {{ $title }} {{ $i + 1 }}</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="kode_kambing_{{ $i }}">Kode Kambing</label>
                                                    <input type="text" class="form-control"
                                                        id="kode_kambing_{{ $i }}" placeholder="Kode Kambing"
                                                        name="kode_kambing[]"
                                                        value="{{ $existingKambing->kode_kambing ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="umur_{{ $i }}">Umur Hewan (Bulan)</label>
                                                    <input type="number" class="form-control"
                                                        id="umur_{{ $i }}" placeholder="Umur Hewan (Bulan)"
                                                        required min="0" name="umur[]"
                                                        value="{{ $existingKambing->umur ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="jenis_kelamin_{{ $i }}">Jenis
                                                        Kelamin</label>
                                                    <select class="form-control" name="jenis_kelamin[]"
                                                        id="jenis_kelamin_{{ $i }}" required>
                                                        <option value="" disabled
                                                            {{ !$existingKambing ? 'selected' : '' }}>Pilih Jenis
                                                            Kelamin</option>
                                                        <option value="jantan"
                                                            {{ $existingKambing && $existingKambing->jenis_kelamin == 'jantan' ? 'selected' : '' }}>
                                                            Jantan</option>
                                                        <option value="betina"
                                                            {{ $existingKambing && $existingKambing->jenis_kelamin == 'betina' ? 'selected' : '' }}>
                                                            Betina</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="harga_beli_{{ $i }}">Harga Beli</label>
                                                    <input type="number" class="form-control harga_beli"
                                                        id="harga_beli_{{ $i }}" placeholder="Harga Beli"
                                                        min="0" name="harga_beli[]"
                                                        value="{{ $existingKambing->harga_beli ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="status_{{ $i }}">Status</label>
                                                    <select class="form-control status" name="status[]"
                                                        id="status_{{ $i }}" required
                                                        onchange="toggleInputs({{ $i }})">
                                                        <option value="" disabled
                                                            {{ !$existingKambing ? 'selected' : '' }}>Pilih Status
                                                        </option>
                                                        <option value="Penggemukan"
                                                            {{ $existingKambing && $existingKambing->status == 'Penggemukan' ? 'selected' : '' }}>
                                                            Penggemukan</option>
                                                        <option value="Siap Jual"
                                                            {{ $existingKambing && $existingKambing->status == 'Siap Jual' ? 'selected' : '' }}>
                                                            Siap Jual</option>
                                                        <option value="Terjual"
                                                            {{ $existingKambing && $existingKambing->status == 'Terjual' ? 'selected' : '' }}>
                                                            Terjual</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="berat_badan_awal_{{ $i }}">Berat Hewan Awal
                                                        (Kg)</label>
                                                    <input type="number" class="form-control"
                                                        id="berat_badan_awal_{{ $i }}"
                                                        placeholder="Berat Hewan (Kg)" min="0"
                                                        name="berat_badan_awal[]" required
                                                        value="{{ $existingKambingAwal->berat_badan_awal ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="tinggi_badan_awal_{{ $i }}">Tinggi Hewan
                                                        Awal (Cm)</label>
                                                    <input type="number" class="form-control"
                                                        id="tinggi_badan_awal_{{ $i }}"
                                                        placeholder="Tinggi Hewan Awal (Cm)" required min="0"
                                                        name="tinggi_badan_awal[]"
                                                        value="{{ $existingKambingAwal->tinggi_badan_awal ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="poel_awal_{{ $i }}">Poel Awal</label>
                                                    <input type="number" class="form-control"
                                                        id="poel_awal_{{ $i }}" placeholder="Poel Awal"
                                                        required min="0" name="poel_awal[]"
                                                        value="{{ $existingKambingAwal->poel_awal ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="jenis_kambing_{{ $i }}">Jenis
                                                        Kambing</label>
                                                    <select class="form-control" name="id_jenis_kambing[]"
                                                        id="id_jenis_kambing_{{ $i }}" required>
                                                        <option value="" disabled
                                                            {{ !$existingKambing ? 'selected' : '' }}>Pilih Jenis
                                                            Kambing</option>
                                                        @foreach ($jenis as $d)
                                                            <option value="{{ $d->id_jenis_kambing }}"
                                                                {{ $existingKambing && $existingKambing->id_jenis_kambing == $d->id_jenis_kambing ? 'selected' : '' }}>
                                                                {{ $d->jenis_kambing }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="kategori_kambing_{{ $i }}">Kategori
                                                        Kambing</label>
                                                    <select class="form-control" name="id_kategori_kambing[]"
                                                        id="id_kategori_kambing_{{ $i }}" required>
                                                        <option value="" disabled
                                                            {{ !$existingKambing ? 'selected' : '' }}>Pilih Kategori
                                                        </option>
                                                        @foreach ($kategori as $k)
                                                            <option value="{{ $k->id_kategori_kambing }}"
                                                                {{ $existingKambing && $existingKambing->id_kategori_kambing == $k->id_kategori_kambing ? 'selected' : '' }}>
                                                                {{ $k->nama_kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="id_penerimaan_{{ $i }}">ID
                                                        Penerimaan</label>
                                                    <input type="number" class="form-control"
                                                        id="id_penerimaan_{{ $i }}"
                                                        placeholder="ID Penerimaan" name="id_penerimaan"
                                                        value="{{ $penerimaan->id_penerimaan }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                    <!-- Modal Logout -->
                    @include('partials.modal-logout')
                </div>
                <!---Container Fluid-->
            </div>
            <br>
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

    <script>
        function toggleInputs(index) {
            const statusSelect = document.getElementById(`status_${index}`);
            const beratHewanAkhirInput = document.getElementById(`berat_hewan_akhir_${index}`);
            const tinggiHewanAkhirInput = document.getElementById(`tinggi_hewan_akhir_${index}`);
            const hargaHewanInput = document.getElementById(`harga_hewan_${index}`);

            if (statusSelect.value === "Penggemukan") {
                beratHewanAkhirInput.value = '';
                tinggiHewanAkhirInput.value = '';
                hargaHewanInput.value = '';
                beratHewanAkhirInput.disabled = true;
                tinggiHewanAkhirInput.disabled = true;
                hargaHewanInput.disabled = true;
            } else {
                beratHewanAkhirInput.disabled = false;
                tinggiHewanAkhirInput.disabled = false;
                hargaHewanInput.disabled = false;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const statusSelects = document.querySelectorAll('.status');
            statusSelects.forEach((select, index) => toggleInputs(index));
        });
    </script>

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
