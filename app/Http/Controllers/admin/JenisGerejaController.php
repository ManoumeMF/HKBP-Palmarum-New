<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisGerejaController extends Controller
{
    protected $rules = array(
        'jenisGereja'=> 'required'
    );

    protected $messages = array(
        'jenisGereja.required' => 'Jenis Gereja tidak boleh kosong.'
    );

    public function index()
    {
        $jenisGereja = DB::select('CALL viewAll_jenisGereja()'); 
        // viewAll_jenisGereja
        return view('admin.PengaturanDanKonfigurasi.JenisGereja.index', ['jenisGereja' => $jenisGereja]);
        
    }

    public function create(){

        return view('admin.PengaturanDanKonfigurasi.JenisGereja.create');

    }

    public function store(Request $request){

        $jenisGereja = json_encode([
            'JenisGereja' => $request->get('JenisGereja'),
            'Keterangan' => $request->get('Keterangan'),
        ]);

        $response = DB::statement('CALL insert_jenisGereja(:dataJenisGereja)', ['dataJenisGereja' => $jenisGereja]);

        if ($response) {
            return redirect()->route('JenisGereja.index')->with('success', 'Jenis Gereja Berhasil Ditambahkan!');
        } else {
            return redirect()->route('JenisGereja.create')->with('error', 'Jenis Gereja Gagal Disimpan!');
        }

    }

    public function edit($id)
{
    $JenisGerejaData = DB::select('CALL view_jenisGereja_byId(?)', [$id]);
    
    if (!empty($JenisGerejaData)) {
        $jenisGereja = $JenisGerejaData[0]; // Access the first (and only) element
        return view('admin.PengaturanDanKonfigurasi.JenisGereja.edit', ['jenisGereja' => $jenisGereja]);
    } else {
        return redirect()->route('JenisGereja.index')->with('error', 'Jenis Gereja Tidak Ditemukan!');
    }
}


public function update(Request $request, $id)
{
    $JenisGereja = json_encode([
        'IdJenisGereja' => $id,
        'JenisGereja' => $request->get('JenisGereja'),
        'Keterangan'  => $request->get('Keterangan')
    ]);

    $JenisGerejaData = DB::select('CALL view_jenisGereja_byId(?)', [$id]);
    $StatusJenisGereja = $JenisGerejaData[0];

    if ($StatusJenisGereja) {
        $response = DB::statement('CALL update_jenisGereja(:dataJenisGereja)', ['dataJenisGereja' => $JenisGereja]);

        if ($response) {
            return redirect()->route('JenisGereja.index')->with('success', 'Jenis Gereja Berhasil Diubah!');
        } else {
            return redirect()->route('JenisGereja.edit', $id)->with('error', 'Jenis Gereja Gagal Diubah!');
        }
    } else {
        return redirect()->route('JenisGereja.index')->with('error', 'Status Tidak Ditemukan!');
    }
}

public function detail(Request $request)
    {      
        $id = $request->id;

        $JenisGerejaData = DB::select('CALL view_jenisGereja_byId('  . $id . ')');
        $jenisGereja = $JenisGerejaData[0];

        //dd($fieldEducation);

        if ($jenisGereja) {
            return response()->json([
                'status'=> 200,
                'jenis_gereja' => $jenisGereja
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Status Tidak Ditemukan.'
            ]);
        }
    }

    public function delete(Request $request)
    {
        $JenisGerejaData = DB::select('CALL view_jenisGereja_byId(' . $request ->get('IdJenisGereja') . ')');
        $jenisGerejaTemp = $JenisGerejaData[0];

            if ($jenisGerejaTemp) {
                $id = $request -> get('IdJenisGereja');

                $response = DB::select('CALL delete_jenisGereja(?)', [$id]);
                
                return response()->json([
                    'status' => 200,
                    'message'=> 'Jenis Gereja Berhasil Dihapus!'
                ]);
            }else{
                return response()->json([
                    'status'=> 404,
                    'message' => 'Data Jenis Gereja Tidak Ditemukan.'
                ]);
            }
    }


}
