<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends Controller
{
    public function index()
    {

        return view('admin.Master.Kegiatan.index');
    }

    public function create()
    {

        return view('admin.Master.Kegiatan.create');
    }

}
