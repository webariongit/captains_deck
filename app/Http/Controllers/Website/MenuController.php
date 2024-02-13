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
            $result = [];
    
            if ($request->id) {
                if ($request->subcategory_id) {
                    $subcategory_ids = explode(',', $request->subcategory_id);
                    $subCategories = MealSubCategory::whereIn('id', $subcategory_ids)->get();

                   $firstSubCategoryId = $subCategories->first()->category_id;
                   $mealCategory = MealCategory::find($firstSubCategoryId);
               
                   $categoryData = [
                       'key_name' => $mealCategory->name,
                       'key_data' => [],
                   ];
               
                   foreach ($subCategories as $subcategory) {
                    $subcategoryData = [
                        'key_name' => $subcategory->name,
                        'subcategory_id' => $subcategory->id,
                        'key_data' => [], // Initialize with an empty array
                    ];
            
                    if ($request->subSubCategories) {
                        $subSubCategories_ids = explode(',', $request->subSubCategories);

                        $array = ['Starter' , 'Main Course' , 'Dessert' ];

                       if (count($subSubCategories_ids) == 3) {

                            $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();

                       }else if(count($subSubCategories_ids) == 2){
                            $comen_arry[] = $array[$subSubCategories_ids[0] - 1];
                            $comen_arry[] = $array[$subSubCategories_ids[1] - 1];

                            $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->whereIn('name',$comen_arry)->get();

                            // if (in_array(1, $subSubCategories_ids)) {
                            //     $subSubCategories->where('name', '=','Starter');
                            // }
                            // if (in_array(2, $subSubCategories_ids)) {
                            //     $subSubCategories->where('name', '=', 'Main Course');
                            // }
                            // if (in_array(3, $subSubCategories_ids)) {
                            //     $subSubCategories->where('name', '=', 'Dessert');
                            // }
                       }else if(count($subSubCategories_ids) == 1){
                        $comen_arry[] = $array[$subSubCategories_ids[0] - 1];

                        $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->whereIn('name',$comen_arry)->get();
                       }else {
                        $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();
                       }

                    } else {
                        $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();
                    }
                    
            
                    foreach ($subSubCategories as $subsubcategory) {
                        $menuItems = Menu::where('subsubcategory_id', $subsubcategory->id)->get();
            
                        $subsubcategoryData = [
                            'key_name' => $subsubcategory->name,
                            'key_data' => [],
                        ];
            
                        foreach ($menuItems as $menuItem) {
                            foreach ($menuItems as $menuItem) {
                                $foodTypeIds = explode(',', $menuItem->food_type_id);
                                $foodTypes = [];

                                if ($request->foodTypeIds) {
                                        $request_foodTypeIds = explode(',', $request->foodTypeIds);
                                        $commonElements = array_intersect($foodTypeIds, $request_foodTypeIds);
                                        foreach ($commonElements as $foodTypeId) {
                                            if ($foodTypeId != null && $foodTypeId != 0) {
                                                $foodType = FoodType::find($foodTypeId);

                                                if ($foodType) {
                                                    $foodTypes[] = $foodType;
                                                }
                                            }
                                        }
                                }else{
                                        foreach ($foodTypeIds as $foodTypeId) {
                                            if ($foodTypeId != null && $foodTypeId != 0) {
                                                $foodType = FoodType::find($foodTypeId);

                                                if ($foodType) {
                                                    $foodTypes[] = $foodType;
                                                }
                                            }
                                        }
                                }

                                if ($foodTypes) {
                                        $subsubcategoryData = [
                                            'key_name' => $subsubcategory->name,
                                            'key_data' => [],
                                        ];
                                    $menuItem['food_types'] = $foodTypes;
                                    $subsubcategoryData['key_data'][] = $menuItem;
                                }
                            }
            
                            $subsubcategoryData['key_data'][] = $menuItem;
                        }
            
                        $subcategoryData['key_data'][] = $subsubcategoryData;
                    }
            
                    $categoryData['key_data'][] = $subcategoryData;
                }
            
                $result[] = $categoryData;
               }elseif ($request->search) {
                    $searchTerm = $request->search;
                    
                    $mealCategory = MealCategory::find($request->id);
    
                    if (!$mealCategory) {
                        return response()->json(['message' => 'Meal category not found', 'status' => 404], 404);
                    }
        
                    $categoryData = [
                        'key_name' => $mealCategory->name,
                        'key_data' => [],
                    ];
        
                    $subCategories = MealSubCategory::where('category_id', $mealCategory->id)->get();
        
                    foreach ($subCategories as $subcategory) {
                        $subcategoryData = [
                            'key_name' => $subcategory->name,
                            'subcategory_id' => $subcategory->id,
                            'key_data' => [], // Initialize with an empty array
                        ];
                
                        // if ($request->subSubCategories) {
                        //     $subSubCategories_ids = explode(',', $request->subSubCategories);
                        //     $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->whereIn('id', $subSubCategories_ids)->get();
                        // } else {
                        //     $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();
                        // }

                        if ($request->subSubCategories) {
                            $subSubCategories_ids = explode(',', $request->subSubCategories);

                            $array = ['Starter' , 'Main Course' , 'Dessert' ];

                           if (count($subSubCategories_ids) == 3) {

                                $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();

                           }else if(count($subSubCategories_ids) == 2){
                                $comen_arry[] = $array[$subSubCategories_ids[0] - 1];
                                $comen_arry[] = $array[$subSubCategories_ids[1] - 1];

                                $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->whereIn('name',$comen_arry)->get();

                                // if (in_array(1, $subSubCategories_ids)) {
                                //     $subSubCategories->where('name', '=','Starter');
                                // }
                                // if (in_array(2, $subSubCategories_ids)) {
                                //     $subSubCategories->where('name', '=', 'Main Course');
                                // }
                                // if (in_array(3, $subSubCategories_ids)) {
                                //     $subSubCategories->where('name', '=', 'Dessert');
                                // }
                           }else if(count($subSubCategories_ids) == 1){
                            $comen_arry[] = $array[$subSubCategories_ids[0] - 1];

                            $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->whereIn('name',$comen_arry)->get();
                           }else {
                            $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();
                           }

                        } else {
                            $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();
                        }

                        foreach ($subSubCategories as $subsubcategory) {
                            $menuItems = Menu::where('subsubcategory_id', $subsubcategory->id)->where('meal_name', 'LIKE', "%" . $searchTerm . "%")->get();

                
                            $subsubcategoryData = [
                                'key_name' => $subsubcategory->name,
                                'key_data' => [],
                            ];
                
                            foreach ($menuItems as $menuItem) {
                                foreach ($menuItems as $menuItem) {
                                    $foodTypeIds = explode(',', $menuItem->food_type_id);
                                    $foodTypes = [];

                                    if ($request->foodTypeIds) {
                                            $request_foodTypeIds = explode(',', $request->foodTypeIds);
                                            $commonElements = array_intersect($foodTypeIds, $request_foodTypeIds);
                                            foreach ($commonElements as $foodTypeId) {
                                                if ($foodTypeId != null && $foodTypeId != 0) {
                                                    $foodType = FoodType::find($foodTypeId);

                                                    if ($foodType) {
                                                        $foodTypes[] = $foodType;
                                                    }
                                                }
                                            }
                                    }else{
                                            foreach ($foodTypeIds as $foodTypeId) {
                                                if ($foodTypeId != null && $foodTypeId != 0) {
                                                    $foodType = FoodType::find($foodTypeId);

                                                    if ($foodType) {
                                                        $foodTypes[] = $foodType;
                                                    }
                                                }
                                            }
                                    }

                                    if ($foodTypes) {
                                            $subsubcategoryData = [
                                                'key_name' => $subsubcategory->name,
                                                'key_data' => [],
                                            ];
                                        $menuItem['food_types'] = $foodTypes;
                                        $subsubcategoryData['key_data'][] = $menuItem;
                                    }
                                }
                
                                $subsubcategoryData['key_data'][] = $menuItem;
                            }
                
                            $subcategoryData['key_data'][] = $subsubcategoryData;
                        }
                
                        $categoryData['key_data'][] = $subcategoryData;
                    }
        
                    $result[] = $categoryData;
                }else {
                    $mealCategory = MealCategory::find($request->id);
    
                    if (!$mealCategory) {
                        return response()->json(['message' => 'Meal category not found', 'status' => 404], 404);
                    }
        
                    $categoryData = [
                        'key_name' => $mealCategory->name,
                        'key_data' => [],
                    ];
        
                    $subCategories = MealSubCategory::where('category_id', $mealCategory->id)->get();
        
                    foreach ($subCategories as $subcategory) {
                        $subcategoryData = [
                            'key_name' => $subcategory->name,
                            'subcategory_id' => $subcategory->id,
                            'key_data' => [], // Initialize with an empty array
                        ];
                
                        // if ($request->subSubCategories) {
                        //     $subSubCategories_ids = explode(',', $request->subSubCategories);
                        //     $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->whereIn('id', $subSubCategories_ids)->get();
                        // } else {
                        //     $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();
                        // }
                        if ($request->subSubCategories) {
                            $subSubCategories_ids = explode(',', $request->subSubCategories);

                            $array = ['Starter' , 'Main Course' , 'Dessert' ];

                           if (count($subSubCategories_ids) == 3) {

                                $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();

                           }else if(count($subSubCategories_ids) == 2){
                                $comen_arry[] = $array[$subSubCategories_ids[0] - 1];
                                $comen_arry[] = $array[$subSubCategories_ids[1] - 1];

                                $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->whereIn('name',$comen_arry)->get();

                                // if (in_array(1, $subSubCategories_ids)) {
                                //     $subSubCategories->where('name', '=','Starter');
                                // }
                                // if (in_array(2, $subSubCategories_ids)) {
                                //     $subSubCategories->where('name', '=', 'Main Course');
                                // }
                                // if (in_array(3, $subSubCategories_ids)) {
                                //     $subSubCategories->where('name', '=', 'Dessert');
                                // }
                           }else if(count($subSubCategories_ids) == 1){
                            $comen_arry[] = $array[$subSubCategories_ids[0] - 1];

                            $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->whereIn('name',$comen_arry)->get();
                           }else {
                            $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();
                           }

                        } else {
                            $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();
                        }
                
                        foreach ($subSubCategories as $subsubcategory) {
                            $menuItems = Menu::where('subsubcategory_id', $subsubcategory->id)->get();
                
                            $subsubcategoryData = [
                                'key_name' => $subsubcategory->name,
                                'key_data' => [],
                            ];
                
                            foreach ($menuItems as $menuItem) {
                                foreach ($menuItems as $menuItem) {
                                    $foodTypeIds = explode(',', $menuItem->food_type_id);
                                    $foodTypes = [];

                                    if ($request->foodTypeIds) {
                                            $request_foodTypeIds = explode(',', $request->foodTypeIds);
                                            $commonElements = array_intersect($foodTypeIds, $request_foodTypeIds);
                                            foreach ($commonElements as $foodTypeId) {
                                                if ($foodTypeId != null && $foodTypeId != 0) {
                                                    $foodType = FoodType::find($foodTypeId);

                                                    if ($foodType) {
                                                        $foodTypes[] = $foodType;
                                                    }
                                                }
                                            }
                                    }else{
                                            foreach ($foodTypeIds as $foodTypeId) {
                                                if ($foodTypeId != null && $foodTypeId != 0) {
                                                    $foodType = FoodType::find($foodTypeId);

                                                    if ($foodType) {
                                                        $foodTypes[] = $foodType;
                                                    }
                                                }
                                            }
                                    }

                                    if ($foodTypes) {
                                            $subsubcategoryData = [
                                                'key_name' => $subsubcategory->name,
                                                'key_data' => [],
                                            ];
                                        $menuItem['food_types'] = $foodTypes;
                                        $subsubcategoryData['key_data'][] = $menuItem;
                                    }
                                }
                
                                $subsubcategoryData['key_data'][] = $menuItem;
                            }
                
                            $subcategoryData['key_data'][] = $subsubcategoryData;
                        }
                
                        $categoryData['key_data'][] = $subcategoryData;
                    }
        
                    $result[] = $categoryData;
                }
            } else 
            {
                $mealCategories = MealCategory::get();

                if (!$mealCategories) {
                    return response()->json(['message' => 'Meal categories not found', 'status' => 404], 404);
                }
                
                $result = [];
                
                foreach ($mealCategories as $category) {
                    $categoryData = [
                        'key_name' => $category->name,
                        'key_data' => [],
                    ];
                
                    $subCategories = MealSubCategory::where('category_id', $category->id)->get();
                
                    foreach ($subCategories as $subcategory) {
                        $subcategoryData = [
                            'key_name' => $subcategory->name,
                            'subcategory_id' => $subcategory->id,
                            'key_data' => [], // Initialize with an empty array
                        ];
                
                        // if ($request->subSubCategories) {
                        //     $subSubCategories_ids = explode(',', $request->subSubCategories);
                        //     $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->whereIn('id', $subSubCategories_ids)->get();
                        // } else {
                        //     $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();
                        // }

                        if ($request->subSubCategories) {
                            $subSubCategories_ids = explode(',', $request->subSubCategories);

                            $array = ['Starter' , 'Main Course' , 'Dessert' ];

                           if (count($subSubCategories_ids) == 3) {

                                $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();

                           }else if(count($subSubCategories_ids) == 2){
                                $comen_arry[] = $array[$subSubCategories_ids[0] - 1];
                                $comen_arry[] = $array[$subSubCategories_ids[1] - 1];

                                $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->whereIn('name',$comen_arry)->get();

                                // if (in_array(1, $subSubCategories_ids)) {
                                //     $subSubCategories->where('name', '=','Starter');
                                // }
                                // if (in_array(2, $subSubCategories_ids)) {
                                //     $subSubCategories->where('name', '=', 'Main Course');
                                // }
                                // if (in_array(3, $subSubCategories_ids)) {
                                //     $subSubCategories->where('name', '=', 'Dessert');
                                // }
                           }else if(count($subSubCategories_ids) == 1){
                            $comen_arry[] = $array[$subSubCategories_ids[0] - 1];

                            $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->whereIn('name',$comen_arry)->get();
                           }else {
                            $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();
                           }

                        } else {
                            $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();
                        }
                
                        foreach ($subSubCategories as $subsubcategory) {
                            $menuItems = Menu::where('subsubcategory_id', $subsubcategory->id)->get();
                
                            $subsubcategoryData = [
                                'key_name' => $subsubcategory->name,
                                'key_data' => [],
                            ];
                
                            foreach ($menuItems as $menuItem) {
                                foreach ($menuItems as $menuItem) {
                                    $foodTypeIds = explode(',', $menuItem->food_type_id);
                                    $foodTypes = [];

                                    if ($request->foodTypeIds) {
                                            $request_foodTypeIds = explode(',', $request->foodTypeIds);
                                            $commonElements = array_intersect($foodTypeIds, $request_foodTypeIds);
                                            foreach ($commonElements as $foodTypeId) {
                                                if ($foodTypeId != null && $foodTypeId != 0) {
                                                    $foodType = FoodType::find($foodTypeId);

                                                    if ($foodType) {
                                                        $foodTypes[] = $foodType;
                                                    }
                                                }
                                            }
                                    }else{
                                            foreach ($foodTypeIds as $foodTypeId) {
                                                if ($foodTypeId != null && $foodTypeId != 0) {
                                                    $foodType = FoodType::find($foodTypeId);

                                                    if ($foodType) {
                                                        $foodTypes[] = $foodType;
                                                    }
                                                }
                                            }
                                    }

                                    if ($foodTypes) {
                                            $subsubcategoryData = [
                                                'key_name' => $subsubcategory->name,
                                                'key_data' => [],
                                            ];
                                        $menuItem['food_types'] = $foodTypes;
                                        $subsubcategoryData['key_data'][] = $menuItem;
                                    }
                                }
                
                                $subsubcategoryData['key_data'][] = $menuItem;
                            }
                
                            $subcategoryData['key_data'][] = $subsubcategoryData;
                        }
                
                        $categoryData['key_data'][] = $subcategoryData;
                    }
                
                    $result[] = $categoryData;
                }
                
                return response()->json(['base_url' => "https://api-captains-deck.myclientdemo.us", 'data' => $result, 'status' => 200]);
                    
            }
    
            return response()->json(['base_url' => url('/'), 'data' => $result, 'status' => 200], 200);
        } catch (ValidationException $exception) {
            $errors = $exception->errors();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
        }
    }

    public function subCategoryIndex(Request $request)
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
    

    
    

