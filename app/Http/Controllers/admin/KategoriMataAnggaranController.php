<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriMataAnggaranController extends Controller
{
    protected $rules = array(
        'kode_kategori_anggaran' => 'required',
        'nama_kategori_Anggaran' => 'required'

    );

    protected $messages = array(
        'kode_kategori_anggaran.required' => 'Jenis Gereja tidak boleh kosong.',
        'nama_kategori_Anggaran.required' => 'Jenis Gereja tidak boleh kosong.'
    );

    public function create()
    {

        return view('admin.PengaturanDanKonfigurasi.KategoriMataAnggaran.create');
    }

    public function index()
    {
        $kategoriMataAnggaran = DB::table('kategori_mata_anggaran')->get()->where('is_deleted', 0);
        // viewAll_jenisGereja
        return view('admin.PengaturanDanKonfigurasi.KategoriMataAnggaran.index', ['kategoriMataAnggaran' => $kategoriMataAnggaran]);
    }

    public function store(Request $request)
    {

        $jenisGereja = json_encode([
            'IndukKategoriAnggaran' => $request->get('IndukKategoriAnggaran'),
            'KodeKategoriAnggaran' => $request->get('KodeKategoriAnggaran'),
            'NamaKategoriAnggaran' => $request->get('NamaKategoriAnggaran'),
            'Keterangan' => $request->get('Keterangan'),
        ]);

        $response = DB::table('kategori_mata_anggaran')->insert([
            'induk_kategori_anggaran' => $request->get('IndukKategoriAnggaran'),
            'kode_kategori_anggaran' => $request->get('KodeKategoriAnggaran'),
            'nama_kategori_Anggaran' => $request->get('NamaKategoriAnggaran'),
            'keterangan' => $request->get('Keterangan')
        ]);

        if ($response) {
            return redirect()->route('KategoriMataAnggaran.index')->with('success', 'Kategori Mata Anggaran Berhasil Ditambahkan!');
        } else {
            return redirect()->route('KategoriMataAnggaran.create')->with('error', 'Kategori Mata Anggaran Gagal Disimpan!');
        }
    }

    public function edit($id)
    {
        $kategoriMataAnggaranData = DB::table('kategori_mata_anggaran')
            ->get()
            ->where('id_kategori_anggaran', $id)
            ->first();

        if (!empty($kategoriMataAnggaranData)) {
            // $kategoriMataAnggaran = $kategoriMataAnggaranData[0]; // Access the first (and only) element
            return view('admin.PengaturanDanKonfigurasi.KategoriMataAnggaran.edit', ['kategoriMataAnggaran' => $kategoriMataAnggaranData]);
        } else {
            return redirect()->route('KategoriMataAnggaran.index')->with('error', 'Kategori Mata Anggaran Tidak Ditemukan!');
        }
    }

    public function update(Request $request, $id)
    {
        $JenisGereja = json_encode([
            'IdKategoriMataAnggaran' => $id,
            'IndukKategoriAnggaran' => $request->get('IndukKategoriAnggaran'),
            'KodeKategoriAnggaran' => $request->get('KodeKategoriAnggaran'),
            'NamaKategoriAnggaran' => $request->get('NamaKategoriAnggaran'),
            'Keterangan'  => $request->get('Keterangan')
        ]);

        // $JenisGerejaData = DB::select('CALL view_jenisGereja_byId(?)', [$id]);
        // $StatusJenisGereja = $JenisGerejaData[0];

        $kategoriMataAnggaranData = DB::table('kategori_mata_anggaran')
            ->get()
            ->where('id_kategori_anggaran', $id)
            ->first();

        if ($kategoriMataAnggaranData) {
            // $response = DB::statement('CALL update_jenisGereja(:dataJenisGereja)', ['dataJenisGereja' => $JenisGereja]);
            $response = DB::table('kategori_mata_anggaran')
                ->where('id_kategori_anggaran', $id)
                ->update([
                    'induk_kategori_anggaran' => $request->get('IndukKategoriAnggaran'),
                    'kode_kategori_anggaran' => $request->get('KodeKategoriAnggaran'),
                    'nama_kategori_Anggaran' => $request->get('NamaKategoriAnggaran'),
                    'keterangan' => $request->get('Keterangan'),
                ]);

            if ($response) {
                return redirect()->route('KategoriMataAnggaran.index')->with('success', 'Kategori Mata Anggaran Berhasil Diubah!');
            } else {
                return redirect()->route('KategoriMataAnggaran.edit', $id)->with('error', 'Kategori Mata Anggaran Gagal Diubah!');
            }
        } else {
            return redirect()->route('KategoriMataAnggaran.index')->with('error', 'Kategori Mata Anggaran Tidak Ditemukan!');
        }
    }


    public function detail(Request $request)
    {
        $id = $request->id;

        // $JenisGerejaData = DB::select('CALL view_jenisGereja_byId('  . $id . ')');
        // $jenisGereja = $JenisGerejaData[0];

        $kategoriMataAnggaranData = DB::table('kategori_mata_anggaran')
            ->get()
            ->where('id_kategori_anggaran', $id)
            ->first();


        if ($kategoriMataAnggaranData) {
            return response()->json([
                'status' => 200,
                'kategori_mata_anggaran' => $kategoriMataAnggaranData
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Kategori Mata Anggaran Tidak Ditemukan.'
            ]);
        }
    }

    public function delete(Request $request)
    {
        // $JenisGerejaData = DB::select('CALL view_jenisGereja_byId(' . $request ->get('IdJenisGereja') . ')');
        // $jenisGerejaTemp = $JenisGerejaData[0];

        $kategoriMataAnggaranData = DB::table('kategori_mata_anggaran')
        ->get()
        ->where('id_kategori_anggaran', $request -> get('IdKategoriMataAnggaran'))
        ->first();

            if ($kategoriMataAnggaranData) {
                $id = $request -> get('IdKategoriMataAnggaran');

                // $response = DB::select('CALL delete_jenisGereja(?)', [$id]);
                
                $response = DB::table('kategori_mata_anggaran')
            ->where('id_kategori_anggaran', $id)
            ->update(['is_deleted' => 1]);

                return response()->json([
                    'status' => 200,
                    'message'=> 'Kategori Mata Anggaran Berhasil Dihapus!'
                ]);
            }else{
                return response()->json([
                    'status'=> 404,
                    'message' => 'Data Kategori Mata Anggaran Tidak Ditemukan.'
                ]);
            }
    }

}
