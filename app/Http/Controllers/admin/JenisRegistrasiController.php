<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JenisRegistrasiController extends Controller
{
    protected $rules = [
        'nama_jenis_registrasi' => 'required',
        'sub_jenis_registrasi' => 'required',
    ];

    protected $messages = [
        'nama_jenis_registrasi.required' => 'Nama Jenis Registrasi field is required.',
        'sub_jenis_registrasi.required' => 'Sub Jenis Registrasi field is required.',
    ];

    public function index()
    {
        $jenisRegistrasis = DB::select('CALL viewAll_jenisRegistrasi()');
        return view('admin.PengaturanDanKonfigurasi.JenisRegistrasi.index', compact('jenisRegistrasis'));
    }

    public function create()
    {
        return view('admin.PengaturanDanKonfigurasi.JenisRegistrasi.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jenisRegistrasi = json_encode([
            'NamaJenisRegistrasi' => $request->nama_jenis_registrasi,
            'SubJenisRegistrasi' => $request->sub_jenis_registrasi,
            'Keterangan' => $request->keterangan
        ]);

        DB::statement('CALL insert_jenisRegistrasi(?)', [$jenisRegistrasi]);

        return redirect()->route('JenisRegistrasi.index')->with('success', 'Jenis Registrasi added successfully!');
    }

    public function edit($id)
    {
        $jenisRegistrasi = DB::select('CALL view_jenisRegistrasi_byId(?)', [$id]);

        if (empty($jenisRegistrasi)) {
            return redirect()->route('JenisRegistrasi.index')->with('error', 'Jenis Registrasi not found!');
        }

        $jenisRegistrasi = $jenisRegistrasi[0];
        return view('admin.PengaturanDanKonfigurasi.JenisRegistrasi.edit', compact('jenisRegistrasi'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jenisRegistrasi = json_encode([
            'IdJenisRegistrasi' => $id,
            'NamaJenisRegistrasi' => $request->nama_jenis_registrasi,
            'SubJenisRegistrasi' => $request->sub_jenis_registrasi,
            'Keterangan' => $request->keterangan
        ]);

        DB::statement('CALL update_jenisRegistrasi(?)', [$jenisRegistrasi]);

        return redirect()->route('JenisRegistrasi.index')->with('success', 'Jenis Registrasi updated successfully!');
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');

        Log::info('Delete request received for ID: ' . $id);

        $jenisRegistrasi = DB::select('CALL view_jenisRegistrasi_byId(?)', [$id]);

        if (empty($jenisRegistrasi)) {
            Log::warning('Jenis Registrasi not found for ID: ' . $id);
            return response()->json([
                'status' => 404,
                'message' => 'Jenis Registrasi not found.'
            ]);
        }

        DB::statement('CALL delete_jenisRegistrasi(?)', [$id]);
        Log::info('Jenis Registrasi deleted successfully for ID: ' . $id);

        return response()->json([
            'status' => 200,
            'message' => 'Jenis Registrasi deleted successfully.'
        ]);
    }

    public function detail(Request $request)
    {
        $id = $request->id;

        $jenisRegistrasiData = DB::select('CALL view_jenisRegistrasi_byId(' . $id . ')');
        $jenisRegistrasi = $jenisRegistrasiData[0];

        if ($jenisRegistrasi) {
            return response()->json([
                'status' => 200,
                'jenisRegistrasi' => $jenisRegistrasi
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Jenis Registrasi Tidak Ditemukan.'
            ]);
        }
    }
}
