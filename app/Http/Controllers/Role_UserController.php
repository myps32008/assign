<?php

namespace App\Http\Controllers;

use App\Role;
use App\Role_User;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Role_UserController extends Controller
{
    public function index($id)
    {
        $currentUser = Auth::user();
        if (($currentUser->username == "administrator" && $currentUser->id == $id) ||
            ($currentUser->username != "administrator" && $currentUser->id != $id)
        ) {
            return redirect()->to('dashboard');
        }
        $user = User::find($id);
        $roleUser = json_decode(json_encode(
            DB::table('role_users')
                ->where('user_id', $id)
                ->select('role_id')
                ->distinct()->get()
        ), true);;
        $allRole = Role::all();
        $roleView = [];
        $exist = false;
        foreach ($allRole as $role) {
            if (in_array($role->id, $roleUser)) {
                $exist = true;
            }
            $roleView[] = [$role, $exist];
        }
        return view('role_userView', compact('roleView', 'user'));
    }
    public function editAjax(Request $request)
    {
        $status = false;
        try {
            $idUser = $request->get('idUser');
            $idRole = $request->get('idRole');
            $role_user = Role_User::where([
                ['user_id', '=', $idUser],
                ['role_id', '=', $idRole]
            ])->first();
            if ($role_user == null) {
                DB::table('role_users')->insert([
                    'user_id' => $idUser,
                    'role_id' => $idRole
                ]);
                $status = true;
            } else {
                if ($role_user->status) {
                    $role_user->status = false;
                    $status = false;
                }
                else {
                    $role_user->status = true;
                    $status = true;
                }
                $role_user->save();
            }
        } catch (\Throwable $th) {
            return Response()->json([
                'message' => "Sửa đổi thất bại: " . $th->getMessage(),
                'status' => 400
            ]);
        }
        return Response()->json([
            'message' => "Sửa đổi thành công.",
            'status' => 200,
            'wish' => $status
        ]);
    }
}
