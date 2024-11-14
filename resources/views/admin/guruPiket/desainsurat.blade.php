<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Izin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            line-height: 1.3;
            margin: 0;
            padding: 4mm;
            width: 80mm;
            height: auto;
        }

        .surat-container {
            width: 100%;
            padding: 2mm;
        }

        .header {
            text-align: left;
            margin-bottom: 5px;
        }

        .details .row {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 5px;
        }

        .footer {
            margin-top: 10px;
            text-align: right;
        }

        h4 {
            margin: 2px 0;
        }

        @media print {
            body {
                margin: 0;
                padding: 4mm;
                width: 80mm;
                height: auto;
            }

            * {
                -webkit-print-color-adjust: exact;
            }

            @page {
                margin: 4mm;
                size: 10mm auto;
            }
        }
    </style>

</head>

<body onload="window.print();">
    <div class="surat-container">
        <div class="header">
            @php
                $data = App\Models\sekolah::first();
            @endphp
            @if ($data)
                <p style="font-weight: bold;">{{ $data->nama_sekolah }}</p>
                <p><small>{{ $data->alamat_sekolah }}</small></p>
                <hr style="border: 0.5px solid black;">
            @endif
        </div>
        <div class="details">
            <div class="row">
                <div><strong>No:</strong> {{ $suratIzins[0]->nomor ?? 'Tidak ada nomor' }}</div>
            </div>
            <div class="row">
                <div><strong>Hal:</strong> {{ $suratIzins[0]->perihal ?? 'Tidak ada perihal' }}</div>
            </div>
            <h4>Kepada Yth. Bp/Ibu Guru</h4>
            <h4>Dengan ini kami memberitahukan bahwa:</h4>
            <div class="row" style="margin-top: 3px;">
                <div>
                    <strong>Nama Siswa:</strong>
                    @php
                        $namaSiswa = $studentsWithSameUUID->pluck('nama_siswa')->join(', ');
                    @endphp
                    {{ $namaSiswa ?: 'Tidak ada nama siswa' }}
                </div>
            </div>
            <div class="row">
                <div>
                    <strong>Kelas:</strong>
                    @if ($studentsWithSameUUID->isNotEmpty())
                    @php $student = $studentsWithSameUUID [0] @endphp
                            {{ $student->kelas == 10 ? 'X' : ($student->kelas == 11 ? 'XI' : 'XII') }}
                            {{ $student->jurusan->nama_jurusan ?? 'Jurusan tidak ada' }}
                    @else
                        Tidak ada kelas
                    @endif
                </div>
            </div>
            @php
                \Carbon\Carbon::setLocale('id');
                $tanggal = \Carbon\Carbon::now()->translatedFormat('l, d F Y');
            @endphp
            <h4>Tidak mengikuti kegiatan belajar mengajar pada hari {{ $tanggal }} pada jam
                {{ $suratIzins[0]->jam_pelajaran ?? 'Jam tidak tersedia' }}
                dengan alasan
                {{ $suratIzins[0]->keterangan ?? 'Alasan tidak tersedia' }}
            </h4>
        </div>
        <div class="footer">
            <p>Semarang, {{ now()->format('d/m/Y') }}</p>
            <p>{{ session('username') }}</p>
            <p style="margin-top: 80px;">( {{ session('nama_pengguna') }} )</p>
        </div>
    </div>
</body>

</html>
