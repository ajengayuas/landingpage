<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function index()
    {
        $userlogin = Session::get('usernamelogin');
        return view('userman', compact('userlogin'));
    }

    public function datauser(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('aktif', 1)->orderby('name', 'asc')->get();
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['updated_by'] = '';
        $user = User::create($input);

        if ($user) {
            $status = ['title' => 'Sukses!', 'status' => 'success', 'message' => 'Data Berhasil Disimpan'];
            return response()->json($status, 200);
        } else {
            $status = ['title' => 'Gagal!', 'status' => 'error', 'message' => 'Data Gagal Disimpan'];
            return response()->json($status, 200);
        }
    }

    public function edit(Request $request)
    {
        $data = User::find($request->id);
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'password' => 'same:confirm-password'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $user = User::find($request->id);
        $input['created_by'] = $user->created_by;
        $updateuser = $user->update($input);

        if ($updateuser) {
            $status = ['title' => 'Sukses!', 'status' => 'success', 'message' => 'Data Berhasil Diupdate'];
            return response()->json($status, 200);
        } else {
            $status = ['title' => 'Gagal!', 'status' => 'error', 'message' => 'Data Gagal Diupdate'];
            return response()->json($status, 200);
        }
    }

    public function destroy(Request $request)
    {
        $updatedby = $request->user()->email;
        $cek = User::where('id', $request->id)->where('aktif', 1)->first();
        if ($cek->email == $request->user()->email) {
            $status = ['title' => 'Gagal!', 'status' => 'error', 'message' => 'User sedang digunakan'];
            return response()->json($status, 200);
        }
        $delete = User::where('id', $request->id)->update([
            'aktif' => 0,
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
