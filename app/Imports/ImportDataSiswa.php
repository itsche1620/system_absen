<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\Jurusan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Log;

class ImportDataSiswa implements ToModel, WithStartRow
{
    /**
     * Retrieve 'kode_jurusan' based on 'nama_jurusan'.
     */
    private function getKodeJurusan($namaJurusan)
    {
        $jurusan = Jurusan::where('nama_jurusan', $namaJurusan)->first();
        return $jurusan ? $jurusan->kode_jurusan : null;
    }

    /**
     * Map each row in the Excel file to the Student model.
     */
    public function model(array $row)
    {
        Log::info('Row data: ' . json_encode($row));

        $kodeJurusan = $this->getKodeJurusan($row[4]);

        Log::info('Inserting: ' . $row[0]);

        return new Student([
            'nama_siswa' => $row[0],
            'nis' => $row[1],
            'nisn' => $row[2],
            'kelas' => $row[3],
            'kode_jurusan' => $kodeJurusan,
            'jenis_kelamin' => $row[5],
        ]);
    }

    /**
     * Set the starting row for reading data.
     */
    public function startRow(): int
    {
        return 2;
    }
}
