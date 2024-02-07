<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\ValidationException;

# Models
use App\Models\Menu;
use App\Models\MealCategory;
use App\Models\MealSubCategory;
use App\Models\MealSubSubCategory;
use App\Models\FoodType;

class MealSubCategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->id) {
            $MealSubCategory = MealSubCategory::find($request->id);

            if (!$MealSubCategory) {
                return response()->json(['message' => 'Meal category not found', 'status' => 404], 404);
            }

            return response()->json(['data' => $MealSubCategory, 'status' => 200], 200);
        } else {
            $mealCategories = MealSubCategory::get();
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
            'category_id' => 'required|exists:tbl_meal_categories,id',
            'name' => 'required|string|unique:tbl_meal_subcategories',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors(), 'status' => 400], 400);
        }

        $MealSubCategory = new MealSubCategory();
        $MealSubCategory->category_id = $request->input('category_id');
        $MealSubCategory->name = $request->input('name');
        $MealSubCategory->save();

        return response()->json(['message' => 'Meal category created successfully', 'data' => $MealSubCategory, 'status' => 201], 201);
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
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:tbl_meal_subcategories,id',
                'category_id' => 'required|exists:tbl_meal_categories,id',
                'name' => 'required|string|unique:tbl_meal_subcategories,name,' . $request->id,
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors(), 'status' => 400], 400);
            }

            $mealSubCategory = MealSubCategory::find($request->id);

            if (!$mealSubCategory) {
                return response()->json(['message' => 'Meal subcategory not found', 'status' => 404], 404);
            }

            $mealSubCategory->category_id = $request->input('category_id');
            $mealSubCategory->name = $request->input('name');
            // Update other fields as needed
            $mealSubCategory->save();

            return response()->json(['message' => 'Meal subcategory updated successfully', 'data' => $mealSubCategory, 'status' => 200], 200);
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
        $MealSubCategory = MealSubCategory::find($id);

        if (!$MealSubCategory) {
            return response()->json(['message' => 'Meal category not found', 'status' => 404], 404);
        }

        $MealSubCategory->delete();

        return response()->json(['message' => 'Meal category deleted successfully', 'status' => 200], 200);
    }

}
