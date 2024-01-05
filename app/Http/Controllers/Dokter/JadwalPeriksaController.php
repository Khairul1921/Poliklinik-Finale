<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $id = \Auth::user()->dokter->id;
        $jadwal = JadwalPeriksa::where('id_dokter', $id)->get();
        return view('dokter.jadwal-periksa.index', compact('jadwal'));
    }

    public function create()
    {
        return view('dokter.jadwal-periksa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal.*.hari' => 'required|string',
            'jadwal.*.jam_mulai' => 'required|before:jadwal.*.jam_selesai|different:jadwal.*.jam_selesai|date_format:H:i',
            'jadwal.*.jam_selesai' => 'required|after:jadwal.*.jam_mulai|different:jadwal.*.jam_mulai|date_format:H:i',
        ]);

        try {
            foreach ($request->get('jadwal') as $data) {
                JadwalPeriksa::create([
                    'id_dokter' => \Auth::user()->dokter->id,
                    'hari' => $data['hari'],
                    'jam_mulai' => $data['jam_mulai'],
                    'jam_selesai' => $data['jam_selesai'],
                ]);
            }

            return redirect()->route('jadwal-periksa.index')->with('success', 'Berhasil menambahkan jadwal periksa');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $jadwal = JadwalPeriksa::where('id', $id)->first();
        return view('dokter.jadwal-periksa.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalPeriksa::find($id);
        $jadwal->update([
            'hari' => $request->get('hari'),
            'jam_mulai' => $request->get('jam_mulai'),
            'jam_selesai' => $request->get('jam_selesai'),
        ]);

        return redirect()->route('jadwal-periksa.index')->with('success', 'Berhasil mengubah jadwal periksa');
    }

    public function destroy($id)
    {
        $jadwal = JadwalPeriksa::find($id);
        $jadwal->delete();

        return redirect()->route('jadwal-periksa.index')->with('success', 'Berhasil menghapus jadwal periksa');
    }
}
