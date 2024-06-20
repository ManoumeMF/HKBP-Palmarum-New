<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Facades\Validator;

class GolonganDarahController extends Controller
{
    protected $rules = array(
        'GolonganDarah'=> 'required'
    );

    protected $messages = array(
        'GolonganDarah.required' => 'Golongan Darah tidak boleh kosong.'
    );
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fieldGolonganDarah = DB::select('CALL viewAll_golonganDarah()');  

        return view('admin.PengaturanDanKonfigurasi.GolonganDarah.index', compact('fieldGolonganDarah'));
    }

    public function fetchGolonganDarahField(){
        $fieldGolonganDarahs = DB::select('CALL viewAll_golonganDarah()');
        return response()->json([
            'fieldGolonganDarahs'=> $fieldGolonganDarahs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.PengaturanDanKonfigurasi.GolonganDarah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $GolonganDarah = json_encode([
            'golongan_darah' => $request->get('golongan_darah'),
            'keterangan'  => $request->get('keterangan')
        ]);

        //dd($BidangGolonganDarah);

        $response = DB::statement('CALL insert_GolonganDarah(:dataGolonganDarah)', ['dataGolonganDarah' => $GolonganDarah]);

        if ($response) {
            return redirect()->route('GolonganDarah.index')->with('success', 'Golongan Darah Berhasil Disimpan!');
        } else {
            return redirect()->route('GolonganDarah.create')->with('error', 'Golongan Darah Gagal Disimpan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = $request->id;

        $fieldGolonganDarahData = DB::select('CALL view_golonganDarah_byId(' . $id . ')');
        $fieldGolonganDarah = $fieldGolonganDarahData[0];

        //dd($fieldEducation);

        if ($fieldGolonganDarah) {
            return response()->json([
                'status'=> 200,
                'fieldGolonganDarah' => $fieldGolonganDarah
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Golongan Darah Tidak Ditemukan.'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fieldGolonganDarahData = DB::select('CALL view_golonganDarah_byId(' . $id . ')');
        $fieldGolonganDarah = $fieldGolonganDarahData[0];

        if ($fieldGolonganDarah) {
           return view('admin.PengaturanDanKonfigurasi.GolonganDarah.edit', compact('fieldGolonganDarah'));
        } else {
            return redirect()->route('GolonganDarah.index')->with('error', 'Golongan Darah Tidak Ditemukan!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $GolonganDarah = json_encode([
            'id_gol_darah' => $id,
            'golongan_darah' => $request->get('golongan_darah'),
            'keterangan' => $request->get('keterangan')
        ]);

        $response = DB::statement('CALL update_golonganDarah(:dataGolonganDarah)', ['dataGolonganDarah' => $GolonganDarah]);
    
        if ($response) {
            return redirect()->route('GolonganDarah.index')->with('success', 'Golongan Darah Berhasil Diubah!');
        } else {
            return redirect()->route('GolonganDarah.edit', $id)->with('error', 'Golongan Darah Gagal Diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fieldGolonganDarahData = DB::select('CALL view_golonganDarah_byId(' . $request -> get('id_gol_darah') . ')');
        $fieldGolonganDarah = $fieldGolonganDarahData[0];

        if ($fieldGolonganDarah) {
            $id = $request -> get('id_gol_darah');

            $response = DB::select('CALL delete_golonganDarah(?)', [$id]);
            
            return response()->json([
                'status' => 200,
                'message'=> 'Data Golongan Darah Berhasil Dihapus.'
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Golongan Darah Tidak Ditemukan.'
            ]);
        }
    }
}
