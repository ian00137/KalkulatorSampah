<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function cekLogin(Request $request){
        if(Auth::attempt(['username' => $request->username,'password' => $request->password,])){
            $request->session()->regenerate();
 
            return redirect()->intended('/admin/jenis');
        }
        return redirect()->back()->with('gagal','Username atau password anda salah!');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
}
