<?php

namespace App\Http\Controllers;

use App\Models\SchoolProfile;
use Illuminate\Http\Request;

class SchoolProfileController extends Controller
{
    /**
     * ADMIN: Tampilkan halaman edit profil sekolah
     */
    public function index()
    {
        $profile = SchoolProfile::first();
        return view('admin.school_profile.index', compact('profile'));
    }

    /**
     * ADMIN: Update profil sekolah
     */
    public function update(Request $request, $id)
    {
        $profile = SchoolProfile::findOrFail($id);

        $validated = $request->validate([
            'nama_sekolah'   => 'required|string|max:255',
            'kepala_sekolah' => 'required|string|max:255',
            'npsn'           => 'required|string|max:50',
            'alamat'         => 'required|string',
            'kontak'         => 'required|string|max:50',
            'visi_misi'      => 'nullable|string',
            'tahun_berdiri'  => 'nullable|integer',
            'deskripsi'      => 'nullable|string',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'logo'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload foto kepala sekolah
        if ($request->hasFile('foto')) {
            $fotoName = time().'_foto.'.$request->foto->extension();
            $request->foto->move(public_path('uploads/school'), $fotoName);
            $validated['foto'] = 'uploads/school/'.$fotoName;
        }

        // Upload logo
        if ($request->hasFile('logo')) {
            $logoName = time().'_logo.'.$request->logo->extension();
            $request->logo->move(public_path('uploads/school'), $logoName);
            $validated['logo'] = 'uploads/school/'.$logoName;
        }

        $profile->update($validated);

        return redirect()->route('profile.index')->with('success', 'School profile updated successfully!');
    }

    /**
     * USER: Tampilkan profil sekolah di frontend
     */
    public function show()
    {
        $profile = SchoolProfile::first();
        return view('school_profile.index', compact('profile'));
    }

}
