<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

# Models
use App\Models\Employes;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $request->validate([
                'id' => 'nullable',
                'media_type' => 'nullable|string|in:image,videos',
                'order_direction' => 'nullable|in:asc,desc', 
                'page' => 'nullable', 
            ]);

            if ($request->id) {
                $employee = Employes::find($request->id);
                return view('admin.employee-view', ['url' => url('/'), 'datas' => $employee]);
            }

            $page = $request->page ?? 10;
            $orderByColumn = 'created_at';
            $orderByDirection = $request->order_direction ?? 'desc';

            $query = Employes::query();
            $employees = $query->orderBy($orderByColumn, $orderByDirection)->paginate($page);

            return view('admin.employee', ['url' => url('/'), 'datas' => $employees]);

            // If you want to return JSON response
            // return response()->json(['url' => url('/'), 'data' => $employees], 201);
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
    // public function store(Request $request)
    // {
    //     $employee = new Employee();
    //     // create([
    //         $employee->employe_type = $request->employe_type;
    //         $employee->name = $request->name;
    //         $employee->picture = $request->picture;
    //         $employee->save();
    //     // ]);

    //     return response()->json($employee);
    // }
    public function store(Request $request)
    {
        try {
            // $validatedData = $request->validate([
            //     'position' => 'required|string|max:255',
            // ]);

            $employeePosition = new Employes();


            $employeePosition->employe_type = $request->employe_type;
            $employeePosition->name = $request->name;
            // $employeePosition->picture = $request->picture;

            if ($request->media) {
                $file = $request->media;
                $images = [];
    
                $ext = $file->getClientOriginalExtension();
                $saveFileName = time() . '.' . $ext;
                $destinationPath = public_path('/uploads/event/gallery');
                $file->move($destinationPath, $saveFileName);
                $images = '/uploads/event/gallery/' . $saveFileName;
    
                if ($ext == "jpeg" || $ext == "png" || $ext == "jpg") {
                    $media_types = "image";
                } elseif ($ext == "mp4" || $ext == "avi" || $ext == "mov") {
                    $media_types = "video";
                } 
                // $event->media_types = $media_type;
                $employeePosition->picture = $images;
            }

            $employeePosition->status = 1;
            $employeePosition->save();

            return redirect()->route('admin.employees.index')->with('success', 'Galleries successfully uploaded.');
            return response()->json(['message' => 'Employee position created successfully', 'data' => $employeePosition, 'status' => 201], 201);
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
        try {
            $request->validate([
                'id' => 'nullable',
                'media_type' => 'nullable|string|in:image,videos',
                'order_direction' => 'nullable|in:asc,desc', 
                'page' => 'nullable', 
            ]);

            if ($request->id) {

                $query = Employes::find($request->id);
                return view('admin.employee-viwe', ['url' => url('/'), 'datas' => $employees]);

            }
    
            $page = $request->page ?? 10;
            $orderByColumn = 'created_at';
            $orderByDirection = $request->order_direction ?? 'desc';
    
            $query = Employes::query();
            $employees = $query->orderBy($orderByColumn, $orderByDirection)->paginate($page);
    
            return view('admin.employee', ['url' => url('/'), 'datas' => $employees]);
    
            // If you want to return JSON response
            // return response()->json(['url' => url('/'), 'data' => $employees], 201);
        } catch (ValidationException $exception) {
            $errors = $exception->errors();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
        } 
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
        $employee = Employes::findOrFail($id);

        $employee->update([
            'employe_type' => $request->employe_type,
            'name' => $request->name,
            'picture' => $request->picture,
        ]);

        return response()->json($employee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $EmployeePosition = Employes::findOrFail($id);
        $EmployeePosition->delete();

        return redirect()->route('admin.employees.index')->with('success', 'Galleries successfully uploaded.');
        return response()->json(['message' => 'EmployeePosition deleted successfully']);
    }
}
