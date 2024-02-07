<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

# Models
use App\Models\Menu;
use App\Models\MealCategory;
use App\Models\MealSubCategory;
use App\Models\MealSubSubCategory;
use App\Models\FoodType;

class MealCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->id) {
            $mealCategory = MealCategory::find($request->id);

            if (!$mealCategory) {
                return response()->json(['message' => 'Meal category not found', 'status' => 404], 404);
            }

            return response()->json(['data' => $mealCategory, 'status' => 200], 200);
        } else {
            $mealCategories = MealCategory::get();
            return response()->json(['data' => $mealCategories, 'status' => 200], 200);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:tbl_meal_categories',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors(), 'status' => 400], 400);
        }

        $mealCategory = new MealCategory();
        $mealCategory->name = $request->input('name');
        $mealCategory->save();

        return response()->json(['message' => 'Meal category created successfully', 'data' => $mealCategory, 'status' => 201], 201);
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
        $id = $request->id; // Move the $id assignment here

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required|string|unique:tbl_meal_categories,name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors(), 'status' => 400], 400);
        }

        $mealCategory = MealCategory::find($id);

        if (!$mealCategory) {
            return response()->json(['message' => 'Meal category not found', 'status' => 404], 404);
        }

        $mealCategory->name = $request->input('name');
        // Update other fields as needed
        $mealCategory->save();

        return response()->json(['message' => 'Meal category updated successfully', 'data' => $mealCategory, 'status' => 200], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mealCategory = MealCategory::find($id);

        if (!$mealCategory) {
            return response()->json(['message' => 'Meal category not found', 'status' => 404], 404);
        }

        $mealCategory->delete();

        return response()->json(['message' => 'Meal category deleted successfully', 'status' => 200], 200);
    }

}
