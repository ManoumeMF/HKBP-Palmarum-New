<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MajelisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majelis = DB::select('CALL viewAll_majelis()');
        $dataArray = json_decode($majelis[0]->results, true); // Convert only if it's a string

        return view('admin.Master.Majelis.index', compact('dataArray'));
    }

    public function create(Request $request)
    {
        $userSession = json_decode($request->session()->get('userSession'), true);
        $idGereja = $userSession[0]['id_gereja'];

        $registrasiJemaat = DB::select('CALL cbo_registrasiJemaat()');
        $pelayanGereja = DB::select('CALL cbo_pelayanGereja()');
        $wijk = DB::select('CALL cbo_wijk(' . $idGereja . ')');

        return view('admin.Master.Majelis.create', compact('wijk', 'registrasiJemaat', 'pelayanGereja'));
    }

    public function store(Request $request)
    {
        $userSession = json_decode($request->session()->get('userSession'), true);
        $idGereja = $userSession[0]['id_gereja'];

        $request->validate(
            $rules = [
                'id_jemaat' => 'required|jemaat|max:255|unique:majelis,id_jemaat'
            ],
            $messages = [
                'id_jemaat.required' => 'Nama Majelis Sudah Ada, Silahkan Input Majelis Yang Baru.',
                'id_jemaat.jemaat' => 'Nama Majelis Sudah Ada, Silahkan Input Majelis Yang Baru.'
            ]
        );

        $dataMajelis = json_encode([
            'IdJemaat' => $request->get('jemaat'),
            'IdPelayan' => $request->get('jawatan'),
            'IdGereja' => $idGereja,
            'TanggalTahbis' => date("m/d/Y", strtotime($request->get('tanggalDitahbiskan'))),
            'TanggalAkhirJawatan' => date("m/d/Y", strtotime($request->get('tanggalAkhirJawatan'))),
            'IdStatus' => "10",
            'Wijk' => $request->wijk,
        ]);

        //dd($dataMajelis);

        // Memanggil stored procedure untuk insert
        $response = DB::statement('CALL insert_majelis(:dataMajelis)', ['dataMajelis' => $dataMajelis]);

        if ($response) {
            return redirect()->route('Majelis.index')->with('success', 'Majelis Berhasil Disimpan!');
        } else {
            return redirect()->route('Majelis.create')->with('error', 'Majelis Gagal Disimpan!');
        }
    }


    public function getCboJemaat(Request $request)
    {
        $id = $request->idRegistrasi;

        $jemaat = DB::select('CALL cbo_namaLengkapJemaat(' . $id . ')');

        return response()->json($jemaat);
    }
}
