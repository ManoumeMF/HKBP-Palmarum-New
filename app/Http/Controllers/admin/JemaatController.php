<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('admin.PengaturanDanKonfigurasi.Jemaat.create');
    }

     /**
     * Show the form for editing a current resource.
     */
    public function edit($id)
    {
        return view('admin.PengaturanDanKonfigurasi.Jemaat.edit');
    }



    public function editAnggota($id)
    {
        return view('admin.PengaturanDanKonfigurasi.Jemaat.editAnggota');
    }
}
