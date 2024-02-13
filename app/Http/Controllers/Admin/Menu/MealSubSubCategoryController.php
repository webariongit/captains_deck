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

class MealSubSubCategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->id) {
            $MealSubSubCategory = MealSubSubCategory::find($request->id);

            if (!$MealSubSubCategory) {
                return response()->json(['message' => 'Meal category not found', 'status' => 404], 404);
            }

            return view('admin.meal-subsubcategory', ['url' => url('/'), 'datas' => $MealSubSubCategory]);
        } else {
            $mealCategories = MealSubSubCategory::get();
            return view('admin.meal-subsubcategory', ['url' => url('/'), 'datas' => $mealCategories]);
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
            'subcategory_id' => 'required|exists:tbl_meal_subcategories,id',
            'name' => 'required|string|unique:tbl_meal_subsubcategories',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors(), 'status' => 400], 400);
        }

        $MealSubSubCategory = new MealSubSubCategory();
        $MealSubSubCategory->subcategory_id = $request->input('subcategory_id');
        $MealSubSubCategory->name = $request->input('name');
        $MealSubSubCategory->save();

        return response()->json(['message' => 'Meal category created successfully', 'data' => $MealSubSubCategory, 'status' => 201], 201);
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
                'id' => 'required|exists:tbl_meal_subsubcategories,id',
                'subcategory_id' => 'required|exists:tbl_meal_subcategories,id',
                'name' => 'required|string|unique:tbl_meal_subsubcategories,name,' . $request->id,
            ]);
    
            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors(), 'status' => 400], 400);
            }
    
            $mealSubSubCategory = MealSubSubCategory::find($request->id);
    
            if (!$mealSubSubCategory) {
                return response()->json(['message' => 'Meal subsubcategory not found', 'status' => 404], 404);
            }
    
            $mealSubSubCategory->subcategory_id = $request->input('subcategory_id');
            $mealSubSubCategory->name = $request->input('name');
            $mealSubSubCategory->save();
    
            return response()->json(['message' => 'Meal subsubcategory updated successfully', 'data' => $mealSubSubCategory, 'status' => 200], 200);
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
        $MealSubSubCategory = MealSubSubCategory::find($id);

        if (!$MealSubSubCategory) {
            return response()->json(['message' => 'Meal category not found', 'status' => 404], 404);
        }

        $MealSubSubCategory->delete();

        return response()->json(['message' => 'Meal category deleted successfully', 'status' => 200], 200);
    }

}
