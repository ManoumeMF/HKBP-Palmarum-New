<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendidikanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view pendidikan', ['only' => ['index']]);
        $this->middleware('permission:create pendidikan', ['only' => ['create','store']]);
        $this->middleware('permission:update pendidikan', ['only' => ['update','edit']]);
        $this->middleware('permission:delete pendidikan', ['only' => ['delete']]);
    }
    protected $rules = array(
        'pendidikan'=> 'required'
    );

    protected $messages = array(
        'pendidikan.required' => 'Pendidikan tidak boleh kosong.'
    );
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fieldPendidikan = DB::select('CALL viewAll_Pendidikan()');  

        return view('admin.PengaturanDanKonfigurasi.Pendidikan.index', compact('fieldPendidikan'));
    }

    public function fetchPendidikanField(){
        $fieldPendidikans = DB::select('CALL viewAll_Pendidikan()');
        return response()->json([
            'fieldPendidikans'=> $fieldPendidikans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.PengaturanDanKonfigurasi.Pendidikan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Pendidikan = json_encode([
            'Pendidikan' => $request->get('pendidikan'),
            'Keterangan'  => $request->get('keterangan')
        ]);

        //dd($BidangPendidikan);

        $response = DB::statement('CALL insert_Pendidikan(:dataPendidikan)', ['dataPendidikan' => $Pendidikan]);

        if ($response) {
            return redirect()->route('Pendidikan.index')->with('success', 'Pendidikan Berhasil Disimpan!');
        } else {
            return redirect()->route('Pendidikan.create')->with('error', 'Pendidikan Gagal Disimpan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function detail(Request $request)
    {
        $id = $request->id;

        $fieldPendidikanData = DB::select('CALL view_pendidikan_byId(' . $id . ')');
        $fieldPendidikan = $fieldPendidikanData[0];

        // dd($fieldEducation);

        if ($fieldPendidikan) {
            return response()->json([
                'status'=> 200,
                'fieldPendidikan' => $fieldPendidikan
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Pendidikan Tidak Ditemukan.'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fieldPendidikanData = DB::select('CALL view_pendidikan_byId(' . $id . ')');
        $fieldPendidikan = $fieldPendidikanData[0];

        if ($fieldPendidikan) {
           return view('admin.PengaturanDanKonfigurasi.Pendidikan.edit', compact('fieldPendidikan'));
        } else {
            return redirect()->route('Pendidikan.index')->with('error', 'Pendidikan Tidak Ditemukan!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $Pendidikan = json_encode([
            'IdPendidikan' => $id,
            'Pendidikan' => $request->get('pendidikan'),
            'Keterangan' => $request->get('keterangan')
        ]);

        $response = DB::statement('CALL update_pendidikan(:dataPendidikan)', ['dataPendidikan' => $Pendidikan]);
    
        if ($response) {
            return redirect()->route('Pendidikan.index')->with('success', 'Pendidikan Berhasil Diubah!');
        } else {
            return redirect()->route('Pendidikan.edit', $id)->with('error', 'Pendidikan Gagal Diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $fieldPendidikanData = DB::select('CALL view_Pendidikan_byId(' . $request -> get('idPendidikan') . ')');
        $fieldPendidikan = $fieldPendidikanData[0];

        if ($fieldPendidikan) {
            $id = $request -> get('idPendidikan');

            $response = DB::select('CALL delete_pendidikan(?)', [$id]);
            
            return response()->json([
                'status' => 200,
                'message'=> 'Data Pendidikan Berhasil Dihapus.'
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Pendidikan Tidak Ditemukan.'
            ]);
        }
    }
}
