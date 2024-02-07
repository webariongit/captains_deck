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

class MenuController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->id) {
            $Menu = Menu::find($request->id);

            if (!$Menu) {
                return response()->json(['message' => 'Meal category not found', 'status' => 404], 404);
            }

            return response()->json(['data' => $Menu, 'status' => 200], 200);
        } else {
            $Menu = Menu::get();
            return response()->json(['data' => $Menu, 'status' => 200], 200);
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
            $validator = Validator::make($request->all(), [
                'category_id' => 'required|exists:tbl_meal_categories,id',
                'subsubcategory_id' => 'required|exists:tbl_meal_subcategories,id',
                'country_id' => 'required',
                'meal_name' => 'required|string',
                'meal_amount' => 'required|string',
                'meal_description' => 'required|string',
                'meal_image' => 'nullable|mimes:jpeg,png',
                'food_type_id' => 'exists:tbl_food_types,id|required_with:category_id,1',
                'meal_qty' => 'nullable|required_with:category_id,2',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors(), 'status' => 400], 400);
            }
    
            $menu = new Menu();
            $menu->subsubcategory_id = $request->input('subsubcategory_id');
            $menu->country_id = $request->input('country_id');
            $menu->meal_name = $request->input('meal_name');
    
            if ($request->hasFile('meal_image')) {
                $file = $request->file('meal_image');
                $ext = $file->getClientOriginalExtension();
                $saveFileName = time() . '_' . uniqid() . '.' . $ext;
                $destinationPath = public_path('/uploads/gallery');
                $file->move($destinationPath, $saveFileName);
                $menu->meal_image = '/uploads/gallery/' . $saveFileName;

            }
    
            $menu->food_type_id = $request->input('food_type_id');
            $menu->meal_qty = $request->input('meal_qty');
    
            $menu->meal_amount = $request->input('meal_amount');
            $menu->meal_description = $request->input('meal_description');
    
            $menu->save();
    
            return response()->json(['message' => 'Menu created successfully', 'data' => $menu, 'status' => 201], 201);
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
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:menus,id',
                'subsubcategory_id' => 'required|exists:tbl_meal_subcategories,id',
                'country_id' => 'required',
                'meal_name' => 'required|string',
                'meal_amount' => 'required|string',
                'meal_description' => 'required|string',
                'meal_image' => 'nullable|mimes:jpeg,png',
                'food_type_id' => 'exists:tbl_food_types,id|required_with:category_id,1',
                'meal_qty' => 'nullable|required_with:category_id,2',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors(), 'status' => 400], 400);
            }
    
            $menu = Menu::find($request->input('id'));
    
            if (!$menu) {
                return response()->json(['message' => 'Menu not found', 'status' => 404], 404);
            }
    
            $menu->subsubcategory_id = $request->input('subsubcategory_id');
            $menu->country_id = $request->input('country_id');
            $menu->meal_name = $request->input('meal_name');
    
            if ($request->hasFile('meal_image')) {
                $file = $request->file('meal_image');
                $ext = $file->getClientOriginalExtension();
                $saveFileName = time() . '_' . uniqid() . '.' . $ext;
                $destinationPath = public_path('/uploads/gallery');
                $file->move($destinationPath, $saveFileName);
                $menu->meal_image = '/uploads/gallery/' . $saveFileName;
    
                $media_types = $this->getMediaType($ext);
            }
    
            $menu->food_type_id = $request->input('food_type_id');
            $menu->meal_qty = $request->input('meal_qty');
    
            $menu->meal_amount = $request->input('meal_amount');
            $menu->meal_description = $request->input('meal_description');
    
            $menu->save();
    
            return response()->json(['message' => 'Menu updated successfully', 'data' => $menu, 'status' => 200], 200);
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
