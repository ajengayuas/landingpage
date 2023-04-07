<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterKonten;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;

class MasterKontenController extends Controller
{
    public function index()
    {
        return view('masterkonten');
    }

    public function listkonten(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterKonten::where('aktif', 1)->orderby('judul', 'asc')->get();
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
        $cekalias = MasterKonten::where('alias', $request->alias)->where('aktif', 1)->first();
        if ($cekalias != null) {
            $status = ['title' => 'Gagal!', 'status' => 'error', 'message' => 'Alias Sudah Tersedia'];
            return response()->json($status, 200);
        }
        $created_by = Session::get('usernamelogin');
        $save = MasterKonten::insert([
            'judul'        => $request->judul,
            'alias'        => $request->alias,
            'desk'        => $request->desk,
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
        $data = MasterKonten::find($request->id);
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function update(Request $request)
    {
        $updatedby = Session::get('usernamelogin');
        $data = MasterKonten::find($request->id);
        $cekalias = MasterKonten::where('alias', $request->alias)->where('aktif', 1)->first();
        if ($cekalias != null && $request->alias != $data->alias) {
            $status = ['title' => 'Gagal!', 'status' => 'error', 'message' => 'Alias Sudah Tersedia'];
            return response()->json($status, 200);
        }
        $update = MasterKonten::where('id', $request->id)->update([
            'judul'        => $request->judul,
            'alias'        => $request->alias,
            'desk'        => $request->desk,
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
        $delete = MasterKonten::where('id', $request->id)->update([
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
