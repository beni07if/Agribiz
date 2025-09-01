<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Termcondition;

class TermConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $term = TermCondition::all();
        return view('admin.term.index', compact('term'));
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
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'agreement'    => 'nullable|string',
            'description2' => 'nullable|string',
            'version'      => 'nullable|string',
            'date_update'  => 'nullable|date',
        ]);

        TermCondition::create($validated);

        return redirect()->route('term.index')
            ->with('success', 'Term & Condition berhasil ditambahkan');
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
        $term = TermCondition::findOrFail($id);
        return view('admin.term.edit', compact('term'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'agreement'    => 'nullable|string',
            'description2' => 'nullable|string',
            'version'      => 'nullable|string',
            'date_update'  => 'nullable|date',
        ]);

        $term = TermCondition::findOrFail($id);
        $term->update($validated);

        return redirect()->route('term.index')
            ->with('success', 'Term & Condition berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $term = TermCondition::findOrFail($id);
        $term->delete();

        return redirect()->route('term.index')
            ->with('success', 'Term & Condition berhasil dihapus');
    }
}