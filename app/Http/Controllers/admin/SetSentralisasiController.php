<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SetSentralisasiController extends Controller
{
    protected $rules = array(
        'PersentasiSentralisasi'=> 'required'
    );

    protected $messages = array(
        'PersentasiSentralisasi.required' => 'Persentasi Sentralisasi tidak boleh kosong.'
    );

    public function index(){
        $sentralisasi = DB::select('CALL viewAll_setSentralisasi()'); 
        // viewAll_jenisGereja
        return view('admin.PengaturanDanKonfigurasi.SetSentralisasi.index', ['sentralisasi' => $sentralisasi]);
        
    }

    public function create(){
        return view('admin.PengaturanDanKonfigurasi.SetSentralisasi.create');

    }

    public function store(Request $request){

        $sentralisasi = json_encode([
            'PersentasiSentralisasi' => $request->get('PersentasiSentralisasi'),
            'Keterangan' => $request->get('Keterangan'),
        ]);

        $response = DB::statement('CALL insert_setSentralisasi(:dataSentralisasi)', ['dataSentralisasi' => $sentralisasi]);

        if ($response) {
            return redirect()->route('Sentralisasi.index')->with('success', 'Data Sentralisasi Berhasil Ditambahkan!');
        } else {
            return redirect()->route('Sentralisasi.create')->with('error', 'Data Sentralisasi Gagal Disimpan!');
        }

    }

    public function edit($id)
{
    $sentralisasiData = DB::select('CALL view_setSentralisasi_byId(?)', [$id]);
    
    if (!empty($sentralisasiData)) {
        $sentralisasi = $sentralisasiData[0]; // Access the first (and only) element
        return view('admin.PengaturanDanKonfigurasi.SetSentralisasi.edit', ['sentralisasi' => $sentralisasi]);
    } else {
        return redirect()->route('Sentralisasi.index')->with('error', 'Data Sentralisasi Tidak Ditemukan!');
    }
}

public function update(Request $request, $id)
{
    $SetSentralisasi = json_encode([
        'IdSentralisasi' => $id,
        'PersentasiSentralisasi' => $request->get('PersentasiSentralisasi'),
        'Keterangan'  => $request->get('Keterangan')
    ]);

    $SetSentralisasiData = DB::select('CALL view_setSentralisasi_byId(?)', [$id]);
    $StatusSetSentralisasi = $SetSentralisasiData[0];

    if ($StatusSetSentralisasi) {
        $response = DB::statement('CALL update_setSentralisasi(:dataSentralisasi)', ['dataSentralisasi' => $SetSentralisasi]);

        if ($response) {
            return redirect()->route('Sentralisasi.index')->with('success', 'Data Sentralisasi Berhasil Diubah!');
        } else {
            return redirect()->route('Sentralisasi.edit', $id)->with('error', 'Data Sentralisasi Gagal Diubah!');
        }
    } else {
        return redirect()->route('Sentralisasi.index')->with('error', 'Data Sentralisasi Tidak Ditemukan!');
    }
}


public function detail(Request $request)
    {      
        $id = $request->id;

        $SetSentralisasiData = DB::select('CALL view_setSentralisasi_byId('  . $id . ')');
        $sentralisasi = $SetSentralisasiData[0];

        //dd($fieldEducation);

        if ($sentralisasi) {
            return response()->json([
                'status'=> 200,
                'sentralisasi' => $sentralisasi
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Sentralisasi Tidak Ditemukan.'
            ]);
        }
    }

    public function delete(Request $request)
    {
        $SetSentralisasiData = DB::select('CALL view_setSentralisasi_byId(' . $request ->get('IdSentralisasi') . ')');
        $setSentralisasiTemp = $SetSentralisasiData[0];

            if ($setSentralisasiTemp) {
                $id = $request -> get('IdSentralisasi');

                $response = DB::select('CALL delete_setSentralisasi(?)', [$id]);
                
                return response()->json([
                    'status' => 200,
                    'message'=> 'Data Sentralisasi Berhasil Dihapus!'
                ]);
            }else{
                return response()->json([
                    'status'=> 404,
                    'message' => 'Data Sentralisasi Tidak Ditemukan.'
                ]);
            }
    }


}
