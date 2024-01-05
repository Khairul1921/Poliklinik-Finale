<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\Obat;
use App\Models\Pasien;

class RiwayatPasienController extends Controller
{
    public function index()
    {
        $pasien = Pasien::all();
        return view('dokter.riwayat-pasien.index', compact('pasien'));
    }

    public function show($id)
    {
        $pasien = DaftarPoli::where('id_pasien', $id)->with('pasien', 'jadwal.dokter', 'periksa')->get();

        $html = [];
        if (count($pasien) > 0) {
            foreach ($pasien as $index => $item) {
                $list_obat = json_decode($item->periksa->obat, false, 512, JSON_THROW_ON_ERROR);
                $obat = Obat::whereIn('id', $list_obat)->pluck('nama_obat')->toArray();
                $html[] = "
                    <tr>
                        <td>". $index+1 ."</td>
                        <td>". $item->periksa->tgl_periksa ."</td>
                        <td>". $item->pasien->nama ."</td>
                        <td>". $item->jadwal->dokter->nama ."</td>
                        <td>". $item->keluhan ."</td>
                        <td>". $item->periksa->catatan ."</td>
                        <td>". implode('<br>', $obat) ."</td>
                        <td>". $item->periksa->biaya_periksa ."</td>
                    </tr>
                ";
            }
        } else {
            $html[] = "
                <tr>
                    <td colspan='8' class='text-center'>Data tidak ditemukan. Pasien belum melakukan periksa.</td>
                </tr>
            ";
        }

        return response()->json([
            'html' => implode('', $html),
        ]);
    }
}
