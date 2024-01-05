<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pasien::all();
        return view('master.pasien.index', compact('pasien'));
    }

    public function create()
    {
        return view('master.pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required',
            'no_ktp' => 'required|unique:pasien,no_ktp',
            'no_hp' => 'required|max:50|unique:pasien,no_hp',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'nama' => $request->get('nama'),
                'username' => strtolower($request->get('nama')),
                'password' => bcrypt('password')
            ]);
            $user->assignRole('Pasien');
            $pasien = Pasien::create([
                'nama' => $request->get('nama'),
                'alamat' => $request->get('alamat'),
                'no_ktp' => $request->get('no_ktp'),
                'no_hp' => $request->get('no_hp'),
                'user_id' => $user->id,
            ]);
            $pasien->no_rm = date('Y') . date('m') . '-' . count(Pasien::all());
            $pasien->save();

            DB::commit();
            return redirect()->route('master.pasien.index')
                ->with('success', 'Pasien created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Pasien failed to create');
        }
    }

    public function edit(Pasien $pasien)
    {
        return view('master.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required',
            'no_ktp' => 'required|unique:pasien,no_ktp,' . $pasien->id . ',id',
            'no_hp' => 'required|max:50|unique:pasien,no_hp, ' . $pasien->id . ',id'
        ]);

        $user = User::find($pasien->user_id);
        $user->nama = $request->get('nama');
        $user->username = strtolower($request->get('nama'));
        $user->password = bcrypt($request->get('no_ktp'));
        $user->save();

        $pasien->update($request->all());

        return redirect()->route('master.pasien.index')
            ->with('success', 'Pasien updated successfully');
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $pasien = Pasien::find($id);
            $pasien->delete();

            $user = User::find($pasien->user_id);
            $user->removeRole('Pasien');
            $user->delete();

            DB::commit();
            return redirect()->back()
                ->with('success', 'Pasien deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Pasien failed to delete');
        }
    }
}
