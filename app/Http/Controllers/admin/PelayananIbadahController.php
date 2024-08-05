<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelayananIbadahController extends Controller
{
    //
    public function index() {
        $pelayananibadah = DB::select('CALL viewAll_pelayananIbadah()');
        // dd($ressort); // Dump and die to check data
        return view('admin.PengaturanDanKonfigurasi.PelayananIbadah.index', compact('pelayananibadah'));
    }

    public function create() {
        return view('admin.PengaturanDanKonfigurasi.PelayananIbadah.create');
    }

    public function store(Request $request) {

        $data = [
            'NamaPelayananIbadah' => $request->get('nama_pelayanan_ibadah'),
            'Keterangan' => $request->get('keterangan'),
        ];
    
        // Encode data array to JSON
        $jsonData = json_encode($data);
    
        // Use DB::statement to call the stored procedure
        DB::statement('CALL insert_pelayananIbadah(:dataPelayananIbadah)', ['dataPelayananIbadah' => $jsonData]);
    
        return redirect()->route('PelayananIbadah')->with('success', 'Pelayanan Ibadah created successfully.');
    }

    public function PelayananIbadahDetail(Request $request)
    {
        $id = $request->input('id');
        $pelayananibadah = DB::select('CALL view_pelayananIbadah_byId(?)', [$id]);

        if ($pelayananibadah) {
            return response()->json([
                'status' => 200,
                'pelayananibadah' =>$pelayananibadah[0]
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
        // Mengambil data pelayanan ibadah berdasarkan ID
        $pelayananibadahData = DB::select('CALL view_pelayananIbadah_byId(?)', [$id]);
        
        if (count($pelayananibadahData) > 0) {
            $pelayananibadah = $pelayananibadahData[0];
            return view('admin.PengaturanDanKonfigurasi.PelayananIbadah.edit', compact('pelayananibadah'));
        } else {
            return redirect()->route('PelayananIbadah')->with('error', 'Pelayanan Ibadah Tidak Ditemukan!');
        }
    }
    

    public function update(Request $request, $id)
    {
        $dataPelayananIbadah = json_encode([
            'IdPelayananIbadah' => $id,
            'NamaPelayananIbadah' => $request->get('namaPelayananIbadah'),
            'Keterangan' => $request->get('keterangan'),
        ]);

        $response = DB::statement('CALL update_pelayananIbadah(:dataPelayananIbadah)', ['dataPelayananIbadah' =>$dataPelayananIbadah]);
    
        if ($response) {
            return redirect()->route('PelayananIbadah')->with('success', 'Pelayanan Ibadah Berhasil Diubah!');
        } else {
            return redirect()->route('PelayananIbadah.edit', $id)->with('error', 'Pelayanan Ibadah Gagal Diubah!');
        }
    }

    public function deletePelayananIbadah(Request $request)
    {
        $id = $request->input('idPelayananIbadah');

        DB::table('pelayanan_ibadah')->where('id_pelayanan_ibadah', $id)->update(['is_deleted' => 1]);

        return response()->json([
            'status' => 200,
            'message' => 'Data deleted successfully'
        ]);
    }
}
