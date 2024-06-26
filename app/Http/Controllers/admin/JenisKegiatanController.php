<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JenisKegiatanController extends Controller
{
    protected $rules = [
        'nama_jenis_kegiatan' => 'required',
        'keterangan' => 'required'
    ];

    protected $messages = [
        'nama_jenis_kegiatan.required' => 'Nama Jenis Kegiatan field is required.',
        'keterangan.required' => 'Keterangan field is required.'
    ];

    public function index()
    {
        $jenisKegiatans = DB::select('CALL viewAll_jenisKegiatan()');
        return view('admin.PengaturanDanKonfigurasi.JenisKegiatan.index', compact('jenisKegiatans'));
    }

    public function create()
    {
        return view('admin.PengaturanDanKonfigurasi.JenisKegiatan.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jenisKegiatan = json_encode([
            'NamaJenisKegiatan' => $request->nama_jenis_kegiatan,
            'Keterangan' => $request->keterangan
        ]);

        DB::statement('CALL insert_jenisKegiatan(?)', [$jenisKegiatan]);

        return redirect()->route('JenisKegiatan.index')->with('success', 'Jenis Kegiatan added successfully!');
    }

    public function edit($id)
    {
        $jenisKegiatan = DB::select('CALL view_jenisKegiatan_byId(?)', [$id]);

        if (empty($jenisKegiatan)) {
            return redirect()->route('JenisKegiatan.index')->with('error', 'Jenis Kegiatan not found!');
        }

        $jenisKegiatan = $jenisKegiatan[0];
        return view('admin.PengaturanDanKonfigurasi.JenisKegiatan.edit', compact('jenisKegiatan'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jenisKegiatan = json_encode([
            'IdJenisKegiatan' => $id,
            'NamaJenisKegiatan' => $request->nama_jenis_kegiatan,
            'Keterangan' => $request->keterangan
        ]);

        DB::statement('CALL update_jenisKegiatan(?)', [$jenisKegiatan]);

        return redirect()->route('JenisKegiatan.index')->with('success', 'Jenis Kegiatan updated successfully!');
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');

        Log::info('Delete request received for ID: ' . $id);

        $jenisKegiatan = DB::select('CALL view_jenisKegiatan_byId(?)', [$id]);

        if (empty($jenisKegiatan)) {
            Log::warning('Jenis Kegiatan not found for ID: ' . $id);
            return response()->json([
                'status' => 404,
                'message' => 'Jenis Kegiatan not found.'
            ]);
        }

        DB::statement('CALL delete_jenisKegiatan(?)', [$id]);
        Log::info('Jenis Kegiatan deleted successfully for ID: ' . $id);

        return response()->json([
            'status' => 200,
            'message' => 'Jenis Kegiatan deleted successfully.'
        ]);
    }



    public function detail(Request $request)
    {
        $id = $request->id;

        $jenisKegiatanData = DB::select('CALL view_jenisKegiatan_byId(' . $id . ')');
        $jenisKegiatan = $jenisKegiatanData[0];

        if ($jenisKegiatan) {
            return response()->json([
                'status' => 200,
                'jenisKegiatan' => $jenisKegiatan
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Jenis Kegiatan Tidak Ditemukan.'
            ]);
        }
    }
}
