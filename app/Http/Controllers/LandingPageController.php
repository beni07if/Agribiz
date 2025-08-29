<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Landingpage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $landingPages = Landingpage::all();
        return view('admin.landingPage.index', compact('landingPages'));
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
        // Validate the request data
        $request->validate([
            'tagline' => 'required|string',
            'title_about_agribiz' => 'required|string',
            'desc_about_agribiz' => 'required|string',
            'image_about_agribiz' => 'required|image|mimes:JPEG,JPG,PNG,jpeg,jpg,png,gif,svg,webp|max:2048',
            'key_main_feature_title' => 'required|string',
            'key_main_feature_desc' => 'required|string',
            'key_feature_group_title' => 'required|string',
            'key_feature_group_desc' => 'required|string',
            'key_feature_company_title' => 'required|string',
            'key_feature_company_desc' => 'required|string',
            'key_feature_shareholder_title' => 'required|string',
            'key_feature_shareholder_desc' => 'required|string',
            'key_feature_sra_title' => 'required|string',
            'key_feature_sra_desc' => 'required|string',
        ]);

        // Handle image uploads and store paths
        $imageAboutAgribiz = $request->file('image_about_agribiz')->store('img', 'public');

        // Create new landing page record with image paths
        Landingpage::create([
            'tagline' => $request->input('tagline'),
            'title_about_agribiz' => $request->input('title_about_agribiz'),
            'desc_about_agribiz' => $request->input('desc_about_agribiz'),
            'image_about_agribiz' => $imageAboutAgribiz,
            'key_main_feature_title' => $request->input('key_main_feature_title'),
            'key_main_feature_desc' => $request->input('key_main_feature_desc'),
            'key_feature_group_title' => $request->input('key_feature_group_title'),
            'key_feature_group_desc' => $request->input('key_feature_group_desc'),
            'key_feature_company_title' => $request->input('key_feature_company_title'),
            'key_feature_company_desc' => $request->input('key_feature_company_desc'),
            'key_feature_shareholder_title' => $request->input('key_feature_shareholder_title'),
            'key_feature_shareholder_desc' => $request->input('key_feature_shareholder_desc'),
            'key_feature_sra_title' => $request->input('key_feature_sra_title'),
            'key_feature_sra_desc' => $request->input('key_feature_sra_desc'),
        ]);

        // Redirect with success message
        return redirect()->route('landing-page.index')->with('success', 'Landing page added successfully.');
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
        // Validate the request data
        $request->validate([
            'tagline' => 'required|string',
            'title_about_agribiz' => 'required|string',
            'desc_about_agribiz' => 'required|string',
            'image_about_agribiz' => 'nullable|image|mimes:JPEG,JPG,PNG,jpeg,jpg,png,gif,svg,webp|max:2048',
            'key_main_feature_title' => 'required|string',
            'key_main_feature_desc' => 'required|string',
            'key_feature_group_title' => 'required|string',
            'key_feature_group_desc' => 'required|string',
            'key_feature_company_title' => 'required|string',
            'key_feature_company_desc' => 'required|string',
            'key_feature_shareholder_title' => 'required|string',
            'key_feature_shareholder_desc' => 'required|string',
            'key_feature_sra_title' => 'required|string',
            'key_feature_sra_desc' => 'required|string',
        ]);

        // Find the existing landing page entry
        $landingPage = Landingpage::findOrFail($id);

        // Handle image uploads and store paths
        if ($request->hasFile('image_about_agribiz')) {
            // Delete old image if exists
            if ($landingPage->image_about_agribiz) {
                Storage::disk('public')->delete($landingPage->image_about_agribiz);
            }
            // Upload new image
            $landingPage->image_about_agribiz = $request->file('image_about_agribiz')->store('img', 'public');
        }

        // Update landing page data
        $landingPage->update([
            'tagline' => $request->input('tagline'),
            'title_about_agribiz' => $request->input('title_about_agribiz'),
            'desc_about_agribiz' => $request->input('desc_about_agribiz'),
            'key_main_feature_title' => $request->input('key_main_feature_title'),
            'key_main_feature_desc' => $request->input('key_main_feature_desc'),
            'key_feature_group_title' => $request->input('key_feature_group_title'),
            'key_feature_group_desc' => $request->input('key_feature_group_desc'),
            'key_feature_company_title' => $request->input('key_feature_company_title'),
            'key_feature_company_desc' => $request->input('key_feature_company_desc'),
            'key_feature_shareholder_title' => $request->input('key_feature_shareholder_title'),
            'key_feature_shareholder_desc' => $request->input('key_feature_shareholder_desc'),
            'key_feature_sra_title' => $request->input('key_feature_sra_title'),
            'key_feature_sra_desc' => $request->input('key_feature_sra_desc'),
        ]);

        // Redirect with success message
        return redirect()->route('landing-page.index')->with('success', 'Landing page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Landingpage $landingPage)
    {
        // Get the image path from the database
        $imagePath = 'img/' . $landingPage->image_about_agribiz;

        // Log the path for debugging
        Log::info('Attempting to delete image at: ' . $imagePath);

        // Check if the image exists in storage
        if ($landingPage->image_about_agribiz && Storage::exists($imagePath)) {
            // Attempt to delete the image file
            if (Storage::delete($imagePath)) {
                Log::info('Successfully deleted image: ' . $imagePath);
            } else {
                Log::error('Failed to delete image: ' . $imagePath);
            }
        } else {
            Log::warning('Image does not exist: ' . $imagePath);
        }

        // Delete the landing page record from the database
        $landingPage->delete();

        return redirect()->route('landing-page.index')->with('success', 'Landing page and associated image deleted successfully.');
    }
}