<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $countryCode = Cache::remember('user_country_' . $request->ip(), 3600, function () use ($request) {
            $cfCountryHeader = $request->header('CF-IPCountry');
            return $cfCountryHeader ?: 'Unknown';
        });
        $brands = ($countryCode && $countryCode !== 'Unknown') ? Brand::where('country_code', $countryCode)->orderBy('rating', 'desc')->get()
            : Brand::orderBy('rating', 'desc')->get();
        return response()->json($brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_name' => 'bail|required|string',
            'brand_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'bail|integer|min:0|max:5',
            'description' => 'min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $imagePath = $request->file('brand_image')->store('brand_images', 'public');
        $request->brand_image = url('/storage/' . $imagePath);

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_image = $request->brand_image;
        $brand->countryCode = $request->countryCode;
        $brand->rating = $request->rating ?? 0;
        $brand->save();

        return response()->json($brand, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json(['error' => 'Brand not found'], 404);
        }

        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json(['error' => 'Brand not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'brand_name' => 'bail|string',
            'brand_image' => 'bail|nullable|string',
            'rating' => 'bail|integer|min:0|max:5',
            'description' => 'min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $imagePath = $request->file('brand_image')->store('brand_images', 'public');
        $brand->brand_image = url('/storage/' . $imagePath);
        $brand->update($request->all());
        return response()->json($brand, 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json(['error' => 'Brand not found'], 404);
        }

        $brand->delete();

        return response()->json(['message' => 'Brand deleted']);
    }
}
