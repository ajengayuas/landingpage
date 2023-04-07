<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKonten;
use App\Models\MasterKonten;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;

class DataKontenController extends Controller
{
    public function index()
    {
        $id = MasterKonten::where('aktif', '1')->get()->pluck('judul', 'judul')->all();
        $idkonten = '';
        return view('datakonten', compact('id', 'idkonten'));
    }

    public function listkonten(Request $request)
    {
        if ($request->ajax()) {
            $data = DataKonten::select('data_kontens.*', 'master_kontens.judul')
                ->join('master_kontens', 'data_kontens.idkonten', 'master_kontens.id')
                ->where('data_kontens.aktif', 1)->orderby('data_kontens.idkonten', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="btnedit" class="edit btn btn-primary btn-xs" data-id="' . $row->id . '">Edit</a> 
                    <a href="javascript:void(0)" id="btndelete" class="delete btn btn-danger btn-xs" data-id="' . $row->id . '">Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $variable1  = $request->input('variable1');
        $variable2  = $request->input('variable2');
        $variable3  = $request->input('variable3');
        $variable4  = $request->input('variable4');
        $extention = $request->file('fileData')->getClientOriginalExtension();
        $newname = $request->variable3 . '-' . now()->timestamp . '.' . $extention;
        $request->file('fileData')->storeAs('photo', $newname);
        $idk = MasterKonten::where('judul', $variable2)->first();
        $cek = DataKonten::where('subjudul', $variable3)->where('aktif', 1)->first();
        if ($cek != null) {
            $status = ['title' => 'Gagal!', 'status' => 'error', 'message' => 'Subjudul Sudah Tersedia'];
            return response()->json($status, 200);
        }
        $created_by = Session::get('usernamelogin');
        $save = DataKonten::insert([
            'idkonten'        => $idk->id,
            'subjudul'        => $variable3,
            'isi'        => $variable4,
            'image' => $newname,
            'aktif' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $created_by
        ]);
        if ($save) {
            $status = ['title' => 'Sukses!', 'status' => 'success', 'message' => 'Data Berhasil Disimpan'];
            return response()->json($status, 200);
        } else {
            $status = ['title' => 'Gagal!', 'status' => 'error', 'message' => 'Data Gagal Disimpan'];
            return response()->json($status, 200);
        }
    }

    public function edit(Request $request)
    {
        $data = DataKonten::find($request->id);
        $idk = MasterKonten::where('id', $data->idkonten)->first();
        return response()->json(['status' => 'success', 'data' => $data, 'datajudul' => $idk], 200);
    }

    public function update(Request $request)
    {
        $fileData   = $request->file('fileData');
        $variable1  = $request->input('variable1');
        $variable2  = $request->input('variable2');
        $variable3  = $request->input('variable3');
        $variable4  = $request->input('variable4');
        $extention = $request->file('fileData')->getClientOriginalExtension();
        $newname = $request->variable3 . '-' . now()->timestamp . '.' . $extention;
        $request->file('fileData')->storeAs('photo', $newname);
        $updatedby = Session::get('usernamelogin');
        $data = DataKonten::find($variable1);
        $cek = DataKonten::where('subjudul', $variable3)->where('aktif', 1)->first();
        if ($cek != null && $variable3 != $data->subjudul) {
            $status = ['title' => 'Gagal!', 'status' => 'error', 'message' => 'Subjudul Sudah Tersedia'];
            return response()->json($status, 200);
        }
        $idk = MasterKonten::where('judul', $variable2)->first();
        $img = '';
        if ($newname == null || $newname == '') {
            $img = $data->image;
        } else {
            $img = $newname;
        }
        $update = DataKonten::where('id', $variable1)->update([
            'idkonten'        => $idk->id,
            'subjudul'        => $variable3,
            'isi'        => $variable4,
            'image' => $img,
            'aktif' => 1,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $updatedby
        ]);

        if ($update) {
            $status = ['title' => 'Sukses!', 'status' => 'success', 'message' => 'Data Berhasil Diedit'];
            return response()->json($status, 200);
        } else {
            $status = ['title' => 'Gagal!', 'status' => 'error', 'message' => 'Data Gagal Diedit'];
            return response()->json($status, 200);
        }
    }

    public function destroy(Request $request)
    {
        $updatedby = Session::get('usernamelogin');
        $delete = DataKonten::where('id', $request->id)->update([
            'aktif' => 0,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $updatedby
        ]);

        if ($delete) {
            $status = ['title' => 'Sukses!', 'status' => 'success', 'message' => 'Data Berhasil Dihapus'];
            return response()->json($status, 200);
        } else {
            $status = ['title' => 'Gagal!', 'status' => 'error', 'message' => 'Data Gagal Dihapus'];
            return response()->json($status, 200);
        }
    }
}
