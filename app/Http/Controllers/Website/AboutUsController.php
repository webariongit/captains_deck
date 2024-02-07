<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

# Models
use App\Models\SliderBanner;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\Employes;
use App\Models\CMS;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = SliderBanner::query();
            
            $data[] = [
                'key_name' => 'Banner',
                'key_data' => SliderBanner::where('type', 'banner')->get(),
            ];
            
            $data[] = [
                'key_name' => 'About',
                'key_data' => SliderBanner::where('type', 'About')->get(),
            ];
            
            $data[] = [
                'key_name' => 'About_CMS',
                'key_data' => CMS::where('title', 'About')->get(),
            ];
            
            $data[] = [
                'key_name' => 'employes',
                'key_data' => Employes::get(),
            ];
    
            return response()->json([ 'base_url' =>  url('/'),'data' => $data , 'status' => 200],200);

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
