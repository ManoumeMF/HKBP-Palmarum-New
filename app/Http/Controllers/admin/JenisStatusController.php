<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class JenisStatusController extends Controller
{
    protected $rules = array(
        'jenisStatus' => 'required'
    );

    protected $messages = array(
        'jenisStatus.required' => 'Jenis Status tidak boleh kosong.'
    );

    public function index()
    {
        $statusType = DB::select('CALL viewAll_JenisStatus()');  

        return view('admin.PengaturanDanKonfigurasi.JenisStatus.index', compact('statusType'));
        
    }

    public function create()
    {
        return view('admin.PengaturanDanKonfigurasi.JenisStatus.create');
    }

    public function store(Request $request)
    {
        
            $JenisStatus = json_encode([
                'JenisStatus' => $request->get('jenisStatus'),
                'Keterangan'  => $request->get('keterangan')
            ]);
    
            $response = DB::select('CALL insert_jenisStatus(:dataJenisStatus)', ['dataJenisStatus' => $JenisStatus]);
        
            if ($response) {
                return redirect()->route('JenisStatus.index')->with('success', 'Jenis Status Berhasil Ditambahkan!');
            } else {
                return redirect()->route('JenisStatus.create')->with('error', 'Jenis Status Gagal Disimpan!');
            }
    }

    public function edit(Request $request)
    {      
        $id = $request->id;

        $statusTypeData = DB::select('CALL view_jenisStatusById(' . $id . ')');
        $statusType = $statusTypeData[0];

        //dd($fieldEducation);

        if ($statusType) {
            return response()->json([
                'status'=> 200,
                'statusType' => $statusType
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Jenis Status Tidak Ditemukan.'
            ]);
        }
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) { 
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages()
            ]);
        }else{
            $statusTypeData = DB::select('CALL view_jenisStatusById(' . $request -> get('idJenisStatus') . ')');
            $statusType = $statusTypeData[0];

            if ($statusType) {
                $JenisStatus = json_encode([
                    'IdJenisStatus' => $request -> get('idJenisStatus'),
                    'JenisStatus' => $request->get('jenisStatus'),
                    'Keterangan'  => $request->get('keterangan')
                ]);

                $response = DB::select('CALL update_jenisStatus(:dataJenisStatus)', ['dataJenisStatus' => $JenisStatus]);
                
                return response()->json([
                    'status' => 200,
                    'message'=> 'Jenis Status Berhasil Diubah.'
                ]);
            }else{
                return response()->json([
                    'status'=> 404,
                    'message' => 'Data Jenis Status Tidak Ditemukan.'
                ]);
            }
        }       
    }

    public function delete(Request $request)
    {
        $statusTypeData = DB::select('CALL view_jenisStatusById(' . $request -> get('idJenisStatus') . ')');
        $statusType = $statusTypeData[0];

            if ($statusType) {
                $id = $request -> get('idJenisStatus');

                $response = DB::select('CALL delete_jenisStatus(?)', [$id]);
                
                return response()->json([
                    'status' => 200,
                    'message'=> 'Jenis Status Berhasil Dihapus.'
                ]);
            }else{
                return response()->json([
                    'status'=> 404,
                    'message' => 'Data Jenis Status Tidak Ditemukan.'
                ]);
            }
    }

    public function detail(Request $request)
    {      
        $id = $request->id;

        $statusTypeData = DB::select('CALL view_jenisStatusById(' . $id . ')');
        $statusType = $statusTypeData[0];

        //dd($fieldEducation);

        if ($statusType) {
            return response()->json([
                'status'=> 200,
                'statusType' => $statusType
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Jenis Status Tidak Ditemukan.'
            ]);
        }
    }
}
