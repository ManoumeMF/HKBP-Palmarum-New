<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    public function __construct()
    {
        /*$this->middleware('permission:view status', ['only' => ['index']]);
        $this->middleware('permission:create status', ['only' => ['create','store']]);
        $this->middleware('permission:update status', ['only' => ['update','edit']]);
        $this->middleware('permission:delete status', ['only' => ['delete']]);*/
    }
    protected $rules = array(
        'jenisStatus'=> 'required',
        'namaStatus'=> 'required'
    );

    protected $messages = array(
        'jenisStatus.required' => 'Jenis Status tidak boleh kosong.',
        'namaStatus.required' => 'Status tidak boleh kosong.'
    );

    public function index()
    {
        $status = DB::select('CALL viewAll_Status()'); 

        return view('admin.PengaturanDanKonfigurasi.Status.index', ['status' => $status]);
        
    }

    public function create()
    {
        $statusTypeCombo = DB::select('CALL cbo_JenisStatus()');  

        return view('admin.PengaturanDanKonfigurasi.Status.create', ['statusType' => $statusTypeCombo]);
    }

    public function store(Request $request)
    {

        $Status = json_encode([
            'JenisStatus' => $request->get('jenisStatus'),
            'Status' => $request->get('namaStatus'),
            'Keterangan'  => $request->get('keterangan')
        ]);
    
            $response = DB::statement('CALL insert_status(:dataStatus)', ['dataStatus' => $Status]);

            if ($response) {
                return redirect()->route('Status.index')->with('success', 'Status Berhasil Ditambahkan!');
            } else {
                return redirect()->route('Status.create')->with('error', 'Status Gagal Disimpan!');
            }
    }

    public function edit($id)
    {      
        $statusTypeCombo = DB::select('CALL cbo_JenisStatus()');

        $statusData = DB::select('CALL view_statusById(' . $id . ')');
        $status = $statusData[0];

        if ($status) {
            return view('admin.PengaturanDanKonfigurasi.Status.edit', compact('statusTypeCombo', 'status'));
         } else {
             return redirect()->route('Status.index')->with('error', 'Status Tidak Ditemukan!');
         }
    }


    public function update(Request $request, $id)
    {
        $Status = json_encode([
            'IdStatus' => $id,
            'JenisStatus' => $request -> get('jenisStatus'),
            'Status' => $request->get('namaStatus'),
            'Keterangan'  => $request->get('keterangan')
        ]);

            $statusData = DB::select('CALL view_statusById(' . $id . ')');
            $statusTemp = $statusData[0];
            
        if ($statusTemp) {
            $response = DB::statement('CALL update_status(:dataStatus)', ['dataStatus' => $Status]);

            if ($response) {
                return redirect()->route('Status.index')->with('success', 'Status Berhasil Diubah!');
            } else {
                return redirect()->route('Status.edit', $id)->with('error', 'Status Gagal Diubah!');
            }

         } else {
             return redirect()->route('Status.index')->with('error', 'Status Tidak Ditemukan!');
         }     
    }

    public function delete(Request $request)
    {
        $statusData = DB::select('CALL view_statusById(' . $request -> get('idStatus') . ')');
        $statusTemp = $statusData[0];

            if ($statusTemp) {
                $id = $request -> get('idStatus');

                $response = DB::select('CALL delete_status(?)', [$id]);
                
                return response()->json([
                    'status' => 200,
                    'message'=> 'Status Berhasil Dihapus!'
                ]);
            }else{
                return response()->json([
                    'status'=> 404,
                    'message' => 'Data Status Tidak Ditemukan.'
                ]);
            }
    }

    public function detail(Request $request)
    {      
        $id = $request->id;

        $statusData = DB::select('CALL view_statusById('  . $id . ')');
        $status = $statusData[0];

        //dd($fieldEducation);

        if ($status) {
            return response()->json([
                'status'=> 200,
                'status' => $status
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Status Tidak Ditemukan.'
            ]);
        }
    }

    public function storeStatusType(Request $request)
    {
        
            $JenisStatus = json_encode([
                'JenisStatus' => $request->get('jenisStatusModal'),
                'Keterangan'  => $request->get('jenisKeteranganModal')
            ]);

            //dd($JenisStatus);
    
            $response = DB::statement('CALL insert_jenisStatus(:dataJenisStatus)', ['dataJenisStatus' => $JenisStatus]);
        
            if ($response) {
                return response()->json([
                    'status' => 200,
                    'message'=> 'Jenis Status Berhasil Ditambahkan.'
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'message'=> 'Jenis Status Gagal Ditambahkan.'
                ]);
            }
    }

    public function getComboJenisStatus(){
        $statusTypeCombo = DB::select('CALL cbo_JenisStatus()');

        return response()->json($statusTypeCombo);
    }
}