<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankGerejaController extends Controller
{
    //
    public function index() {
        $bank = DB::select('CALL viewAll_bankGereja()');
        // dd($ressort); // Dump and die to check data
        return view('admin.PengaturanDanKonfigurasi.Bank.index', compact('bank'));
    }

    public function create() {
        // Mengambil data dari tabel gereja
        $gerejas = DB::table('gereja')->select('id_gereja', 'nama_gereja')->get();
    
        // Mengambil data dari tabel bank
        $banks = DB::table('bank')->select('id_bank', 'nama_bank')->get();
    
        // Mengirim data ke view
        return view('admin.PengaturanDanKonfigurasi.Bank.create', compact('gerejas', 'banks'));
    }
    

    public function store(Request $request) {

        $data = [
            'IdGereja' => $request->get('id_gereja'),
            'IdBank' => $request->get('id_bank'),
            'NamaPemilik' => $request->get('nama_pemilik'),
            'NomorRekening' => $request->get('nomor_rekening'),
            'Keterangan' => $request->get('keterangan'),
        ];
    
        // Encode data array to JSON
        $jsonData = json_encode($data);
    
        // Use DB::statement to call the stored procedure
        DB::statement('CALL insert_bankGereja(:dataBankGereja)', ['dataBankGereja' => $jsonData]);
    
        return redirect()->route('Bank')->with('success', 'Bank Gereja created successfully.');
    }

    public function bankDetail(Request $request)
{
    $id = $request->input('id');
    $bank = DB::select('CALL view_bankGereja_byId(?)', [$id]);

    if ($bank) {
        return response()->json([
            'status' => 200,
            'bank' => $bank[0]
        ]);
    } else {
        return response()->json([
            'status' => 404,
            'message' => 'Data not found'
        ]);
    }
}


public function edit($id)
{
    // Mengambil data bank berdasarkan ID menggunakan stored procedure
    $bankData = DB::select('CALL view_bankGereja_byId(?)', [$id]);
    $bank = $bankData[0];
    
    // Mengambil data gereja dan bank untuk dropdown
    $gerejaList = DB::table('gereja')->where('is_deleted', 0)->get();
    $bankList = DB::table('bank')->where('is_deleted', 0)->get();

    // Mengambil id_gereja dan id_bank secara terpisah
    $id_gereja = DB::table('bank_gereja')->where('id_bank_gereja', $id)->value('id_gereja');
    $id_bank = DB::table('bank_gereja')->where('id_bank_gereja', $id)->value('id_bank');

    if ($bank) {
        return view('admin.PengaturanDanKonfigurasi.Bank.edit', compact('bank', 'gerejaList', 'bankList', 'id_gereja', 'id_bank'));
    } else {
        return redirect()->route('Bank')->with('error', 'Bank Tidak Ditemukan!');
    }
}


public function update(Request $request, $id)
{
    $dataBankGereja = json_encode([
        'IdBankGereja' => $id,
        'IdGereja' => $request->get('id_gereja'),
        'IdBank' => $request->get('id_bank'),
        'NamaPemilik' => $request->get('namaPemilik'),
        'NomorRekening' => $request->get('nomorRekening'),
        'Keterangan' => $request->get('keterangan'),
    ]);

    $response = DB::statement('CALL update_bankGereja(:dataBankGereja)', ['dataBankGereja' => $dataBankGereja]);
    
    if ($response) {
        return redirect()->route('Bank')->with('success', 'Bank Berhasil Diubah!');
    } else {
        return redirect()->route('Bank.edit', $id)->with('error', 'Bank Gagal Diubah!');
    }
}


    public function deleteBank(Request $request)
    {
        $id = $request->input('idBank');

        DB::table('bank_gereja')->where('id_bank_gereja', $id)->update(['is_deleted' => 1]);

        return response()->json([
            'status' => 200,
            'message' => 'Data deleted successfully'
        ]);
    }
}
