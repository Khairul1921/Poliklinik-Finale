<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;

class PeriksaPasienController extends Controller
{
    public function index()
    {
        $jadwal = \Auth::user()->dokter->jadwalPeriksa->load('daftarPoli.pasien', 'daftarPoli.periksa');
        $daftar = [];
        foreach ($jadwal as $data) {
            foreach ($data->daftarPoli as $daftarPoli) {
                $daftar[] = $daftarPoli;
            }
        }
        return view('dokter.periksa-pasien.index', compact('daftar'));
    }

    public function periksa($id)
    {
        $daftar = DaftarPoli::findOrFail($id);
        $obat = Obat::all();
        return view('dokter.periksa-pasien.periksa', compact('daftar', 'obat'));
    }

    public function postPeriksa(Request $request, $id)
    {
        $biaya = Obat::whereIn('id', $request->obat)->sum('harga');
        $periksa = Periksa::create([
            'id_daftar_poli' => $id,
            'tgl_periksa' => request('tgl_periksa'),
            'catatan' => request('catatan'),
            'biaya_periksa' => $biaya,
            'obat' => json_encode($request->obat, JSON_THROW_ON_ERROR),
        ]);
        return redirect()->route('periksa-pasien.index')->with('success', 'Berhasil melakukan periksa');
    }
}
