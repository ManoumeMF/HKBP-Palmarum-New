<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.PengaturanDanKonfigurasi.Jemaat.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $wijk = DB::select('CALL cbo_wijk()');
        $provinces = DB::select('CALL cbo_provinces()');
        $pendidikan = DB::select('CALL cbo_pendidikan()');
        $bidangPendidikan = DB::select('CALL cbo_bidangPendidikan()');
        $pekerjaan = DB::select('CALL cbo_pekerjaan()');
        $golonganDarah = DB::select('CALL cbo_golonganDarah()');
        $gereja = DB::select('CALL cbo_gerejaAll()');
        $dokumen = DB::select('CALL cbo_jenisDokumen()');
        $hubunganKeluarga = DB::select('CALL cbo_hubunganKeluarga()');


        return view('admin.PengaturanDanKonfigurasi.Jemaat.create', compact('wijk', 'provinces', 'pendidikan', 'bidangPendidikan', 'pekerjaan', 'golonganDarah', 'gereja', 'dokumen', 'hubunganKeluarga'));
    }

    /**
     * Show the form for editing a current resource.
     */
    public function edit($id)
    {
        return view('admin.PengaturanDanKonfigurasi.Jemaat.edit');
    }

    public function store(Request $request)
    {
        //dd($request->dataRegistrasiJemaat);
        $dataRegistrasi =$request->all();

        dd($dataRegistrasi);

        if ($dataRegistrasi) {
            //$dataRegistrasi = json_encode($request->dataRegistrasiJemaat);
            // Handle the data as required...
            $response = DB::statement('CALL insert_jemaat(:dataJemaat)', ['dataJemaat' => $dataRegistrasi]);

            return response()->json([
                'status' => 200,
                'message' => 'Jemaat Berhasil Ditambahkan!'
            ]);
        } else {
            //dd($request->dataRegistrasiJemaat);
            return response()->json([
                'status' => 400,
                'message' => 'Jemaat Gagal Disimpan!',
                'data' => $dataRegistrasi
            ]);
        }
    }

    public function editAnggota($id)
    {
        return view('admin.PengaturanDanKonfigurasi.Jemaat.editAnggota');
    }
}
