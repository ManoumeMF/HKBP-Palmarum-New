<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RessortController extends Controller
{
    //
    public function index() {
        $ressort = DB::select('CALL viewAll_ressort()');
        // dd($ressort); // Dump and die to check data
        return view('admin.PengaturanDanKonfigurasi.Ressort.index', compact('ressort'));
    }
    

    public function tambah() {
        $distrik = DB::table('distrik')->where('is_deleted', 0)->get();
        return view('admin.PengaturanDanKonfigurasi.Ressort.create', compact('distrik'));
    }

    public function store(Request $request) {

        $data = [
            'IdDistrik' => $request->get('id_distrik'),
            'KodeRessort' => $request->get('kode_ressort'),
            'NamaRessort' => $request->get('nama_ressort'),
            'Alamat' => $request->get('alamat'),
            'IdSubdis' => $request->get('id_subdis'),
            'PendetaRessort' => $request->get('pendeta_ressort'),
            'TglBerdiri' => $request->get('tgl_berdiri')
        ];
    
        // Encode data array to JSON
        $jsonData = json_encode($data);
    
        // Use DB::statement to call the stored procedure
        DB::statement('CALL insert_ressort(:dataRessort)', ['dataRessort' => $jsonData]);
    
        return redirect()->route('Ressort')->with('success', 'Ressort created successfully.');
    }

    // Controller method to get ressort detail by ID
    public function getRessortDetail(Request $request)
    {
        $id = $request->input('id');
        $ressort = DB::select('CALL view_ressort_byId(?)', [$id]);

        if ($ressort) {
            return response()->json([
                'status' => 200,
                'ressort' => $ressort[0]
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data not found'
            ]);
        }
    }



    public function edit($id)
{
    // Mengambil data ressort berdasarkan ID
    $ressortData = DB::select('CALL view_ressort_byId(?)', [$id]);
    $ressort = $ressortData[0];

    // Mengambil semua subdistricts
    $subdistricts = DB::table('subdistricts')->select('subdis_id', 'subdis_name')->get();

    // Ambil subdis_id dari ressort jika tersedia
    $subdis_id = isset($ressort->subdis_id) ? $ressort->subdis_id : null;

    if ($ressort) {
        return view('admin.PengaturanDanKonfigurasi.Ressort.edit', compact('ressort', 'subdistricts', 'subdis_id'));
    } else {
        return redirect()->route('Ressort')->with('error', 'Ressort Tidak Ditemukan!');
    }
}


    
    public function search(Request $request)
    {
        $search = $request->input('q');
        
        $results = DB::table('subdistricts')
                     ->select('subdis_id', 'subdis_name')
                     ->where('subdis_name', 'LIKE', "%{$search}%")
                     ->limit(10) // Batasi hasil untuk setiap permintaan
                     ->get();

        return response()->json($results);
    }
      
    public function update(Request $request, $id)
    {
        $dataRessort = json_encode([
            'IdRessort' => $id,
            'IdDistrik' => $request->get('idDistrik'),
            'KodeRessort' => $request->get('kodeRessort'),
            'NamaRessort' => $request->get('namaRessort'),
            'Alamat' => $request->get('alamat'),
            'IdSubdis' => DB::table('subdistricts')->where('subdis_name', $request->get('subdistrict'))->value('subdis_id'),
            'PendetaRessort' => $request->get('pendetaRessort'),
            'TglBerdiri' => $request->get('tglBerdiri'),
        ]);

        $response = DB::statement('CALL update_ressort(:dataRessort)', ['dataRessort' => $dataRessort]);
    
        if ($response) {
            return redirect()->route('Ressorts.index')->with('success', 'Ressort Berhasil Diubah!');
        } else {
            return redirect()->route('Ressorts.edit', $id)->with('error', 'Ressort Gagal Diubah!');
        }
    }

    public function deleteRessort(Request $request)
    {
        $id = $request->input('idRessort');

        DB::table('ressort')->where('id_ressort', $id)->update(['is_deleted' => 1]);

        return response()->json([
            'status' => 200,
            'message' => 'Data deleted successfully'
        ]);
    }
    
}
