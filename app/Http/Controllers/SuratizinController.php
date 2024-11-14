<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Suratizin;
use App\Models\Student;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class suratizinController extends Controller
{
    public function index()
    {
        $datasiswa = student::all();
        $sekolah = sekolah::first();

        return view("admin.guruPiket.suratizin", compact("datasiswa", "sekolah"));
    }

    public function cetak(Request $request)
    {

        $request->validate([
            'nama_list' => 'required|array',
        ]);

        if(!$request->has('nama_list')){
            return 'nama tidak boleh kosong';
        }
        $suratIzins = [];
        $listSiswa = [];
        $namesList = $request->input('nama_list');
        //dd($namesList);
        $kelas='';
        foreach ($namesList as $i => $name) {
            $student = student::where('nama_siswa', 'LIKE', '%'.$name.'%')->first();


            if ($student) {
                if($i ==0 ){
                    $kelas = $student->kelas.' '.$student->kode_jurusan;
                }

                if ($kelas == $student->kelas.' '.$student->kode_jurusan) {
                    $addsuratizin = new suratizin();
                    $addsuratizin->nomor = $request->input("nomor");
                    $addsuratizin->perihal = $request->input("perihal");
                    $addsuratizin->nis = $student->nis;
                    $addsuratizin->jam_pelajaran = $request->input("jam_pelajaran");
                    $addsuratizin->keterangan = $request->input("keterangan");
                    $addsuratizin->save();

                    $suratIzins[] = $addsuratizin;
                    $listSiswa[] = $student->nama_siswa;
                }

            }
        }


        $studentsWithSameUUID = student::whereIn('nama_siswa', $listSiswa)->get();

        return view('admin.guruPiket.desainsurat', compact('suratIzins', 'studentsWithSameUUID'));
    }
}
