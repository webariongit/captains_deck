<?php

namespace App\Http\Controllers\Admin\SliderAndBanners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
# Models
use App\Models\SliderBanner;

class AvailableOffersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
                'status' => 'required|string|in:active,inactive',
            ]);

            $SliderBanner = new SliderBanner();
            $SliderBanner->type = 'blogs';
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
                'id' => 'required|exists:slider_banners,id',
                'title' => 'required|string',
                'description' => 'required|string',
                'header' => 'required|string',
                'media_types' => 'required|string',
                'media' => 'required|string',
                'status' => 'required|string|in:active,inactive',
            ]);
            
            $id = $request->id;
            $SliderBanner = SliderBanner::find($id);

            if (!$SliderBanner) {
                return response()->json(['message' => 'Blog not found', 'status' => 404], 404);
            }

            $SliderBanner->type = 'blogs';
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
    public function destroy(string $id)
    {
        //
    }
}
