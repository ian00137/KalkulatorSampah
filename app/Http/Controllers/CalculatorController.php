<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index(){
        $data = Jenis::orderBy('nama')->get();
        return view('calculator',["data" => $data]);
    }

    public function hasil(Request $request){
        $hasil = [];
        for($i = 0; $i < count($request->id); $i++){
            $id = $request->id[$i];
            $data = Jenis::find($id);
            $nama = $data->nama;
            $harga = $data->harga;
            $kg = $request->kg[$i];
            $total = $harga * $kg;
            $hasil[] = ["nama" => $nama,"harga" => $harga,"kg" => $kg, "total" => $total,];
        }
        return view('hasil',['hasil' => $hasil]);
    }
}
