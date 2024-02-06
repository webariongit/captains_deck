<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

# Models
use App\Models\SliderBanner;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = SliderBanner::query();
            $data['Banner'] = $query->where('type', 'banner')->get();

            $query = SliderBanner::query();
            $data['content'] = $query->where('type', 'content')->get();

            $query = SliderBanner::query();
            $data['contentWithImage'] = $query->where('type', 'contentWithImage')->get();

            $query = SliderBanner::query();
            $data['offer'] = $query->where('type', 'offer')->get();
    
            return response()->json(['data' => $data]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Slider banner not found', 'status' => 404], 404);
        } catch (ValidationException $exception) {
            $errors = $exception->errors();
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
}
