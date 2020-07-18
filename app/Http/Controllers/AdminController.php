<?php

namespace App\Http\Controllers;

use App\Objects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Auth;

class AdminController extends Controller
{
    public function show_dashboard()
    {      
       return view('dashboard');
    }
    public function show_register()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $username = $request->get('txtUserName');
        $fullname = $request->get('txtFullName');
        $address = $request->get('txtAddress');
        $password = $request->get('txtPassword');
        // tao object
        $user = new User(
            [
                'username' => $username,
                'fullname' => $fullname,
                'password' => bcrypt($password),
                'address' => $address,
                'status' => 1
            ]
        );
        // check file import
        if ($request->hasFile("txtImage")) {
            if ($request->file("txtImage")->isValid()) {
                $imageName = $username . '_' . time() . '.' . $request->txtImage->extension();
                echo "imageName=" . $imageName;
                echo "public_path=" . public_path('uploads');
                $request->txtImage->move(public_path('uploads'), $imageName);
                //$path = $request->file('image')->storeAs('uploads', $imageName, 'public');
                $path_image = "uploads/" . $imageName;
                echo "path=" . $path_image;
                $user->image = $path_image;
            }
        }
        $user->save();
        return view('register')->with('message', 'Đăng ký tài khoản thành công');
    }
    public function show_login()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $username = $request->get('txtUserName');
        $password = $request->get('txtPassword');
        if (Auth::attempt(['username' => $username, 'password' => $password, 'status' => 1])) {            
            return redirect()->to("/dashboard");
        } else {
            return view('login')->with("message", "Username/ password không đúng");
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();        
        return redirect()->to('/login');
    }
}
