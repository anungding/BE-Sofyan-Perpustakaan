<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnggotaController extends Controller
{
    //Menampilkan semua data Anggota
    public function index()
    {
        $list_anggota = Anggota::all();
        return response()->json([
            'status' => true,
            'status_code' => 200,
            'message' => 'Data berhasil ditampilkan',
            'data' => $list_anggota
        ], 200);
    }

    //Menambah data Anggota
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'email'     => 'required|email|unique:anggotas',
            'no_hp'   => 'required',
            'alamat'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'status_code' => 422,
                'message' => 'Data gagal ditambahkan',
                'error_message' => $validator->errors()
            ], 422);
        }

        Anggota::create([
            'nama'     => $request->nama,
            'email'     => $request->email,
            'no_hp'   => $request->no_hp,
            'alamat'   => $request->alamat
        ]);

        return response()->json([
            'status' => true,
            'status_code' => 200,
            'message' => 'Data berhasil ditambahkan',
        ], 200);
    }

    //Menampilkan detail data Anggota
    public function show($id)
    {
        $anggota = Anggota::find($id);
        if ($anggota) {
            return response()->json([
                'status' => true,
                'status_code' => 200,
                'message' => 'Data ditemukan',
                'data' => $anggota
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'status_code' => 404,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }
    }

    //Update data Anggota
    public function update(Request $request, $id)
    {
        $anggota = Anggota::find($id);

        if (!$anggota) {
            return response()->json([
                'status' => false,
                'status_code' => 404,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'status_code' => 422,
                'message' => 'Data gagal diperbaharui',
                'error_message' => $validator->errors()
            ], 422);
        }

        // Periksa apakah email yang dimasukkan sama dengan yang ada di database
        if ($request->email === $anggota->email) {
            $anggota->update([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat
            ]);
        } else {
            $emailExist = Anggota::where('email', $request->email)->exists();
            if ($emailExist) {
                return response()->json([
                    'status' => false,
                    'status_code' => 422,
                    'message' => 'Email sudah digunakan',
                ], 422);
            }

            $anggota->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat
            ]);
        }

        return response()->json([
            'status' => true,
            'status_code' => 200,
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    //Hapus data Anggota
    public function delete($id)
    {
        $anggota = Anggota::find($id);
        if (!$anggota) {
            return response()->json([
                'status' => false,
                'status_code' => 404,
                'message' => 'Data gagal ditemukan',
            ], 404);
        }

        $anggota->delete();

        return response()->json([
            'status' => true,
            'status_code' => 200,
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}
