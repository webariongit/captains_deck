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
                'media_type' => 'nullable|string|in:image,videos',
                'order_direction' => 'nullable|in:asc,desc', 
                'page' => 'nullable', 
            ]);
            $page = $request->page ?? 10;
            $orderByColumn = 'created_at';
            $orderByDirection = $request->order_direction ?? 'desc';

            $query = Gallery::query();
            if ($request->media_type) {
                $query->where('media_types', $request->media_type);
            }

            $galleries = $query->orderBy($orderByColumn, $orderByDirection)->paginate($page);

            return response()->json(['url' => url('/'), 'data' => $galleries], 201);
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
