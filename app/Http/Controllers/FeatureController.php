<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Feature;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = Feature::all();
        return view('admin.feature.index', compact('features'));
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
            'feature_group_title' => 'required|string',
            'feature_group_desc' => 'required|string',
            'feature_group_img' => 'required|image|mimes:JPEG,JPG,PNG,jpeg,jpg,png,gif,svg,webp|max:2048',
            'feature_company_title' => 'required|string',
            'feature_company_desc' => 'required|string',
            'feature_company_img' => 'required|image|mimes:JPEG,JPG,PNG,jpeg,jpg,png,gif,svg,webp|max:2048',
            'feature_shareholder_title' => 'required|string',
            'feature_shareholder_desc' => 'required|string',
            'feature_shareholder_img' => 'required|image|mimes:JPEG,JPG,PNG,jpeg,jpg,png,gif,svg,webp|max:2048',
            'feature_sra_title' => 'required|string',
            'feature_sra_desc' => 'required|string',
            'feature_sra_img' => 'required|image|mimes:JPEG,JPG,PNG,jpeg,jpg,png,gif,svg,webp|max:2048',
        ]);

        // Handle image uploads and store paths
        $featureGroupImg = $request->file('feature_group_img')->store('img', 'public');
        $featureCompanyImg = $request->file('feature_company_img')->store('img', 'public');
        $featureShareholderImg = $request->file('feature_shareholder_img')->store('img', 'public');
        $featureSraImg = $request->file('feature_sra_img')->store('img', 'public');

        // Create new feature record with image paths
        Landingpage::create([
            'feature_group_title' => $request->input('feature_group_title'),
            'feature_group_desc' => $request->input('feature_group_desc'),
            'feature_group_img' => $featureGroupImg,
            'feature_company_title' => $request->input('feature_company_title'),
            'feature_company_desc' => $request->input('feature_company_desc'),
            'feature_company_img' => $featureCompanyImg,
            'feature_shareholder_title' => $request->input('feature_shareholder_title'),
            'feature_shareholder_desc' => $request->input('feature_shareholder_desc'),
            'feature_shareholder_img' => $featureShareholderImg,
            'feature_sra_title' => $request->input('feature_sra_title'),
            'feature_sra_desc' => $request->input('feature_sra_desc'),
            'feature_sra_img' => $featureSraImg,
        ]);

        // Redirect with success message
        return redirect()->route('feature.index')->with('success', 'Feature added successfully.');
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
            'feature_group_title' => 'required|string',
            'feature_group_desc' => 'required|string',
            'feature_group_img' => 'nullable|image|mimes:JPEG,JPG,PNG,jpeg,jpg,png,gif,svg,webp|max:2048',
            'feature_company_title' => 'required|string',
            'feature_company_desc' => 'required|string',
            'feature_company_img' => 'nullable|image|mimes:JPEG,JPG,PNG,jpeg,jpg,png,gif,svg,webp|max:2048',
            'feature_shareholder_title' => 'required|string',
            'feature_shareholder_desc' => 'required|string',
            'feature_shareholder_img' => 'nullable|image|mimes:JPEG,JPG,PNG,jpeg,jpg,png,gif,svg,webp|max:2048',
            'feature_sra_title' => 'required|string',
            'feature_sra_desc' => 'required|string',
            'feature_sra_img' => 'nullable|image|mimes:JPEG,JPG,PNG,jpeg,jpg,png,gif,svg,webp|max:2048',
            
        ]);

        // Find the existing landing page entry
        $feature = Feature::findOrFail($id);

        // Handle image uploads and store paths
        if ($request->hasFile('feature_group_img')) {
            // Delete old image if exists
            if ($feature->feature_group_img) {
                Storage::disk('public')->delete($feature->feature_group_img);
            }
            // Upload new image
            $feature->feature_group_img = $request->file('feature_group_img')->store('img', 'public');
        }
        if ($request->hasFile('feature_company_img')) {
            // Delete old image if exists
            if ($feature->feature_company_img) {
                Storage::disk('public')->delete($feature->feature_company_img);
            }
            // Upload new image
            $feature->feature_company_img = $request->file('feature_company_img')->store('img', 'public');
        }
        if ($request->hasFile('feature_shareholder_img')) {
            // Delete old image if exists
            if ($feature->feature_shareholder_img) {
                Storage::disk('public')->delete($feature->feature_shareholder_img);
            }
            // Upload new image
            $feature->feature_shareholder_img = $request->file('feature_shareholder_img')->store('img', 'public');
        }
        if ($request->hasFile('feature_sra_img')) {
            // Delete old image if exists
            if ($feature->feature_sra_img) {
                Storage::disk('public')->delete($feature->feature_sra_img);
            }
            // Upload new image
            $feature->feature_sra_img = $request->file('feature_sra_img')->store('img', 'public');
        }

        // Update landing page data
        $feature->update([
            'feature_group_title' => $request->input('feature_group_title'),
            'feature_group_desc' => $request->input('feature_group_desc'),
            'feature_group_img' => $request->input('feature_group_img'),
            'feature_company_title' => $request->input('feature_company_title'),
            'feature_company_desc' => $request->input('feature_company_desc'),
            'feature_company_img' => $request->input('feature_company_img'),
            'feature_shareholder_title' => $request->input('feature_shareholder_title'),
            'feature_shareholder_desc' => $request->input('feature_shareholder_desc'),
            'feature_shareholder_img' => $request->input('feature_shareholder_img'),
            'feature_sra_title' => $request->input('feature_sra_title'),
            'feature_sra_desc' => $request->input('feature_sra_desc'),
            'feature_sra_img' => $request->input('feature_sra_img'),
        ]);

        // Redirect with success message
        return redirect()->route('feature.index')->with('success', 'Landing page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Ambil data feature berdasarkan id
        $feature = Feature::findOrFail($id);

        // Daftar field gambar yang harus dicek
        $imageFields = [
            'feature_group_img',
            'feature_company_img',
            'feature_shareholder_img',
            'feature_sra_img',
        ];

        foreach ($imageFields as $field) {
            if (!empty($feature->$field)) {
                $imagePath = 'img/' . $feature->$field;

                // Log untuk debugging
                Log::info("Attempting to delete image at: {$imagePath}");

                if (Storage::disk('public')->exists($imagePath)) {
                    if (Storage::disk('public')->delete($imagePath)) {
                        Log::info("Successfully deleted image: {$imagePath}");
                    } else {
                        Log::error("Failed to delete image: {$imagePath}");
                    }
                } else {
                    Log::warning("Image does not exist: {$imagePath}");
                }
            }
        }

        // Hapus record feature
        $feature->delete();

        return redirect()->route('feature.index')
            ->with('success', 'Feature and associated images deleted successfully.');
    }

}