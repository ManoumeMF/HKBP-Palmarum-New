<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JenisRppController extends Controller
{
    protected $rules = [
        'jenis_rpp' => 'required',
        'keterangan' => 'required'
    ];

    protected $messages = [
        'jenis_rpp.required' => 'Jenis Rpp field is required.',
        'keterangan.required' => 'Keterangan field is required.'
    ];

    public function index()
    {
        $jenisRpps = DB::select('CALL viewAll_jenisRpp()');
        return view('admin.PengaturanDanKonfigurasi.JenisRpp.index', compact('jenisRpps'));
    }

    public function create()
    {
        return view('admin.PengaturanDanKonfigurasi.JenisRpp.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jenisRpp = json_encode([
            'JenisRpp' => $request->jenis_rpp,
            'Keterangan' => $request->keterangan
        ]);

        DB::statement('CALL insert_jenisRpp(?)', [$jenisRpp]);

        return redirect()->route('JenisRpp.index')->with('success', 'Jenis Rpp added successfully!');
    }

    public function edit($id)
    {
        $jenisRpp = DB::select('CALL view_jenisRpp_byId(?)', [$id]);

        if (empty($jenisRpp)) {
            return redirect()->route('JenisRpp.index')->with('error', 'Jenis Rpp not found!');
        }

        $jenisRpp = $jenisRpp[0];
        return view('admin.PengaturanDanKonfigurasi.JenisRpp.edit', compact('jenisRpp'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jenisRpp = json_encode([
            'IdJenisRpp' => $id,
            'JenisRpp' => $request->jenis_rpp,
            'Keterangan' => $request->keterangan
        ]);

        DB::statement('CALL update_jenisRpp(?)', [$jenisRpp]);

        return redirect()->route('JenisRpp.index')->with('success', 'Jenis Rpp updated successfully!');
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');

        Log::info('Delete request received for ID: ' . $id);

        $jenisRpp = DB::select('CALL view_jenisRpp_byId(?)', [$id]);

        if (empty($jenisRpp)) {
            Log::warning('Jenis Rpp not found for ID: ' . $id);
            return response()->json([
                'status' => 404,
                'message' => 'Jenis Rpp not found.'
            ]);
        }

        DB::statement('CALL delete_jenisRpp(?)', [$id]);
        Log::info('Jenis Rpp deleted successfully for ID: ' . $id);

        return response()->json([
            'status' => 200,
            'message' => 'Jenis Rpp deleted successfully.'
        ]);
    }

    public function detail(Request $request)
    {
        $id = $request->id;

        $jenisRppData = DB::select('CALL view_jenisRpp_byId(' . $id . ')');
        $jenisRpp = $jenisRppData[0];

        if ($jenisRpp) {
            return response()->json([
                'status' => 200,
                'jenisRpp' => $jenisRpp
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Jenis Rpp Tidak Ditemukan.'
            ]);
        }
    }
}
