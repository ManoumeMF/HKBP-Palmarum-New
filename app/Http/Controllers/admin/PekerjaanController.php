<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Facades\Validator;

class PekerjaanController extends Controller
{
    protected $rules = array(
        'Pekerjaan'=> 'required'
    );

    protected $messages = array(
        'Pekerjaan.required' => 'Pekerjaan tidak boleh kosong.'
    );
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fieldPekerjaan = DB::select('CALL viewAll_pekerjaan()');  

        return view('admin.PengaturanDanKonfigurasi.Pekerjaan.index', compact('fieldPekerjaan'));
    }

    public function fetchPekerjaanField(){
        $fieldPekerjaans = DB::select('CALL viewAll_pekerjaan()');
        return response()->json([
            'fieldPekerjaans'=> $fieldPekerjaans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.PengaturanDanKonfigurasi.Pekerjaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Pekerjaan = json_encode([
            'Pekerjaan' => $request->get('pekerjaan'),
            'Keterangan'  => $request->get('keterangan')
        ]);

        //dd($BidangPekerjaan);

        $response = DB::statement('CALL insert_pekerjaan(:dataPekerjaan)', ['dataPekerjaan' => $Pekerjaan]);

        if ($response) {
            return redirect()->route('Pekerjaan.index')->with('success', 'Pekerjaan Berhasil Disimpan!');
        } else {
            return redirect()->route('Pekerjaan.create')->with('error', 'Pekerjaan Gagal Disimpan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function detail(Request $request)
    {
        $id = $request->id;

        $fieldPekerjaanData = DB::select('CALL view_pekerjaan_byId(' . $id . ')');
        $fieldPekerjaan = $fieldPekerjaanData[0];

        //dd($fieldEducation);

        if ($fieldPekerjaan) {
            return response()->json([
                'status'=> 200,
                'fieldPekerjaan' => $fieldPekerjaan
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Pekerjaan Tidak Ditemukan.'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fieldPekerjaanData = DB::select('CALL view_pekerjaan_byId(' . $id . ')');
        $fieldPekerjaan = $fieldPekerjaanData[0];

        if ($fieldPekerjaan) {
           return view('admin.PengaturanDanKonfigurasi.Pekerjaan.edit', compact('fieldPekerjaan'));
        } else {
            return redirect()->route('Pekerjaan.index')->with('error', 'Pekerjaan Tidak Ditemukan!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Pekerjaan = json_encode([
            'IdPekerjaan' => $id,
            'Pekerjaan' => $request->get('pekerjaan'),
            'Keterangan' => $request->get('keterangan')
        ]);

        $response = DB::statement('CALL update_pekerjaan(:dataPekerjaan)', ['dataPekerjaan' => $Pekerjaan]);
    
        if ($response) {
            return redirect()->route('Pekerjaan.index')->with('success', 'Pekerjaan Berhasil Diubah!');
        } else {
            return redirect()->route('Pekerjaan.edit', $id)->with('error', 'Pekerjaan Gagal Diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $fieldPekerjaanData = DB::select('CALL view_pekerjaan_byId(' . $request -> get('idPekerjaan') . ')');
        $fieldPekerjaan = $fieldPekerjaanData[0];

        if ($fieldPekerjaan) {
            $id = $request -> get('idPekerjaan');

            $response = DB::select('CALL delete_pekerjaan(?)', [$id]);
            
            return response()->json([
                'status' => 200,
                'message'=> 'Data Pekerjaan Berhasil Dihapus.'
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Pekerjaan Tidak Ditemukan.'
            ]);
        }
    }
}
