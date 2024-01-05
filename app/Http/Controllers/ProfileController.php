<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\User;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $poli = Poli::all();
        return view('profile.edit', [
            'user' => $request->user(),
            'poli' => $poli
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $request->user()->fill($request->validated());
            $request->user()->save();
            $dokter = Dokter::where('user_id', auth()->user()->id)->first();
            if ($dokter) {
                $dokter->nama = $request->nama;
                $dokter->alamat = $request->alamat;
                $dokter->no_hp = $request->no_hp;
                $dokter->id_poli = $request->poli;
                $dokter->save();
            }
            DB::commit();
            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::route('profile.edit')->with('status', 'failed');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
