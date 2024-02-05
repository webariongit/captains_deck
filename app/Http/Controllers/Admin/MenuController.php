<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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
                'menus.id',
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
        try {
            $validatedData = $request->validate([
                'category_id' => 'required|exists:meal_categorys,id',
                'subcategory_id' => 'required|exists:meal_subcategorys,id',
                'subsubcategory_id' => 'required|exists:meal_subsubcategorys,id',
                'food_type_id' => 'required',
                'meal_name' => 'required',
                'meal_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'meal_qty' => 'required',
                'meal_amount' => 'required|numeric|min:0',
                'meal_description' => 'nullable|string|max:255',
            ]);

            $meal_image = null;
            if ($request->hasFile('meal_image')) {
                $file = $request->file('meal_image');
                $ext = $file->getClientOriginalExtension();
                $saveFileName = time() . '.' . $ext;
                $destinationPath = public_path('/uploads/meal_image/gallery');
                $file->move($destinationPath, $saveFileName);
                $meal_image = '/uploads/meal_image/gallery/' . $saveFileName;
            }

            $menu = Menu::create([
                'category_id' => $validatedData['category_id'],
                'subcategory_id' => $validatedData['subcategory_id'],
                'subsubcategory_id' => $validatedData['subsubcategory_id'],
                'food_type_id' => $validatedData['food_type_id'],
                'meal_image' => $meal_image,
                'meal_name' => $validatedData['meal_name'], 
                'meal_qty' => $validatedData['meal_qty'],
                'meal_amount' => $validatedData['meal_amount'],
                'meal_description' => $validatedData['meal_description'],
            ]);

            return response()->json($menu, 201);
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
            $validatedData = $request->validate([
                'id' => 'required',
                'category_id' => 'required|exists:meal_categorys,id',
                'subcategory_id' => 'required|exists:meal_subcategorys,id',
                'subsubcategory_id' => 'required|exists:meal_subsubcategorys,id',
                'food_type_id' => 'sometimes|required|array',
                'meal_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'meal_qty' => 'required|integer|min:1',
                'meal_amount' => 'required|numeric|min:0',
                'meal_description' => 'nullable|string|max:255',
            ]);
            $id = $request->id;
            if (isset($validatedData['media'])) {
                Storage::delete($menu->media);
                $menu->media = $validatedData['media']->store('menus', 'public');
            }

            $menu->category_id = $validatedData['category_id'] ?? $menu->category_id;
            $menu->subcategory_id = $validatedData['subcategory_id'] ?? $menu->subcategory_id;
            $menu->subsubcategory_id = $validatedData['subsubcategory_id'] ?? $menu->subsubcategory_id;
            $menu->food_type_id = implode(',', $validatedData['food_type_id'] ?? explode(',', $menu->food_type_id));
            $menu->meal_qty = $validatedData['meal_qty'] ?? $menu->meal_qty;
            $menu->meal_amount = $validatedData['meal_amount'] ?? $menu->meal_amount;
            $menu->meal_description = $validatedData['meal_description'] ?? $menu->meal_description;
            $menu->save();

            return response()->json($menu);
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


