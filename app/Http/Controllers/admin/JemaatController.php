<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class JemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.PengaturanDanKonfigurasi.Jemaat.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $wijk = DB::select('CALL cbo_wijk()');
        $provinces = DB::select('CALL cbo_provinces()');
        $pendidikan = DB::select('CALL cbo_pendidikan()');
        $bidangPendidikan = DB::select('CALL cbo_bidangPendidikan()');
        $pekerjaan = DB::select('CALL cbo_pekerjaan()');
        $golonganDarah = DB::select('CALL cbo_golonganDarah()');
        $gereja = DB::select('CALL cbo_gerejaAll()');
        $dokumen = DB::select('CALL cbo_jenisDokumen()');
        $hubunganKeluarga = DB::select('CALL cbo_hubunganKeluarga()');


        return view('admin.Master.Jemaat.create', compact('wijk', 'provinces', 'pendidikan', 'bidangPendidikan', 'pekerjaan', 'golonganDarah', 'gereja', 'dokumen', 'hubunganKeluarga'));
    }

    public function createDataRegistrasi(){
        $wijk = DB::select('CALL cbo_wijk()');
        $provinces = DB::select('CALL cbo_provinces()');

        return view('admin.Master.Jemaat.createDataRegistrasi', compact('wijk', 'provinces'));
    }

    public function storeDataRegistrasi(Request $request)
    {
        // Data yang akan dikirim ke stored procedure
        $dataRegistrasi= json_encode([
            'NoRegistrasi' => $request->get('noRegistrasi'),
            'TanggalRegistrasi' => date("m/d/Y", strtotime($request->get('tanggalRegistrasi'))),
            'NamaKeluarga' => $request->get('namaKeluarga'),
            'IdWijk' => $request->get('wijk'),
            'IdJenisRegister' => "1",
            'NoRegisterSebelumnya' => $request->get('noRegistrasiSebelumnya'),
            'TanggalWarta' => date("m/d/Y", strtotime($request->get('tanggalDiwartakan'))),
            'IdSubdis' => $request->get('kelurahan'),
            'Alamat' => $request->get('alamat'),
            'NoTelepon' => $request->get('nomorTelepon'),
            'IdStatusRegistrasi' => "1"
        ]);

        
        // Memanggil stored procedure untuk insert
        $response = DB::statement('CALL insert_registrasiJemaat(:dataRegistrasi)', ['dataRegistrasi' => $dataRegistrasi]);

        if ($response) {
            //Get id_registrasi jemaat yang diinput sebelumnya
            $noReg = $request->get('noRegistrasi');
            $dataRegistrasi = DB::select('SELECT get_idRegistrasiJemaat(' . $noReg . ') as idReg');
            $idRegistrasi = $dataRegistrasi[0];
            //dd($idRegistrasi);

            $request->session()->put('idRegistrasi', $idRegistrasi);
            //return view('admin.Master.Jemaat.createAnggotaKeluarga', compact('idRegistrasi'));
        } 

        return redirect()->route( 'Jemaat.createAnggotaKeluarga' );
    }

    public function createAnggotaKeluarga()
    {
        $pendidikan = DB::select('CALL cbo_pendidikan()');
        $bidangPendidikan = DB::select('CALL cbo_bidangPendidikan()');
        $pekerjaan = DB::select('CALL cbo_pekerjaan()');
        $golonganDarah = DB::select('CALL cbo_golonganDarah()');
        $hubunganKeluarga = DB::select('CALL cbo_hubunganKeluarga()');
        $idRegistrasi="";

        return view('admin.Master.Jemaat.createAnggotaKeluarga', compact('pendidikan', 'bidangPendidikan', 'pekerjaan', 'golonganDarah', 'hubunganKeluarga', 'idRegistrasi'));
    }

    public function storeAnggotaKeluarga(Request $request){

        $idRegistrasi = $request->session()->get('idRegistrasi');
        //$idRegistrasi = $idRegs[0]['idReg'];
        //dd( $idRegistrasi->idReg);

        if ($request->hasFile('fotoJemaat')) {
            //dd($request->file('fileSuratPerjanjian'));
            $uploadedFile = $request->file('fotoJemaat');
            $filePenilaian = $request->get('namaDepan') . '-' . time() . "." . $uploadedFile->getClientOriginalExtension();
            $filePath = Storage::disk('public')->putFileAs("images/FotoJemaat", $uploadedFile, $filePenilaian);
        }else{
            $filePath="";
        }

         // Data yang akan dikirim ke stored procedure
         $dataAnggotaJemaat= json_encode([
            'IdRegistrasi' => $idRegistrasi->idReg,
            'NamaDepan' => $request->get('namaDepan'),
            'NamaBelakang' => $request->get('namaBelakang'),
            'GelarDepan' => $request->get('gelarDepan'),
            'GelarBelakang' => $request->get('gelarBelakang'),
            'JenisKelamin' => $request->get('gender'),
            'TempatLahir' => $request->get('tempatLahir'),
            'TanggalLahir' => date("m/d/Y", strtotime($request->get('tanggalLahir'))),
            'IdPendidikan' => $request->get('pendidikan'),
            'IdBidangPendidikan' => $request->get('bidangPendidikan'),
            'BidangPendidikanLain' => $request->get('bidangPendidikanLain'),
            'IdPekerjaan' => $request->get('pekerjaan'),
            'NamaLekerjaanLain' => $request->get('pekerjaanLain'),
            'IdGolDarah' => $request->get('golonganDarah'),
            'IdHubKeluarga' => $request->get('hubunganKeluarga'),
            'IskepalaKeluarga' => $request->get('isKepalaKeluargas'),
            'NoPonsel' => $request->get('nomorPonsel'),
            'Keterangan' => $request->get('keterangan'),
            'FotoJemaat' =>  $filePath
        ]);
        
         // Memanggil stored procedure untuk insert
         $response = DB::statement('CALL insert_jemaat(:dataAnggotaJemaat)', ['dataAnggotaJemaat' => $dataAnggotaJemaat]);

         if ($response) {
            $anggotaJemaat= DB::select('CALL view_anggotaJemaatByIdReg(:id)', ['id' => $idRegistrasi->idReg]); 
             //Get id_registrasi jemaat yang diinput sebelumnya
             //$noReg = $request->get('noRegistrasi');
             //$dataRegistrasi = DB::select('SELECT get_idRegistrasiJemaat(' . $noReg . ') as idReg');
             //$idRegistrasi = $dataRegistrasi[0];
             //dd($idRegistrasi);
 
             //$request->session()->put('idRegistrasi', $idRegistrasi);
             //return view('admin.Master.Jemaat.createAnggotaKeluarga', compact('idRegistrasi'));
             return redirect()->route( 'Jemaat.createAnggotaKeluarga') ->with( ['anggotaJemaat' => $anggotaJemaat]);
         } 
 
         //return redirect()->route( 'Jemaat.createAnggotaKeluarga' );
    }

    public function createPernikahan()
    {
        $gereja = DB::select('CALL cbo_gerejaAll()');

        return view('admin.Master.Jemaat.createPernikahan', compact('gereja'));
    }

    public function storePernikahan(){

        //return view('admin.Master.Jemaat.createDataRegistrasi', compact('wijk', 'provinces'));
    }

    public function createDokumenKelengkapan()
    {
        $dokumen = DB::select('CALL cbo_jenisDokumen()');

        return view('admin.Master.Jemaat.createDokumenKelengkapan', compact('dokumen'));
    }

    public function storeDokumenKelengkapan(){

        //return view('admin.Master.Jemaat.createDataRegistrasi', compact('wijk', 'provinces'));
    }

    /**
     * Show the form for editing a current resource.
     */
    public function edit($id)
    {
        return view('admin.PengaturanDanKonfigurasi.Jemaat.edit');
    }

    public function store(Request $request)
    {
        //dd($request->dataRegistrasiJemaat);
        $dataRegistrasi =$request->all();

        dd($dataRegistrasi);

        if ($dataRegistrasi) {
            //$dataRegistrasi = json_encode($request->dataRegistrasiJemaat);
            // Handle the data as required...
            $response = DB::statement('CALL insert_jemaat(:dataJemaat)', ['dataJemaat' => $dataRegistrasi]);

            return response()->json([
                'status' => 200,
                'message' => 'Jemaat Berhasil Ditambahkan!'
            ]);
        } else {
            //dd($request->dataRegistrasiJemaat);
            return response()->json([
                'status' => 400,
                'message' => 'Jemaat Gagal Disimpan!',
                'data' => $dataRegistrasi
            ]);
        }
    }

    public function editAnggota($id)
    {
        return view('admin.PengaturanDanKonfigurasi.Jemaat.editAnggota');
    }
}
