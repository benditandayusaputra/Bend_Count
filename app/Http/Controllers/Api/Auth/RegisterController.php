<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Register a newly User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tps_id'    => 'required',
            'nik'       => 'required|unique:users,nik',
            'name'      => 'required',
            'address'   => 'required',
            'wa'        => 'required|numeric',
            'photo_ktp' => 'required|mimes:jpg,png,jpeg,bmp,svg,JPG,PNG,JPEG',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6'
        ], [
            'tps_id.required'       => 'TPS Harus Di Isi',
            'nik.required'          => 'NIK Harus Di Isi',
            'nik.unique'            => 'NIK Sudah terdaftar',
            'name.required'         => 'Nama Harus Di Isi',
            'address.required'      => 'Alamat Harus Di Isi',
            'wa.required'           => 'Nomor WA Harus Di Isi',
            'wa.numeric'            => 'Nomor WA Harus Berisi Angka Semua',
            'photo_ktp.required'    => 'Foto KTP Harus Di Isi',
            'photo_ktp.mimes'       => 'Yang Anda Upload Bukan Foto',
            'email.required'        => 'Email Harus Di Isi',
            'email.email'           => 'Format Email Tidak Sesuai',
            'email.unique'          => 'Email Sudah Terdaftar',
            'password.required'     => 'Password Harus Di Isi',
            'password.min'          => 'Password Minimal 6 Karakter'
        ]);

        User::create($request->all());

        return response()->json([
            'success'   => true,
            'message'   => 'Registrasi Berhasil, Silahkan Tunggu Konfirmasi Admin'
        ]);
    }
}