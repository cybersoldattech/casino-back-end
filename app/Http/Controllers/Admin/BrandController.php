<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all(); // Récupère toutes les marques

        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        return view('brands.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'rating' => 'nullable|integer|min:0|max:5',
        ]);

        if ($request->hasFile('brand_image')) {
            $imagePath = $request->file('brand_image')->store('brand_images', 'public');
            $validatedData['brand_image'] =  url('/storage/' . $imagePath);;
        }

        Brand::create($validatedData);

        return redirect()->route('admin.brands.index')->with('success', 'La marque a été ajoutée avec succès.');
    }

    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'rating' => 'nullable|integer|min:0|max:5',
        ]);


        if ($request->hasFile('brand_image')) {
            $imagePath = $request->file('brand_image')->store('brand_images', 'public');
            $validatedData['brand_image'] =  url('/storage/' . $imagePath);
        }

        $brand->update($validatedData);

        return redirect()->route('admin.brands.index')->with('success', 'La marque a été mise à jour avec succès.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'La marque a été supprimée avec succès.');
    }
}
