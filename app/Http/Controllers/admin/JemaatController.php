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
        $jemaatTeregistrasi = DB::select('CALL viewAll_jemaatTeregistrasi()');
        ;

        return view('admin.Master.Jemaat.index', compact('jemaatTeregistrasi'));
    }

    public function createDataRegistrasi()
    {
        $wijk = DB::select('CALL cbo_wijk()');
        $provinces = DB::select('CALL cbo_provinces()');

        return view('admin.Master.Jemaat.createDataRegistrasi', compact('wijk', 'provinces'));
    }

    public function storeDataRegistrasi(Request $request)
    {
        $idGereja = 1;
        // Data yang akan dikirim ke stored procedure
        $dataRegistrasi = json_encode([
            'NoRegistrasi' => $request->get('noRegistrasi'),
            'TanggalRegistrasi' => date("m/d/Y", strtotime($request->get('tanggalRegistrasi'))),
            'NamaKeluarga' => $request->get('namaKeluarga'),
            'IdWijk' => $request->get('wijk'),
            'IdJenisRegister' => "1",
            'IdGereja' => $idGereja,
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

        return redirect()->route('Jemaat.createAnggotaKeluarga');
    }

    public function createAnggotaKeluarga()
    {
        $pendidikan = DB::select('CALL cbo_pendidikan()');
        $bidangPendidikan = DB::select('CALL cbo_bidangPendidikan()');
        $pekerjaan = DB::select('CALL cbo_pekerjaan()');
        $golonganDarah = DB::select('CALL cbo_golonganDarah()');
        $hubunganKeluarga = DB::select('CALL cbo_hubunganKeluarga()');
        $idRegistrasi = "";

        return view('admin.Master.Jemaat.createAnggotaKeluarga', compact('pendidikan', 'bidangPendidikan', 'pekerjaan', 'golonganDarah', 'hubunganKeluarga', 'idRegistrasi'));
    }

    public function storeAnggotaKeluarga(Request $request)
    {

        $idRegistrasi = $request->session()->get('idRegistrasi');

        if (is_null($request->get('isKepalaKeluarga')) || is_null($request->get('isKepalaKeluargas'))) {
            $isKepalaKeluarga = 0;
        } else {
            $isKepalaKeluarga = $request->get('isKepalaKeluarga');
        }

        if ($request->hasFile('fotoJemaat')) {
            //dd($request->file('fileSuratPerjanjian'));
            $uploadedFile = $request->file('fotoJemaat');
            $filePenilaian = $request->get('namaDepan') . '-' . time() . "." . $uploadedFile->getClientOriginalExtension();
            $filePath =  Storage::disk('biznet')->putFileAs("images/fotoJemaat", $uploadedFile, $filePenilaian);
        } else {
            $filePath = "";
        }

        // Data yang akan dikirim ke stored procedure
        $dataAnggotaJemaat = json_encode([
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
            'IskepalaKeluarga' => $isKepalaKeluarga,
            'NoPonsel' => $request->get('nomorPonsel'),
            'Keterangan' => $request->get('keterangan'),
            'FotoJemaat' => $filePath
        ]);

        // Memanggil stored procedure untuk insert
        $response = DB::statement('CALL insert_jemaat(:dataAnggotaJemaat)', ['dataAnggotaJemaat' => $dataAnggotaJemaat]);

        if ($response) {
            $anggotaJemaat = DB::select('CALL view_anggotaJemaatByIdReg(:id)', ['id' => $idRegistrasi->idReg]);

            $request->session()->put('anggotaJemaat', $anggotaJemaat);

            return redirect()->route('Jemaat.createAnggotaKeluarga');
        }

        //return redirect()->route( 'Jemaat.createAnggotaKeluarga' );
    }

    public function createPernikahan()
    {
        $gereja = DB::select('CALL cbo_gerejaAll()');

        return view('admin.Master.Jemaat.createPernikahan', compact('gereja'));
    }

    public function storePernikahan(Request $request)
    {

        $idRegistrasi = $request->session()->get('idRegistrasi');

        if (is_null($request->get('gerejaHKBP')) || is_null($request->get('gerejaHKBP'))) {
            $isHKBP = 0;
        } else {
            $isHKBP = $request->get('gerejaHKBP');
        }

        //dd( $idRegistrasi);

        $dataPernikahan = json_encode([
            'IdRegistrasiPernikahan' => '0',
            'IdRegistrasiJemaat' => $idRegistrasi->idReg,
            'TanggalPernikahan' => date("m/d/Y", strtotime($request->get('tanggalMenikah'))),
            'NatsPernikahan' => $request->get('natsPernikahan'),
            'IsHKBP' => $isHKBP,
            'IdGerejaNikah' => $request->get('gerejaHKBP'),
            'NamaGerejaNonHKBP' => $request->get('gerejaNonHKBP'),
            'NamaPendeta' => $request->get('namaPendeta'),
            'Keterangan' => $request->get('keteranganPernikahan')
        ]);

        // Memanggil stored procedure untuk insert
        $response = DB::statement('CALL insert_pernikahan(:dataPernikahan)', ['dataPernikahan' => $dataPernikahan]);

        if ($response) {
            return redirect()->route('Jemaat.createDokumenKelengkapan');
        }

        //return view('admin.Master.Jemaat.createDataRegistrasi', compact('wijk', 'provinces'));
    }

    public function createDokumenKelengkapan()
    {
        $dokumen = DB::select('CALL cbo_jenisDokumen()');

        return view('admin.Master.Jemaat.createDokumenKelengkapan', compact('dokumen'));
    }

    public function storeDokumenKelengkapan(Request $request)
    {

        $idRegistrasi = $request->session()->get('idRegistrasi');
        $idJenisRegistrasi = '1';

        if ($request->hasFile('fileDokumen')) {
            //dd($request->file('fileSuratPerjanjian'));
            $uploadedFile = $request->file('fileDokumen');
            $filePenilaian = 'Dokumen Kelengkapan' . '-' . time() . "." . $uploadedFile->getClientOriginalExtension();
            $filePath = Storage::disk('biznet')->putFileAs("documents/Jemaat/DokumenKelengkapan", $uploadedFile, $filePenilaian);
        } else {
            $filePath = "";
        }

        // Data yang akan dikirim ke stored procedure
        $dataDokumenKelengkapan = json_encode([
            'IdRegistrasi' => $idRegistrasi->idReg,
            'IdJenisRegistrasi' => $idJenisRegistrasi,
            'NamaDokumen' => $request->get('namaDokumen'),
            'KeteranganDokumen' => $request->get('keteranganDokumen'),
            'FileDokumen' => $filePath
        ]);

        // Memanggil stored procedure untuk insert
        $response = DB::statement('CALL insert_dokumenKelengkapanJemaat(:dataDokumenKelengkapan)', ['dataDokumenKelengkapan' => $dataDokumenKelengkapan]);

        if ($response) {
            $dokumenKelengkapan = DB::select('CALL view_dokumenKelengkapanByIdRegJenis(?,?)', [$idRegistrasi->idReg, $idJenisRegistrasi]);

            $request->session()->put('dokumenKelengkapan', $dokumenKelengkapan);

            return redirect()->route('Jemaat.createDokumenKelengkapan');
        }
    }

    public function finishRegistrasiJemaat()
    {
        session()->forget('idRegistrasi');
        session()->forget('anggotaJemaat');
        session()->forget('dokumenKelengkapan');

        return redirect()->route('Jemaat.index');
    }

    /**
     * Show the form for editing a current resource.
     */
    public function edit($id)
    {
        $wijk = DB::select('CALL cbo_wijk()');
        $provinces = DB::select('CALL cbo_provinces()');

        $registrasiJemaatData = DB::select('CALL view_registrasiJemaat_byId(' . $id . ')');
        $anggotaJemaat = DB::select('CALL view_allJemaatByRegistrasiId(' . $id . ')');

        if ($registrasiJemaatData) {

            $registrasiJemaat = $registrasiJemaatData[0];

            $kota = DB::select('CALL cbo_cities(' . $registrasiJemaat->prov_id . ')');
            $kecamatan = DB::select('CALL cbo_kecamatan(' . $registrasiJemaat->city_id . ')');
            $kelurahan = DB::select('CALL cbo_subdistricts(' . $registrasiJemaat->dis_id . ')');


            return view('admin.Master.Jemaat.edit', compact('registrasiJemaat', 'wijk', 'provinces','kota','kecamatan','kelurahan', 'anggotaJemaat'));
        } else {
            return redirect()->route('Jemaat.index')->with('error', 'Data Jemaat Tidak Ditemukan!');
        }


    }

    public function editAnggota($id)
    {
        return view('admin.Master.Jemaat.editAnggota');
    }

    public function detail($id)
    {
        $registrasiJemaatData = DB::select('CALL view_registrasiJemaat_byId(' . $id . ')');
        $anggotaJemaat = DB::select('CALL view_allJemaatByRegistrasiId(' . $id . ')');

        if ($registrasiJemaatData) {

            $registrasiJemaat = $registrasiJemaatData[0];


            return view('admin.Master.Jemaat.detail', compact('registrasiJemaat', 'anggotaJemaat'));
        } else {
            return redirect()->route('Jemaat.index')->with('error', 'Data Jemaat Tidak Ditemukan!');
        }


    }
}
