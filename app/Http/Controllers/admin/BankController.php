<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    protected $rules = array(
        'bank'=> 'required'
    );

    protected $messages = array(
        'bank.required' => 'Bank tidak boleh kosong.'
    );
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fieldBank = DB::select('CALL viewAll_bank()');  

        return view('admin.PengaturanDanKonfigurasi.Bank.index', compact('fieldBank'));
    }

    public function fetchBankField(){
        $fieldBanks = DB::select('CALL viewAll_bank()');
        return response()->json([
            'fieldBanks'=> $fieldBanks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.PengaturanDanKonfigurasi.Bank.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Bank = json_encode([
            'NamaBank' => $request->get('bank'),
            'Keterangan'  => $request->get('keterangan')
        ]);

        //dd($BidangPendidikan);

        $response = DB::statement('CALL insert_bank(:dataBank)', ['dataBank' => $Bank]);

        if ($response) {
            return redirect()->route('Bank.index')->with('success', 'Bank Berhasil Disimpan!');
        } else {
            return redirect()->route('Bank.create')->with('error', 'Bank Gagal Disimpan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function detail(Request $request)
    {
        $id = $request->id;

        $fieldBankData = DB::select('CALL view_bank_byId(' . $id . ')');
        $fieldBank = $fieldBankData[0];

        //dd($fieldEducation);

        if ($fieldBank) {
            return response()->json([
                'status'=> 200,
                'fieldBank' => $fieldBank
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'Data Bank Tidak Ditemukan.'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fieldBankData = DB::select('CALL view_bank_byId(' . $id . ')');
        $fieldBank = $fieldBankData[0];

        if ($fieldBank) {
           return view('admin.PengaturanDanKonfigurasi.Bank.edit', compact('fieldBank'));
        } else {
            return redirect()->route('Bank.index')->with('error', 'Bank Tidak Ditemukan!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Bank = json_encode([
            'IdBank' => $id,
            'NamaBank' => $request->get('bank'),
            'Keterangan' => $request->get('keterangan')
        ]);

        $response = DB::statement('CALL update_bank(:dataBank)', ['dataBank' => $Bank]);
    
        if ($response) {
            return redirect()->route('Bank.index')->with('success', 'Bank Berhasil Diubah!');
        } else {
            return redirect()->route('Bank.edit', $id)->with('error', 'Bank Gagal Diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $fieldBankData = DB::select('CALL view_bank_byId(' . $request -> get('idBank') . ')');
            $fieldBank = $fieldBankData[0];

            if ($fieldBank) {
                $id = $request -> get('idBank');

                $response = DB::select('CALL delete_bank(?)', [$id]);
                
                return response()->json([
                    'status' => 200,
                    'message'=> 'Data Bank Berhasil Dihapus.'
                ]);
            }else{
                return response()->json([
                    'status'=> 404,
                    'message' => 'Data Bank Tidak Ditemukan.'
                ]);
            }
    }
}
