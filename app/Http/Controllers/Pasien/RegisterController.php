<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Lakukan validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
        ]);

        \DB::beginTransaction();
        try {
            $user = User::create([
                'nama' => $request->nama,
                'username' => $request->nama,
                'password' => bcrypt($request->no_ktp),
            ]);

            $user->assignRole('Pasien');

            $pasien = Pasien::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_ktp' => $request->no_ktp,
                'no_hp' => $request->no_hp,
                'user_id' => $user->id,
            ]);
            $pasien->no_rm = date('Y') . date('m') . '-' . count(Pasien::all());
            $pasien->save();

            // Lakukan tindakan setelah registrasi jika diperlukan
            Auth::login($user);

            \DB::commit();
            // Redirect ke halaman setelah registrasi
            return redirect('/dashboard')->with('success', 'Registrasi berhasil!');
        } catch (\Throwable $th) {
            \DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
