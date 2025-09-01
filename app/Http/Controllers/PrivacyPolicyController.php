<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\PrivacyPolicy;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $policies = PrivacyPolicy::all();
        return view('admin.privacyPolicy.index', compact('policies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data dulu biar aman
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Simpan data baru
        PrivacyPolicy::create($validated);

        return redirect()->route('policy.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $policy = PrivacyPolicy::findOrFail($id);
        return view('admin.privacyPolicy.edit', compact('term'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input sesuai field yang ada
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Cari data berdasarkan id, kalau tidak ada akan throw 404
        $policy = PrivacyPolicy::findOrFail($id);

        // Update hanya dengan data yang sudah divalidasi
        $policy->update($validated);

        return redirect()->route('policy.index')
            ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari data berdasarkan id, kalau tidak ada akan otomatis 404
        $policy = PrivacyPolicy::findOrFail($id);

        // Hapus data
        $policy->delete();

        return redirect()->route('policy.index')
            ->with('success', 'Data berhasil dihapus');
    }

}