<?php

namespace App\Http\Controllers;

use App\Models\DataKonten;
use Illuminate\Http\Request;
use App\Models\DataSaran;
use App\Models\MasterKonten;

class IndexController extends Controller
{
    public function index()
    {
        $fitur = MasterKonten::leftjoin('data_kontens', 'master_kontens.id', 'data_kontens.idkonten')
            ->where('master_kontens.alias', 'fitur')
            ->where('master_kontens.aktif', 1)
            ->where(function ($query) {
                $query->whereNull('data_kontens.aktif')
                    ->orWhere('data_kontens.aktif', 1);
            })
            ->get();
        $kategori = MasterKonten::leftjoin('data_kontens', 'master_kontens.id', 'data_kontens.idkonten')
            ->where('master_kontens.alias', 'kategori')
            ->where('master_kontens.aktif', 1)
            ->where(function ($query) {
                $query->whereNull('data_kontens.aktif')
                    ->orWhere('data_kontens.aktif', 1);
            })
            ->get();
        $map = MasterKonten::leftjoin('data_kontens', 'master_kontens.id', 'data_kontens.idkonten')
            ->where('master_kontens.alias', 'map')
            ->where('master_kontens.aktif', 1)
            ->where(function ($query) {
                $query->whereNull('data_kontens.aktif')
                    ->orWhere('data_kontens.aktif', 1);
            })
            ->get();
        $tentang = MasterKonten::leftjoin('data_kontens', 'master_kontens.id', 'data_kontens.idkonten')
            ->where('master_kontens.alias', 'tentang')
            ->where('master_kontens.aktif', 1)
            ->where(function ($query) {
                $query->whereNull('data_kontens.aktif')
                    ->orWhere('data_kontens.aktif', 1);
            })
            ->get();
        $daftar = MasterKonten::leftjoin('data_kontens', 'master_kontens.id', 'data_kontens.idkonten')
            ->where('master_kontens.alias', 'daftar')
            ->where('master_kontens.aktif', 1)
            ->where(function ($query) {
                $query->whereNull('data_kontens.aktif')
                    ->orWhere('data_kontens.aktif', 1);
            })
            ->get();
        $karir = MasterKonten::leftjoin('data_kontens', 'master_kontens.id', 'data_kontens.idkonten')
            ->where('master_kontens.alias', 'karir')
            ->where('master_kontens.aktif', 1)
            ->where(function ($query) {
                $query->whereNull('data_kontens.aktif')
                    ->orWhere('data_kontens.aktif', 1);
            })
            ->get();
        return view('index', compact('fitur', 'kategori', 'map', 'daftar', 'tentang', 'karir'));
    }

    public function store(Request $request)
    {
        $save = DataSaran::insert([
            'nama'        => $request->nama,
            'email'        => $request->email,
            'subject'        => $request->subject,
            'pesan'        => $request->pesan,
            'aktif' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        if ($save) {
            $status = ['title' => 'Sukses!', 'status' => 'success', 'message' => 'Data Berhasil Disimpan'];
            return response()->json($status, 200);
        } else {
            $status = ['title' => 'Gagal!', 'status' => 'error', 'message' => 'Data Gagal Disimpan'];
            return response()->json($status, 200);
        }
    }
}
