<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GerejaController extends Controller
{
    public function index()
    {
        $gereja = DB::select('CALL viewAll_gereja()');
        return view("admin.PengaturanDanKonfigurasi.Gereja.index", ['gereja' => $gereja]);
    }

    public function create()
    {
        $chruchTypeCombo = DB::select('CALL cbo_jenisGereja()');
        $ressortCombo = DB::select('CALL cbo_ressort()');
        $subdistrictsCombo = DB::select('CALL cbo_subdistricts()');



        return view('admin.PengaturanDanKonfigurasi.Gereja.create', ['chruchType' => $chruchTypeCombo, 'ressort' => $ressortCombo, 'subdistricts' => $subdistrictsCombo]);
    }

    public function store(Request $request)
    {
        $kodeGereja = DB::select('SELECT create_kode_gereja(?) AS kode_gereja', [$request->get('ressort')]);
        $Gereja = json_encode([
            'IdRessort' => $request->get('ressort'),
            'IdJenisGereja' => $request->get('jenisGereja'),
            'KodeGereja'  => $kodeGereja[0]->kode_gereja,
            'NamaGereja'  => $request->get('namaGereja'),
            'Alamat'  => $request->get('alamatGereja'),
            'SubDistrictId'  => $request->get('SubDistrictId'),
            'NamaPendeta'  => $request->get('namaPendeta'),
            'TglBerdiri'  => $request->get('tanggalBerdiri'),
        ]);

        $response = DB::statement('CALL insert_gereja(:dataGereja)', ['dataGereja' => $Gereja]);

        if ($response) {
            return redirect()->route('Gereja.index')->with('success', 'Gereja Berhasil Ditambahkan!');
        } else {
            return redirect()->route('Gereja.create')->with('error', 'Gereja Gagal Disimpan!');
        }
    }

    public function storeRessort(Request $request)
    {

        $JenisStatus = json_encode([
            'JenisStatus' => $request->get('jenisStatusModal'),
            'Keterangan'  => $request->get('jenisKeteranganModal')
        ]);


        $response = DB::statement('CALL insert_jenisStatus(:dataJenisStatus)', ['dataJenisStatus' => $JenisStatus]);

        if ($response) {
            return response()->json([
                'status' => 200,
                'message' => 'Jenis Status Berhasil Ditambahkan.'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Jenis Status Gagal Ditambahkan.'
            ]);
        }
    }

    public function storeChurchType(Request $request)
    {

        $JenisGereja = json_encode([
            'JenisStatus' => $request->get('jenisStatusModal'),
            'Keterangan'  => $request->get('jenisKeteranganModal')
        ]);

        //dd($JenisStatus);

        $response = DB::statement('CALL insert_jenisStatus(:dataJenisStatus)', ['dataJenisGereja' => $JenisGereja]);

        if ($response) {
            return response()->json([
                'status' => 200,
                'message' => 'Jenis Status Berhasil Ditambahkan.'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Jenis Status Gagal Ditambahkan.'
            ]);
        }
    }

    public function detail(Request $request)
    {

        $id = $request->id;

        $gerejaData = DB::select('CALL view_gereja_byId('  . $id . ')');
        $gereja = $gerejaData[0];

        if ($gereja) {
            return response()->json([
                'gereja' => 200,
                'gereja' => $gereja
            ]);
        } else {
            return response()->json([
                'gereja' => 404,
                'message' => 'Data Gereja Tidak Ditemukan.'
            ]);
        }
    }

    public function delete(Request $request)
    {
        $gerejaData = DB::select('CALL view_gereja_byId(' . $request->get('id_gereja') . ')');
        $gerejaTemp = $gerejaData[0];

        if ($gerejaTemp) {
            $id = $request->get('id_gereja');

            $response = DB::select('CALL delete_gereja(?)', [$id]);

            return response()->json([
                'status' => 200,
                'message' => 'Data Gereja Berhasil Dihapus!'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Gereja Tidak Ditemukan.'
            ]);
        }
    }
}
