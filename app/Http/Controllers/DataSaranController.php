<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSaran;
use Yajra\Datatables\Datatables;

class DataSaranController extends Controller
{
    public function index()
    {
        return view('datasaran');
    }

    public function listdatasaran(Request $request)
    {
        if ($request->ajax()) {
            $data = DataSaran::where('aktif', 1)->orderby('nama', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }
}
