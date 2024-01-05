<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = Dokter::all();
        return view('master.dokter.index', compact('dokter'));
    }

    public function create()
    {
        $poli = Poli::all();
        return view('master.dokter.create', compact('poli'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:dokter,nama',
            'alamat' => 'required',
            'no_hp' => 'required',
            'id_poli' => 'required|numeric',
            'jadwal.*.hari' => 'required|string',
            'jadwal.*.jam_mulai' => 'required|before:jadwal.*.jam_selesai|different:jadwal.*.jam_selesai|date_format:H:i',
            'jadwal.*.jam_selesai' => 'required|after:jadwal.*.jam_mulai|different:jadwal.*.jam_mulai|date_format:H:i',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'nama' => $request->get('nama'),
                'username' => strtolower($request->get('nama')),
                'password' => bcrypt('password')
            ]);
            $user->assignRole('Dokter');
            $request->merge(['user_id' => $user->id]);

            $dokter = Dokter::create($request->all());
            $jadwal = $request->get('jadwal');
            foreach ($jadwal as $value) {
                JadwalPeriksa::create([
                    'id_dokter' => $dokter->id,
                    'hari' => $value['hari'],
                    'jam_mulai' => $value['jam_mulai'],
                    'jam_selesai' => $value['jam_selesai'],
                ]);
            }
            DB::commit();
            return redirect()->route('master.dokter.index')
                ->with('success', 'Dokter created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Dokter failed to create');
        }
    }

    public function edit($id)
    {
        $dokter = Dokter::where('id', $id)->with('jadwalPeriksa')->first();
        $poli = Poli::all();
        return view('master.dokter.edit', compact('dokter', 'poli'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:dokter,nama,' . $id . ',id',
            'alamat' => 'required',
            'no_hp' => 'required',
            'id_poli' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $dokter = Dokter::find($id);
            $dokter->update($request->all());

            $user = User::find($dokter->user_id);
            $user->update([
                'nama' => $request->get('nama'),
                'username' => strtolower($request->get('nama')),
            ]);

            $jadwal = $request->get('jadwal');
            if (!empty($jadwal)) {
                foreach ($jadwal as $value) {
                    JadwalPeriksa::updateOrCreate(
                        [
                            'id' => $value['id'],
                            'id_dokter' => $dokter->id,
                        ],
                        [
                            'hari' => $value['hari'],
                            'jam_mulai' => $value['jam_mulai'],
                            'jam_selesai' => $value['jam_selesai'],
                        ]
                    );
                }
            }
            DB::commit();
            return redirect()->route('master.dokter.index')
                ->with('success', 'Dokter updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', $e->getMessage());
        }

    }

    public function destroy($id)
    {
        $jadwal = JadwalPeriksa::where('id_dokter', $id)->get();
        foreach ($jadwal as $value) {
            $value->delete();
        }

        $dokter = Dokter::find($id);
        $dokter->delete();

        $user = User::find($dokter->user_id);
        $user->removeRole('Dokter');
        $user->delete();

        return redirect()->route('master.dokter.index')
            ->with('success', 'Dokter deleted successfully');
    }
}
