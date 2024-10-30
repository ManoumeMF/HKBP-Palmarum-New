<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class DropdownLokasiContoller extends Controller
{
    public function kota(Request $request)
    {
        $id = $request->idProvinsi;

        $kota = DB::select('CALL cbo_cities(' . $id . ')');

        return response()->json($kota);
    }

    public function kecamatan(Request $request)
    {
        $idK = $request->idKota;

        $kecamatan = DB::select('CALL cbo_kecamatan(' . $idK . ')');

        return response()->json($kecamatan);
    }

    public function kelurahan(Request $request)
    {
        $idKl = $request->idKelurahan;

        $kelurahan = DB::select('CALL cbo_subdistricts(' . $idKl . ')');

        return response()->json($kelurahan);
    }

    public function jemaat_combobox(Request $request)
    {
        $id = $request->idJemaat;

        $jemaat = DB::select('CALL cbo_jemaatByIdRegistrasi(' . $id . ')');

        return response()->json($jemaat);
    }
}