<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

# Models
// use Menu;
use App\Models\Menu;
use App\Models\MealCategory;
use App\Models\MealSubCategory;
use App\Models\MealSubSubCategory;
use App\Models\FoodType;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->id) {
                $mealCategory = MealCategory::find($request->id);
    
                if (!$mealCategory) {
                    return response()->json(['message' => 'Meal category not found', 'status' => 404], 404);
                }
    
                $result = [];
                $result[$mealCategory->name] = [];
    
                $subCategories = MealSubCategory::where('category_id', $mealCategory->id)->get();
    
                foreach ($subCategories as $subcategory) {
                    $result[$mealCategory->name][$subcategory->name] = [];
    
                    $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();
    
                    foreach ($subSubCategories as $subsubcategory) {
                        $result[$mealCategory->name][$subcategory->name][$subsubcategory->name] = Menu::where('subsubcategory_id', $subsubcategory->id)->get();
                    }
                }
            } else {
                $mealCategories = MealCategory::get();
    
                if (!$mealCategories) {
                    return response()->json(['message' => 'Meal categories not found', 'status' => 404], 404);
                }
    
                $result = [];
    
                foreach ($mealCategories as $category) {
                    $result[$category->name] = [];
    
                    $subCategories = MealSubCategory::where('category_id', $category->id)->get();
    
                    foreach ($subCategories as $subcategory) {
                        $result[$category->name][$subcategory->name] = [];
    
                        $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();
    
                        foreach ($subSubCategories as $subsubcategory) {
                            $result[$category->name][$subcategory->name][$subsubcategory->name] = Menu::where('subsubcategory_id', $subsubcategory->id)->get();
                        }
                    }
                }
            }
    
            return response()->json(['base_url' => url('/'), 'data' => $result, 'status' => 200], 200);
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
