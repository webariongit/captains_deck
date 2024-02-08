<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

# Models
use App\Models\FoodType;

class FoodTypeController extends Controller
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

            $query = FoodType::query();

            if (isset($request->id)) {
                $foodTypeDetails = $query
                    ->where('id', $request->id)
                    ->first();

                return response()->json([
                    'base_url' => url('/'),
                    'response' => $foodTypeDetails,
                    'status' => 200
                ], 200);
            } else {
                $sort = is_null($request->sort) ? 'DESC' : $request->sort;
                $sortBy = is_null($request->sortBy) ? 'created_at' : $request->sortBy;

                if ($request->search) {
                    $searchTerm = $request->search;
                    $foodTypeDetails = $query
                        ->where('food_type_name', 'LIKE', "%" . $searchTerm . "%")
                        ->orderBy($sortBy, $sort)
                        ->paginate(10);
                    return response()->json([
                        'base_url' => url('/'),
                        'response' => $foodTypeDetails,
                        'status' => 200
                    ], 200);
                } else {
                    $foodTypeDetails = $query
                        ->orderBy($sortBy, $sort)
                        ->paginate(10);

                    return response()->json([
                        'base_url' => url('/'),
                        'response' => $foodTypeDetails,
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
                'food_type_name' => 'required|string',
                'status' => 'required|string|in:1,0',
            ]);

            $foodType = FoodType::create([
                'food_type_name' => $request->food_type_name,
                'status' => $request->status,
            ]);

            return response()->json(['message' => 'FoodType record created successfully', 'data' => $foodType, 'status' => 201], 201);
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
                'id' => 'required|exists:tbl_food_types,id',
                'food_type_name' => 'required|string',
                'status' => 'required|string|in:1,0',
            ]);

            $foodType = FoodType::find($request->id);

            if (!$foodType) {
                return response()->json(['message' => 'FoodType record not found', 'status' => 404], 404);
            }

            $foodType->update([
                'food_type_name' => $request->food_type_name,
                'status' => $request->status,
            ]);

            return response()->json(['message' => 'FoodType record updated successfully', 'data' => $foodType, 'status' => 200], 200);
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
            $foodType = FoodType::find($id);
            
            if (!$foodType) {
                return response()->json(['message' => 'FoodType not found', 'status' => 404], 404);
            }
    
            $foodType->delete();
    
            return response()->json(['message' => 'FoodType deleted successfully', 'status' => 200], 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Failed to delete FoodType', 'status' => 500], 500);
        }
    }
    
}
