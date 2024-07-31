<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JenisMingguController extends Controller
{
    protected $rules = [
        'nama_jenis_minggu' => 'required',
    ];

    protected $messages = [
        'nama_jenis_minggu.required' => 'Nama Jenis Minggu field is required.',
    ];

    public function index()
    {
        $jenisMinggus = DB::select('CALL viewAll_jenisMinggu()');
        return view('admin.PengaturanDanKonfigurasi.JenisMinggu.index', compact('jenisMinggus'));
    }

    public function create()
    {
        return view('admin.PengaturanDanKonfigurasi.JenisMinggu.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jenisMinggu = json_encode([
            'NamaJenisMinggu' => $request->nama_jenis_minggu,
            'Keterangan' => $request->keterangan
        ]);

        DB::statement('CALL insert_jenisMinggu(?)', [$jenisMinggu]);

        return redirect()->route('JenisMinggu.index')->with('success', 'Jenis Minggu added successfully!');
    }

    public function edit($id)
    {
        $jenisMinggu = DB::select('CALL view_jenisMinggu_byId(?)', [$id]);

        if (empty($jenisMinggu)) {
            return redirect()->route('JenisMinggu.index')->with('error', 'Jenis Minggu not found!');
        }

        $jenisMinggu = $jenisMinggu[0];
        return view('admin.PengaturanDanKonfigurasi.JenisMinggu.edit', compact('jenisMinggu'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jenisMinggu = json_encode([
            'IdJenisMinggu' => $id,
            'NamaJenisMinggu' => $request->nama_jenis_minggu,
            'Keterangan' => $request->keterangan
        ]);

        DB::statement('CALL update_jenisMinggu(?)', [$jenisMinggu]);

        return redirect()->route('JenisMinggu.index')->with('success', 'Jenis Minggu updated successfully!');
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');

        Log::info('Delete request received for ID: ' . $id);

        $jenisMinggu = DB::select('CALL view_jenisMinggu_byId(?)', [$id]);

        if (empty($jenisMinggu)) {
            Log::warning('Jenis Minggu not found for ID: ' . $id);
            return response()->json([
                'status' => 404,
                'message' => 'Jenis Minggu not found.'
            ]);
        }

        DB::statement('CALL delete_jenisMinggu(?)', [$id]);
        Log::info('Jenis Minggu deleted successfully for ID: ' . $id);

        return response()->json([
            'status' => 200,
            'message' => 'Jenis Minggu deleted successfully.'
        ]);
    }

    public function detail(Request $request)
    {
        $id = $request->id;

        $jenisMingguData = DB::select('CALL view_jenisMinggu_byId(' . $id . ')');
        $jenisMinggu = $jenisMingguData[0];

        if ($jenisMinggu) {
            return response()->json([
                'status' => 200,
                'jenisMinggu' => $jenisMinggu
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Jenis Minggu Tidak Ditemukan.'
            ]);
        }
    }
}
