<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.faq.index', compact('faqs'));
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
        $request->validate([
            'category' => 'required|string|max:255',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        Faq::create($request->all());

        return redirect()->route('faq.index')->with('success', 'FAQ added successfully.');
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
        $request->validate([
            'category' => 'required|string|max:255',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq->update($request->all());

        return redirect()->route('faq.index')->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Ambil data FAQ berdasarkan id
        $faq = Faq::findOrFail($id);

        // Hapus record
        $faq->delete();

        return redirect()->route('faq.index')
            ->with('success', 'FAQ deleted successfully.');
    }

}