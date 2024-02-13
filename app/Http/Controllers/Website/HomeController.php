<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

# Models
use App\Models\SliderBanner;
use App\Models\Gallery;
use App\Models\Testimonial;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     try {
    //         $query = SliderBanner::query();
            
    //         $data[] = [
    //             'key_name' => 'Banner',
    //             'key_data' => SliderBanner::where('type', 'banner')->get(),
    //         ];
            
    //         $data[] = [
    //             'key_name' => 'Content',
    //             'key_data' => SliderBanner::where('type', 'content')->get(),
    //         ];
            
    //         $data[] = [
    //             'key_name' => 'blogs',
    //             'key_data' => SliderBanner::where('type', 'blogs')->get(),
    //         ];
            
    //         $data[] = [
    //             'key_name' => 'available_offers',
    //             'key_data' => SliderBanner::where('type', 'available_offers')->get(),
    //         ];
            
    //         $data[] = [
    //             'key_name' => 'Gallery',
    //             'key_data' => Gallery::where('event_id', null)->get(),
    //         ];
            
    //         $data[] = [
    //             'key_name' => 'Testimonials',
    //             'key_data' => Testimonial::all(),
    //         ];

    //         // $data[]['base_url'] =  url('/');
    
    //         return response()->json([ 'base_url' =>  url('/'),'data' => $data , 'status' => 404],200);

    //     } catch (ModelNotFoundException $exception) {
    //         return response()->json(['message' => 'Slider banner not found', 'status' => 404], 404);
    //     } catch (ValidationException $exception) {
    //         $errors = $exception->errors();
    //         return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
    //     }
    // }

    public function index(Request $request)
    {
        try {
            $query = SliderBanner::query();
            
            $data[] = [
                'key_name' => 'Banner',
                'key_data' => SliderBanner::where('type', 'banner')->get(),
            ];
            
            $data[] = [
                'key_name' => 'Content',
                'key_data' => SliderBanner::where('type', 'content')->get(),
            ];
            
            $data[] = [
                'key_name' => 'blogs',
                'key_data' => SliderBanner::where('type', 'blogs')->get(),
            ];
            
            $data[] = [
                'key_name' => 'available_offers',
                'key_data' => SliderBanner::where('type', 'available_offers')->get(),
            ];
            
            $data[] = [
                'key_name' => 'Gallery',
                'key_data' => Gallery::where('event_id', null)->take(20)->get(),
            ];
            
            $data[] = [
                'key_name' => 'Testimonials',
                'key_data' => Testimonial::all(),
            ];

            // $data[]['base_url'] =  url('/');
    
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
