<?php

namespace App\Http\Controllers;

use App\Models\Sra;
use Illuminate\Http\Request;
use App\Exports\SraExport;
use App\Imports\SraImport;
use Maatwebsite\Excel\Facades\Excel;

class SraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sras = Sra::all(); // bisa diganti pagination jika datanya besar
        return view('admin.data.sra.index', compact('sras'));
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function export()
    {
        return Excel::download(new SraExport, 'sra.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new SraImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Import gagal: ' . $e->getMessage());
        }
    }
}