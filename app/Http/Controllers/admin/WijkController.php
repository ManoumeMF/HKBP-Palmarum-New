<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Facades\Validator;

class WijkController extends Controller
{
    
    public function index()
    {
        $Wijk = DB::select('CALL viewAll_wijk()');  

        return view('admin.Master.Wijk.index', compact('Wijk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Master.Wijk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userSession = json_decode($request->session()->get('userSession'), true);
        $idGereja = $userSession[0]['id_gereja'];
        //dd($idGereja);

        $Wijk = json_encode([
            'IdGereja' => $idGereja,
            'NamaWijk' => $request->get('wijk'),
            'Keterangan'  => $request->get('keterangan')
        ]);

        //dd($Wijk);

        $response = DB::statement('CALL insert_wijk(:dataWijk)', ['dataWijk' => $Wijk]);

        if ($response) {
            return redirect()->route('Wijk.index')->with('success', 'Wijk Berhasil Disimpan!');
        } else {
            return redirect()->route('Wijk.create')->with('error', 'Bank Gagal Disimpan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function detail(Request $request)
    {
        $id = $request->id;

        $wijkData = DB::select('CALL view_wijk_byId(' . $id . ')');
        $wijk = $wijkData[0];

        //dd($fieldEducation);

        if ($wijk) {
            return response()->json([
                'status'=> 200,
                'wijk' => $wijk
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Wijk Tidak Ditemukan.'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $wijkData = DB::select('CALL view_wijk_byId(' . $id . ')');
        $wijk= $wijkData[0];

        //dd($fieldBank);

        if ($wijkData) {
           return view('admin.Master.Wijk.edit', compact('wijk'));
        } else {
            return redirect()->route('Wijk.index')->with('error', 'Wijk Tidak Ditemukan!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Wijk = json_encode([
            'IdWijk' => $id,
            'NamaWijk' => $request->get('namaWijk'),
            'Keterangan' => $request->get('keterangan')
        ]);

        $response = DB::statement('CALL update_wijk(:dataWijk)', ['dataWijk' => $Wijk]);
    
        if ($response) {
            return redirect()->route('Wijk.index')->with('success', 'Data Wijk Berhasil Diubah!');
        } else {
            return redirect()->route('Wijk.edit', $id)->with('error', 'Data Wijk Gagal Diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $wijkData = DB::select('CALL view_wijk_byId(' . $request -> get('idWijk') . ')');
        $wijk = $wijkData[0];

            if ($wijk) {
                $id = $request -> get('idWijk');

                $response = DB::select('CALL delete_wijk(?)', [$id]);
                
                return response()->json([
                    'status' => 200,
                    'message'=> 'Data Wijk Berhasil Dihapus.'
                ]);
            }else{
                return response()->json([
                    'status'=> 404,
                    'message' => 'Data Wijk Tidak Ditemukan.'
                ]);
            }
    }
}
