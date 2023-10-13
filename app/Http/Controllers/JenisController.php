<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JenisController extends Controller
{
    function index(){
        return view('admin.jenis');
    }
}
