<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        $poli = Poli::all();
        return view('master.poli.index', compact('poli'));
    }

    public function create()
    {
        return view('master.poli.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:25',
            'keterangan' => 'required|string',
        ]);

        Poli::create($request->all());

        return redirect()->route('master.poli.index')
            ->with('success', 'Poli created successfully.');
    }

    public function edit($id)
    {
        $poli = Poli::find($id);
        return view('master.poli.edit', compact('poli'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:25',
            'keterangan' => 'required|string',
        ]);

        $poli = Poli::find($id);
        $poli->update($request->all());

        return redirect()->route('master.poli.index')
            ->with('success', 'Poli updated successfully');
    }

    public function destroy($id)
    {
        $poli = Poli::find($id);
        $poli->delete();

        return redirect()->route('master.poli.index')
            ->with('success', 'Poli deleted successfully');
    }
}
