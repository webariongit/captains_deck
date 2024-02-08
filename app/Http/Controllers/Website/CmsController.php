<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

# Models
use App\Models\CMS;
use App\Models\ContactInfo;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'nullable|string',
            ]);
            $query = CMS::query();

            if ($request->filled('title')) {
                $data = $query->where('title', $request->title)->get();
                 $data = $data[0];
            } else {
                $data = $query->get();
            }

            // if ($data->isEmpty()) {
            //     return response()->json(['message' => 'No CMS records found', 'status' => 404], 404);
            // }
            return response()->json(['message' => 'No CMS records','data' => $data, 'status' => 200], 200);
            // return response()->json($data);
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

    public function ContactInfo()
    {
        return response()->json(['message' => 'Contact information retrieved successfully', 'data' => ContactInfo::find(1)]);
    }
}
