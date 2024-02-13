<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

# Models
use App\Models\CMS;

class CmsController extends Controller
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

            $query = CMS::query();

            if (isset($request->id)) {
                $cmsDetails = $query
                    ->where('id', $request->id)
                    ->first();

                return response()->json([
                    'base_url' => url('/'),
                    'response' => $cmsDetails,
                    'status' => 200
                ], 200);
            } else {
                $sort = is_null($request->sort) ? 'DESC' : $request->sort;
                $sortBy = is_null($request->sortBy) ? 'created_at' : $request->sortBy;

                if ($request->search) {
                    $searchTerm = $request->search;
                    $cmsDetails = $query
                        ->where('title', 'LIKE', "%" . $searchTerm . "%")
                        ->orderBy($sortBy, $sort)
                        ->paginate(10);
                        return view('admin.about', ['url' => url('/'), 'datas' => $cmsDetails]);
                    return response()->json([
                        'base_url' => url('/'),
                        'response' => $cmsDetails,
                        'status' => 200
                    ], 200);
                } else {
                    $cmsDetails = $query
                        ->orderBy($sortBy, $sort)
                        ->paginate(10);

                    return response()->json([
                        'base_url' => url('/'),
                        'response' => $cmsDetails,
                        'status' => 200
                    ], 200);
                }
            }
            
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
        }
    }

    // public function index(Request $request)
    // {
    //     try {
    //         $this->validate($request, [
    //             'title' => 'nullable|string',
    //         ]);
    //         $query = CMS::query();

    //         if ($request->filled('title')) {
    //             $data = $query->where('title', $request->title)->first();
    //         } else {
    //             $data = $query->get();
    //         }

    //         if ($data->isEmpty()) {
    //             return response()->json(['message' => 'No CMS records found', 'status' => 404], 404);
    //         }

    //         return response()->json($data);
    //     } catch (ValidationException $exception) {
    //         $errors = $exception->errors();
    //         return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
    //     }
    // }



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
            ]);

            $cms = CMS::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return response()->json(['message' => 'CMS record created successfully', 'data' => $cms, 'status' => 201], 201);
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
                'id' => 'required',
                // 'title' => 'required|string',
                'description' => 'required|string',
            ]);

            $cms = CMS::find($request->id);

            if (!$cms) {
                return response()->json(['message' => 'CMS record not found', 'status' => 404], 404);
            }

            $cms->update([
                'description' => $request->description,
            ]);

            return redirect()->route('admin.events.index')->with('success', 'CMS record updated successfully.');
            return response()->json(['message' => 'CMS record updated successfully', 'data' => $cms, 'status' => 200], 200);
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

