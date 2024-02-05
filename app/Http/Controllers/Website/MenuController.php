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
            
            $query = Menu::query();
            $query->leftJoin('meal_categorys', 'menus.category_id', '=', 'meal_categorys.id');
            $query->leftJoin('meal_subcategorys', 'menus.subcategory_id', '=', 'meal_subcategorys.id');
            $query->leftJoin('meal_subsubcategorys', 'menus.subsubcategory_id', '=', 'meal_subsubcategorys.id');
            $query->select(
                'meal_categorys.name as category_name',
                'meal_subcategorys.name as subcategory_name',
                'meal_subsubcategorys.name as subsubcategory_name',
                'menus.food_type_id',
                'menus.meal_image',
                'menus.meal_qty',
                'menus.meal_amount',
                'menus.meal_description',
            );

            $menus = $query->get();

            foreach ($menus as $key => $menu) {
                $foodType = FoodType::whereIn('id', explode(',', $menu->food_type_id))->get();
        
                $menus[$key]->foodType = $foodType;
            }

            return response()->json($menus);
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
