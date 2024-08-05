<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistrikController extends Controller
{
    //
    public function index() {
        $distrik = DB::select('CALL viewAll_distrik()');
        // dd($ressort); // Dump and die to check data
        return view('admin.PengaturanDanKonfigurasi.Distrik.index', compact('distrik'));
    }

    public function tambah() {
        $subdis = DB::table('subdistricts')->get();
        return view('admin.PengaturanDanKonfigurasi.Distrik.create', compact('subdis'));
    }

    public function store(Request $request) {

        $data = [
            'NamaDistrik' => $request->get('nama_distrik'),
            'Alamat' => $request->get('alamat'),
            'IdKelurahan' => $request->get('id_kelurahan'),
            'NamaParaeses' => $request->get('nama_pareses'),
        ];
    
        // Encode data array to JSON
        $jsonData = json_encode($data);
    
        // Use DB::statement to call the stored procedure
        DB::statement('CALL insert_distrik(:dataDistrik)', ['dataDistrik' => $jsonData]);
    
        return redirect()->route('Distrik')->with('success', 'Distrik created successfully.');
    }

    public function getDistrikDetail(Request $request)
    {
        $id = $request->input('id');
        $distrik = DB::select('CALL view_distrik_byId(?)', [$id]);

        if ($distrik) {
            return response()->json([
                'status' => 200,
                'distrik' => $distrik[0]
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data not found'
            ]);
        }
    }

    public function deleteDistrik(Request $request)
    {
        $id = $request->input('idDistrik');

        DB::table('distrik')->where('id_distrik', $id)->update(['is_deleted' => 1]);

        return response()->json([
            'status' => 200,
            'message' => 'Data deleted successfully'
        ]);
    }
}
