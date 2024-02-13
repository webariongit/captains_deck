<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

# 
use App\Models\Career;

class CareersController extends Controller
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
    
             $query = Career::query();
    
            if (isset($request->id)) {
                $careerDetails = $query
                    ->where('id', $request->id)
                    ->first();
    
                return response()->json([
                    'base_url' => url('/'),
                    'response' => $careerDetails,
                    'status' => 200
                ], 200);
            } else {
                $sort = is_null($request->sort) ? 'DESC' : $request->sort;
                $sortBy = is_null($request->sortBy) ? 'created_at' : $request->sortBy;
    
                if ($request->search) {
                    $searchTerm = $request->search;
                    $careerDetails = $query
                        ->where('full_name', 'LIKE', "%" . $searchTerm . "%")
                        ->orderBy($sortBy, $sort)
                        ->paginate(10);
                    // return response()->json([
                    //     'base_url' => url('/'),
                    //     'response' => $careerDetails,
                    //     'status' => 200
                    // ], 200);
                } else {
                    $careerDetails = $query
                        ->orderBy($sortBy, $sort)
                        ->paginate(10);
    
                    // return response()->json([
                    //     'base_url' => url('/'),
                    //     'response' => $careerDetails,
                    //     'status' => 200
                    // ], 200);
                }
            }
            return view('admin.apply-for-a-position', ['url' => url('/'), 'datas' => $careerDetails, 'form_route' => route('admin.Careers.update')]);
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
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|digits:10',
                'employee_position_id' => 'required|string|max:255',
                'cv' => 'required|file|mimes:pdf,doc,jpeg,png|max:10240',
                'cover_letter' => 'required|string|max:10000',
            ]);

            $career = new Career();
            $career->full_name = $validatedData['full_name'];
            $career->email = $validatedData['email'];
            $career->phone_number = $validatedData['phone_number'];
            $career->employee_position_id = $validatedData['employee_position_id'];
    
            // if ($request->hasFile('cv')) {
            //     $cvFile = $request->file('cv');
            //     $ext = $cvFile->getClientOriginalExtension();
            //     $saveFileName = time() . '_' . uniqid() . '.' . $ext;
            //     $destinationPath = public_path('/uploads/gallery');
            //     $cvFile->move($destinationPath, $saveFileName);
            //     $cvPath = '/uploads/gallery/' . $saveFileName;
            //     $career->cv = $cvPath;
            // }
    
            $career->cover_letter = $validatedData['cover_letter'];
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
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|digits:10',
                'employee_position_id' => 'required|string|max:255',
                'cv' => 'nullable|file|mimes:pdf,doc,jpeg,png|max:10240',
                'cover_letter' => 'required|string|max:10000',
            ]);
            $id = $request->id;
            $career = Career::find($id);

            if (!$career) {
                return response()->json(['message' => 'Career not found', 'status' => 404], 404);
            }

            $career->full_name = $validatedData['full_name'];
            $career->email = $validatedData['email'];
            $career->phone_number = $validatedData['phone_number'];
            $career->employee_position_id = $validatedData['employee_position_id'];

            // Update CV file if provided
            if ($request->hasFile('cv')) {
                $cvFile = $request->file('cv');
                $ext = $cvFile->getClientOriginalExtension();
                $saveFileName = time() . '_' . uniqid() . '.' . $ext;
                $destinationPath = public_path('/uploads/gallery');
                $cvFile->move($destinationPath, $saveFileName);
                $cvPath = '/uploads/gallery/' . $saveFileName;
                $career->cv = $cvPath;
            }

            $career->cover_letter = $validatedData['cover_letter'];
            $career->save();

            return response()->json(['message' => 'Form updated successfully', 'data' => $career, 'status' => 200], 200);
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
        $career = Career::findOrFail($id);
        $career->delete();

        return response()->json(['message' => 'career deleted successfully']);
    }
}
