<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

# 
use App\Models\GetInTouch;

class GetInTouchController extends Controller
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

            $query = GetInTouch::query();

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
                        ->where('name', 'LIKE', "%" . $searchTerm . "%")
                        ->orderBy($sortBy, $sort)
                        ->paginate(10);
                    // return response()->json([
                    //     'base_url' => url('/'),
                    //     'response' => $cmsDetails,
                    //     'status' => 200
                    // ], 200);
                } else {
                    $cmsDetails = $query
                        ->orderBy($sortBy, $sort)
                        ->paginate(10);

                    
                    // return response()->json([
                    //     'base_url' => url('/'),
                    //     'response' => $cmsDetails,
                    //     'status' => 200
                    // ], 200);
                }
            }
            
            return view('admin.get-in-touch' , ['url' => url('/'), 'datas' => $cmsDetails]);
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
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|digits:10',
                'subject' => 'required|string|max:255',
                'message' => 'required|string|max:10000',
            ]);

            $career = new GetInTouch();
            $career->name = $validatedData['name']; 
            $career->email = $validatedData['email'];
            $career->phone_number = $validatedData['phone_number'];
            $career->subject = $validatedData['subject'];
            $career->message = $validatedData['message'];
            $career->save();

            return response()->json(['message' => 'Form submitted successfully', 'data' => $career, 'status' => 201], 201);
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
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|digits:10',
                'subject' => 'required|string|max:255',
                'message' => 'required|string|max:10000',
            ]);
            $id = $request->id;
            $career = GetInTouch::find($id);

            if (!$career) {
                return response()->json(['message' => 'Career not found', 'status' => 404], 404);
            }

            $career->name = $validatedData['name']; 
            $career->email = $validatedData['email'];
            $career->phone_number = $validatedData['phone_number'];
            $career->subject = $validatedData['subject'];
            $career->message = $validatedData['message'];
            $career->save();

            return response()->json(['message' => 'Career updated successfully', 'data' => $career, 'status' => 200], 200);
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
        try {
            $getInTouch = GetInTouch::find($id);

            if (is_null($getInTouch)) {
                return redirect()->route('admin.get-in-touch.index')->with('success', 'GetInTouch not found');
            }

            $getInTouch->delete();

            return redirect()->route('admin.get-in-touch.index')->with('success', 'GetInTouch deleted successfully');
        } catch (Exception $exception) {
            // Handle any exceptions that might occur during the deletion
            return redirect()->route('admin.get-in-touch.index')->with('error', 'Error deleting GetInTouch');
        }
    }

}
