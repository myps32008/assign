<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $allRole = Role::all();
        return view('roleview.roleview', compact('allRole'));
    }

    public function updateStatus(Request $request)
    {
        try {
            $role = Role::find($request->get('id'));
            if ($role->status) {
                $role->status = false;
            } else {
                $role->status = true;
            }
            $role->save();
        } catch (\Throwable $th) {
            return Response()->json([
                'message' => "Cập nhật trạng thái role thất bại. " . $th->getMessage(),
                'status' => 400
            ]);
        }
        return Response()->json([
            'message' => "Cập nhật trạng thái role thành công. ",
            'wish' => $role->status,
            'status' => 200
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::table('roles')->insert([
                'role_name' => $request->get('role_name'),
                'role_code' => $request->get('role_code'),
                'status' => $request->get('status'),
                'description' => $request->get('description'),
                'created_by' => 1,
                'created_at' => now()
            ]);
        } catch (\Throwable $th) {
            return Response()->json([
                'message' => "Thêm role mới thất bại. " . $th->getMessage(),
                'status' => 400
            ]);
        }
        $lastID = DB::table('roles')->orderByDesc('id')->select('id')->first();
        return Response()->json([
            'message' => "Thêm role mới thành công. ",
            'newID' => $lastID,
            'status' => 200
        ]);
    }

    public function destroy(Request $request)
    {
        try {
            $role = Role::find($request->get('id'));
            $role->delete();
        } catch (\Throwable $th) {
            return Response()->json([
                'message' => "Xoá role thất bại: " . $th->getMessage(),
                'status' => 400
            ]);
        }
        return Response()->json([
            'message' => "Xoá role thành công.",
            'status' => 200
        ]);
    }

    public function edit(Request $request)
    {
        try {
            $role = Role::find($request->get('id'));
            $role->role_name = $request->get('role_name');
            $role->description = $request->get('description');
            $role->role_code = $request->get('role_code');
            $role->save();
        } catch (\Throwable $th) {
            return Response()->json([
                'message' => "Sửa đổi thất bại: " . $th->getMessage(),
                'status' => 400
            ]);
        }
        return Response()->json([
            'message' => "Sửa đổi thành công",
            'status' => 200
        ]);
    }
}
