<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->username == "administrator") {
            $allUser = User::all();
        } else {
            $allUser = [$user];
        }
        return view('userView', compact('allUser'));
    }
    public function edit(Request $request)
    {        
        try {
            $user = User::find($request->get('id'));
            $user->fullname = $request->get('fullname');
            $user->email = $request->get('email');
            $user->address = $request->get('address');
            $data_Password = $request->get('password');
            if ($data_Password != null && $data_Password != "") {
                $newPassword = bcrypt($data_Password);               
                $user->password = $newPassword;
            }
            $user->save();
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
    public function updateStatus(Request $request)
    {
        try {
            $user = User::find($request->get('id'));
            if ($user->status) {
                $user->status = false;
            } else {
                $user->status = true;
            }
            $user->save();
        } catch (\Throwable $th) {
            return Response()->json([
                'message' => "Cập nhật trạng thái user thất bại. " . $th->getMessage(),
                'status' => 400
            ]);
        }
        return Response()->json([
            'message' => "Cập nhật trạng thái user thành công. ",
            'wish' => $user->status,
            'status' => 200
        ]);
    }
}
