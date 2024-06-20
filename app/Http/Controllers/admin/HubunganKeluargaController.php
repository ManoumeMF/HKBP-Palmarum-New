<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Facades\Validator;

class HubunganKeluargaController extends Controller
{
    protected $rules = array(
        'HubunganKeluarga'=> 'required'
    );

    protected $messages = array(
        'HubunganKeluarga.required' => 'Hubungan Keluarga tidak boleh kosong.'
    );
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fieldHubunganKeluarga = DB::select('CALL viewAll_hubunganKeluarga()');  

        return view('admin.PengaturanDanKonfigurasi.HubunganKeluarga.index', compact('fieldHubunganKeluarga'));
    }

    public function fetchHubunganKeluargaField(){
        $fieldHubunganKeluargas = DB::select('CALL viewAll_hubunganKeluarga()');
        return response()->json([
            'fieldHubunganKeluargas'=> $fieldHubunganKeluargas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.PengaturanDanKonfigurasi.HubunganKeluarga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $HubunganKeluarga = json_encode([
            'nama_hub_keluarga' => $request->get('nama_hub_keluarga'),
            'keterangan'  => $request->get('keterangan')
        ]);

        //dd($BidangHubunganKeluarga);

        $response = DB::statement('CALL insert_hubunganKeluarga(:dataHubunganKeluarga)', ['dataHubunganKeluarga' => $HubunganKeluarga]);

        if ($response) {
            return redirect()->route('HubunganKeluarga.index')->with('success', 'Hubungan Keluarga Berhasil Disimpan!');
        } else {
            return redirect()->route('HubunganKeluarga.create')->with('error', 'Hubungan Keluarga Gagal Disimpan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = $request->id;

        $fieldHubunganKeluargaData = DB::select('CALL view_hubunganKeluarga_byId(' . $id . ')');
        $fieldHubunganKeluarga = $fieldHubunganKeluargaData[0];

        //dd($fieldEducation);

        if ($fieldHubunganKeluarga) {
            return response()->json([
                'status'=> 200,
                'fieldHubunganKeluarga' => $fieldHubunganKeluarga
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Hubungan Keluarga Tidak Ditemukan.'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fieldHubunganKeluargaData = DB::select('CALL view_hubunganKeluarga_byId(' . $id . ')');
        $fieldHubunganKeluarga = $fieldHubunganKeluargaData[0];

        if ($fieldHubunganKeluarga) {
           return view('admin.PengaturanDanKonfigurasi.HubunganKeluarga.edit', compact('fieldHubunganKeluarga'));
        } else {
            return redirect()->route('HubunganKeluarga.index')->with('error', 'Hubungan Keluarga Tidak Ditemukan!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $HubunganKeluarga = json_encode([
            'id_hub_keluarga' => $id,
            'nama_hub_keluarga' => $request->get('nama_hub_keluarga'),
            'keterangan' => $request->get('keterangan')
        ]);

        $response = DB::statement('CALL update_hubunganKeluarga(:dataHubunganKeluarga)', ['dataHubunganKeluarga' => $HubunganKeluarga]);
    
        if ($response) {
            return redirect()->route('HubunganKeluarga.index')->with('success', 'Hubungan Keluarga Berhasil Diubah!');
        } else {
            return redirect()->route('HubunganKeluarga.edit', $id)->with('error', 'Hubungan Keluarga Gagal Diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fieldHubunganKeluargaData = DB::select('CALL view_hubunganKeluarga_byId(' . $request -> get('id_hub_keluarga') . ')');
        $fieldHubunganKeluarga = $fieldHubunganKeluargaData[0];

        if ($fieldHubunganKeluarga) {
            $id = $request -> get('id_hub_keluarga');

            $response = DB::select('CALL delete_hubunganKeluarga(?)', [$id]);
            
            return response()->json([
                'status' => 200,
                'message'=> 'Data Hubungan Keluarga Berhasil Dihapus.'
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Hubungan Keluarga Tidak Ditemukan.'
            ]);
        }
    }
}
