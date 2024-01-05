<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use Illuminate\Http\Request;

class DaftarPoliController extends Controller
{
    public function index()
    {
        $daftar_poli = \Auth::user()->load('pasien.daftarPoli.jadwal.dokter.poli')->pasien->daftarPoli;
        return view('pasien.dafar-poli.index', compact('daftar_poli'));
    }

    public function create()
    {
        $poli = Poli::all();
        return view('pasien.dafar-poli.create', compact('poli'));
    }

    public function getJadwal(Request $request)
    {
        $dokter = Dokter::where('id_poli', $request->id)->pluck('id')->toArray();
        $jadwal = JadwalPeriksa::select('id','id_dokter','hari','jam_mulai','jam_selesai')
            ->whereIn('id_dokter', $dokter)->get();
        return response()->json($jadwal);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required',
            'keluhan' => 'required',
        ]);

        try {
            $daftar_poli = DaftarPoli::create([
                'id_jadwal' => $request->id_jadwal,
                'id_pasien' => \Auth::user()->pasien->id,
                'keluhan' => $request->keluhan,
                'no_antrian' => DaftarPoli::where('id_jadwal', $request->id_jadwal)->whereDate('created_at', now())->count() + 1,
            ]);

            return redirect()->route('daftar-poli.index')->with('success', 'Berhasil mendaftar poli');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mendaftar poli');
        }
    }

    public function edit($id)
    {
        $daftarPoli = DaftarPoli::where('id', $id)->with('jadwal.dokter.poli')->first();
        $poli = Poli::all();
        return view('pasien.dafar-poli.edit', compact('poli', 'daftarPoli'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_jadwal' => 'required',
            'keluhan' => 'required',
        ]);

        try {
            $daftarPoli = DaftarPoli::find($id);
            $no_antrian = (int) $daftarPoli->id_jadwal === (int) $request->id_jadwal ? $daftarPoli->no_antrian : DaftarPoli::where('id_jadwal', $request->id_jadwal)->whereDate('created_at', now())->count() + 1;
//            return $no_antrian;
            $daftarPoli->update([
                'id_jadwal' => $request->id_jadwal,
                'keluhan' => $request->keluhan,
                'no_antrian' => $no_antrian,
            ]);

            return redirect()->route('daftar-poli.index')->with('success', 'Berhasil mengubah data');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah data');
        }
    }

    public function destroy(DaftarPoli $daftarPoli)
    {
        $daftarPoli->delete();

        return redirect()->back()
            ->with('success', 'Poli deleted successfully');
    }
}
