<?php

namespace App\Http\Controllers\Admin\SliderAndBanners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

# Models
use App\Models\SliderBanner;

class AvailableOffersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id' => 'nullable|integer|gt:0',
                'sort' => 'nullable|in:DESC,ASC',
                'search' => 'nullable|string',
                'sortBy' => 'nullable|in:created_at,id',
                'paginate' => 'nullable|boolean',
            ]);
    
            $query = SliderBanner::query();
    
            if (isset($request->id)) {
                $sliderBannerDetails = $query
                    ->where('id', $request->id)
                    ->first();
    
                return response()->json([
                    'base_url' => url('/'),
                    'response' => $sliderBannerDetails,
                    'status' => 200
                ], 200);
            } else {
                $sort = is_null($request->sort) ? 'DESC' : $request->sort;
                $sortBy = is_null($request->sortBy) ? 'created_at' : $request->sortBy;
    
                if ($request->search) {
                    $searchTerm = $request->search;
                    $sliderBannerDetails = $query
                        ->where('type', 'available_offers')
                        ->where('title', 'LIKE', "%" . $searchTerm . "%")
                        ->orderBy($sortBy, $sort)
                        ->paginate(10);
                    return response()->json([
                        'base_url' => url('/'),
                        'response' => $sliderBannerDetails,
                        'status' => 200
                    ], 200);
                } else {
                    $sliderBannerDetails = $query
                        ->where('type', 'available_offers')
                        ->orderBy($sortBy, $sort)
                        ->paginate(10);
    
                    return response()->json([
                        'base_url' => url('/'),
                        'response' => $sliderBannerDetails,
                        'status' => 200
                    ], 200);
                }
            }
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
        }
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
        try {
            $this->validate($request, [
                'title' => 'required|string',
                'description' => 'required|string',
                'header' => 'required|string',
                'media_types' => 'required|string',
                'media' => 'required|string',
                'status' => 'required|string|in:1,0',
            ]);

            $SliderBanner = new SliderBanner();
            $SliderBanner->type = 'available_offers';
            $SliderBanner->banner_place = '.';
            $SliderBanner->title = $request->title;
            $SliderBanner->header = $request->header;
            $SliderBanner->description = $request->description;
            $SliderBanner->media_types = $request->media_types;
            $SliderBanner->media = $request->media;
            $SliderBanner->status = $request->status;
            $SliderBanner->save();

            return response()->json(['message' => 'Blog created successfully', 'data' => $SliderBanner, 'status' => 201], 201);
        } catch (ValidationException $exception) {
            $errors = $exception->errors();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
        }
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
    public function update(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required|exists:tbl_banners,id',
                'title' => 'required|string',
                'description' => 'required|string',
                'header' => 'required|string',
                'media_types' => 'required|string',
                'media' => 'required|string',
                'status' => 'required|string|in:1,0',
            ]);
            
            $id = $request->id;
            $SliderBanner = SliderBanner::find($id);

            if (!$SliderBanner) {
                return response()->json(['message' => 'Blog not found', 'status' => 404], 404);
            }

            $SliderBanner->type = 'available_offers';
            $SliderBanner->title = $request->title;
            $SliderBanner->header = $request->header;
            $SliderBanner->description = $request->description;
            $SliderBanner->media_types = $request->media_types;
            $SliderBanner->media = $request->media;
            $SliderBanner->status = $request->status;
            $SliderBanner->save();

            return response()->json(['message' => 'Blog updated successfully', 'data' => $SliderBanner, 'status' => 200], 200);
        } catch (ValidationException $exception) {
            $errors = $exception->errors();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $sliderBanner = SliderBanner::findOrFail($id);
            $sliderBanner->delete();

            return response()->json(['message' => 'Blog deleted successfully', 'status' => 200], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Blog not found', 'status' => 404], 404);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Failed to delete blog', 'status' => 500], 500);
        }
    }
}