//     public function index(Request $request)
// {
//     try {
//         $result = [];

//         if ($request->id) {
//             $mealCategory = MealCategory::find($request->id);

//             if (!$mealCategory) {
//                 return response()->json(['message' => 'Meal category not found', 'status' => 404], 404);
//             }

//             $categoryData = [
//                 'key_name' => $mealCategory->name,
//                 'key_data' => [],
//             ];

//             $subCategories = MealSubCategory::where('category_id', $mealCategory->id)->get();

//             foreach ($subCategories as $subcategory) {
//                 $subcategoryData = [
//                     'key_name' => $subcategory->name,
//                     'key_data' => [],
//                 ];

//                 $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();

//                 foreach ($subSubCategories as $subsubcategory) {
//                     $subsubcategoryData = [
//                         'key_name' => $subsubcategory->name,
//                         'key_data' => Menu::where('subsubcategory_id', $subsubcategory->id)->search($request->input('search'))->get(),
//                     ];

//                     $subcategoryData['key_data'][] = $subsubcategoryData;
//                 }

//                 $categoryData['key_data'][] = $subcategoryData;
//             }

//             $result[] = $categoryData;
//         } else {
//             $categoryIds = $request->input('category_ids'); // Assuming category_ids is an array of category IDs

//             $mealCategories = MealCategory::whereIn('id', $categoryIds)->get();

//             if (!$mealCategories) {
//                 return response()->json(['message' => 'Meal categories not found', 'status' => 404], 404);
//             }

//             foreach ($mealCategories as $category) {
//                 $categoryData = [
//                     'key_name' => $category->name,
//                     'key_data' => [],
//                 ];

//                 $subCategories = MealSubCategory::where('category_id', $category->id)->get();

//                 foreach ($subCategories as $subcategory) {
//                     $subcategoryData = [
//                         'key_name' => $subcategory->name,
//                         'key_data' => [],
//                     ];

//                     $subSubCategories = MealSubSubCategory::where('subcategory_id', $subcategory->id)->get();

//                     foreach ($subSubCategories as $subsubcategory) {
//                         $subsubcategoryData = [
//                             'key_name' => $subsubcategory->name,
//                             'key_data' => Menu::where('subsubcategory_id', $subsubcategory->id)->search($request->input('search'))->get(),
//                         ];

//                         $subcategoryData['key_data'][] = $subsubcategoryData;
//                     }

//                     $categoryData['key_data'][] = $subcategoryData;
//                 }

//                 $result[] = $categoryData;
//             }
//         }

//         return response()->json(['base_url' => url('/'), 'data' => $result, 'status' => 200], 200);
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
