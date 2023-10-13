<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use finfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;

class APIJenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Jenis::orderBy('nama')->where('nama','like',"%$request->cari%")->orWhere('deskripsi','like',"%$request->cari%")->orWhere('harga','like',"%$request->cari%")->get();
        return response()->json(json_encode($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'foto' => 'required|image',
            'nama' => 'required|min:3',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:1',
        ],[
            'required' => 'Field ini tidak boleh kosong!',
            'nama.min' => 'Filed ini harus berisi minimal 3 huruf!',
            'harga.min' => 'Field ini harus angka lebih dari 0!',
            'image' => 'File yang anda pilih bukan gambar'
        ]);
        $response = ['isSuccess' => $validator->passes(), 'errors' => $validator->errors()];
        if($validator->passes()){
            $jenis = new Jenis();
            $jenis->foto = $request->file('foto')->store('/public/gambar');
            $jenis->nama = $request->nama;
            $jenis->deskripsi = $request->deskripsi;
            $jenis->harga = (int) $request->harga;
            $jenis->save();
        }
        return response()->json(json_encode($response));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data = Jenis::find($request->id);
        return response()->json(json_encode($data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'nama' => 'required|min:3',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:1',
        ],[
            'required' => 'Field ini tidak boleh kosong!',
            'nama.min' => 'Filed ini harus berisi minimal 3 huruf!',
            'harga.min' => 'Field ini harus angka lebih dari 0!',
            'image' => 'File yang anda pilih bukan gambar'
        ]);
        $response = ['isSuccess' => $validator->passes(), 'errors' => $validator->errors()];
        if($validator->passes()){
            $jenis = Jenis::find($request->id);
            if($request->foto){
                $jenis->foto = $request->file('foto')->store('/public/gambar');
            }
            $jenis->nama = $request->nama;
            $jenis->deskripsi = $request->deskripsi;
            $jenis->harga = (int) $request->harga;
            $jenis->save();
        }
        return response()->json(json_encode($response));
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = Jenis::find($request->id);
        $data->delete();
        return response()->json('sukses');
    }
}
