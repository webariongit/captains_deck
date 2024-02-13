<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $request->validate([
                'media_type' => 'nullable|string|in:image,video',
                'orderBy' => 'nullable|in:asc,desc', 
                'orderByColumn' => 'nullable|string',  
                'per_page' => 'nullable|integer|min:1',  
            ]);
    
            $per_page = $request->input(10);  
            $orderByColumn = $request->input('orderByColumn', 'created_at');
            $orderBy = $request->input('orderBy', 'desc');
    
            $query = Gallery::query();
            $query->whereNull('event_id'); 
            $query->whereNotNull('media_types');
            
            if ($request->filled('media_type')) {
                $query->where('media_types', $request->media_type);
            }
    
            $galleries = $query->orderBy($orderByColumn, $orderBy)->paginate(10);
    
            return response()->json(['base_url' => url('/'), 'data' => $galleries , 'status' => 200], 200);
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
