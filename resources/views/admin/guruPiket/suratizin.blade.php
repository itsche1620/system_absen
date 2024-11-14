@extends('layout.masterFile')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Surat Izin</h1>
                        <section class="content mt-4">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header d-flex flex-wrap align-items-center">
                                                @if (session('username') == 'Guru Piket')
                                                @else
                                                    <a href="#" class="btn btn-primary mr-2" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">
                                                        <i class="fa fa-plus"></i> Buat Surat
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <form action="{{ route('suratizin.cetak') }}" class="p-3"
                                                            method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="nomor">Nomor Surat</label>
                                                                <input type="text" class="form-control" id="nomor"
                                                                    name="nomor" placeholder="Nomor Surat" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="perihal">Perihal</label>
                                                                <select class="form-control" id="perihal" name="perihal"
                                                                    required>
                                                                    <option value="" disabled selected>Pilih Perihal
                                                                    </option>
                                                                    <option
                                                                        value="Surat Izin Keluar Lingkungan Sekolah/Kelas">
                                                                        Surat Izin Keluar Lingkungan Sekolah/Kelas</option>
                                                                    <option value="Surat Izin Masuk">Surat Izin Masuk
                                                                    </option>
                                                                    <option value="Surat Izin Pulang">Surat Izin Pulang
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label>Nama Siswa</label>
                                                                <multi-input class="form-control" placeholder="Nama Siswa" required>
                                                                    <input list="speakers" class="nama_siswa">
                                                                    <datalist id="speakers" class="nama_siswa_list">
                                                                        <option value=""></option>
                                                                    </datalist>
                                                                    <div class="input-siswa-list">
                                                                    </div>
                                                                </multi-input>
                                                                @error('nama_list')
                                                                    <span class="text-danger" style="display: none;">nama tidak boleh kosong</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="jam_pelajaran">Jam Pelajaran</label>
                                                                <input type="text" class="form-control"
                                                                    id="jam_pelajaran" name="jam_pelajaran"
                                                                    placeholder="Jam Pelajaran">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="keterangan">Alasan</label>
                                                                <input type="text" class="form-control" id="keterangan"
                                                                    name="keterangan" placeholder="Alasan" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Buat</button>
                                                            <script>
                                                                function submitAndPrint() {
                                                                    const formData = {
                                                                        nomor: document.getElementById('nomor').value,
                                                                        perihal: document.getElementById('perihal').value,
                                                                        nama: document.getElementById('nama').value,
                                                                        jam_pelajaran: document.getElementById('jam_pelajaran').value,
                                                                        keterangan: document.getElementById('keterangan').value,
                                                                        _token: '{{ csrf_token() }}'
                                                                    };


                                                                    fetch("{{ route('suratizin.cetak') }}", {
                                                                            method: "POST",
                                                                             headers: {
                                                                                "Content-Type": "application/json",
                                                                                "X-CSRF-Token": formData._token
                                                                            },
                                                                            body: JSON.stringify(formData)
                                                                        })
                                                                        .then(response => response.json())
                                                                        .then(data => {
                                                                            if (data.success) {
                                                                                window.print();
                                                                            } else {
                                                                                alert("Gagal mencetak surat izin.");
                                                                            }
                                                                        })
                                                                        .catch(error => console.error("Error:", error));
                                                                }
                                                            </script>
                                                        </form>
                                                    </div>
                                                    <div class="col-sm p-2">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $(".nama_siswa").keyup(function() {
                let ctx = this;
                let nama = $(this).val().trim();
                $.ajax({
                    url: '/sipensi/carisiswa',
                    type: 'get',
                    data: {
                        nama: nama
                    },
                    success: function(data) {
                        let siswa = data;
                        let nama_siswa_list = $(".nama_siswa_list");
                        nama_siswa_list.empty();

                        siswa.forEach(function(s) {
                            // Check if the returned name closely matches the input
                            if (s.nama_siswa.toLowerCase().includes(nama.toLowerCase())) {
                                nama_siswa_list.append(
                                    `<option value="${s.nama_siswa}"></option>`
                                );
                            }
                        });

                        // Refresh the input after updating the options
                        $(ctx).parent()[0].refresh($(".nama_siswa")[0]);
                    }
                });
            });

            $(document).delegate('.nama_siswa', 'change', function() {
                let option = $(this).parent()[0].addItem($(this).val());
                let containerList = $(this).parent().find('.input-siswa-list');
                containerList.empty();
                option.forEach(function(o) {
                    containerList.append(`<input value="${o}" type="hidden" name="nama_list[]">`);
                });
            });
        });
    </script>
@endpush

