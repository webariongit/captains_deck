<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

# Models
use App\Models\EmployeePosition;

class EmployeePositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $EmployeePositions = EmployeePosition::all();
        return view('admin.employee-positions', ['url' => url('/'), 'datas' => $EmployeePositions]);
        return response()->json(['data' => $EmployeePositions, 'status' => 201], 201);
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
                'position' => 'required|string|max:255',
            ]);

            $employeePosition = new EmployeePosition();


            $employeePosition->position = $request->position;
            $employeePosition->save();

            return redirect()->route('admin.employee-positions.index')->with('success', 'Galleries successfully uploaded.');
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
                'position' => 'required|string|max:255',
            ]);

            $id = $request->id;
            $employeePosition = EmployeePosition::find($id);

            if (!$employeePosition) {
                return response()->json(['message' => 'Employee position not found', 'status' => 404], 404);
            }

            $employeePosition->position = $request->position;
            $employeePosition->save();

            return redirect()->route('admin.employee-positions.index')->with('success', 'Galleries successfully uploaded.');
            return response()->json(['message' => 'Employee position updated successfully', 'data' => $employeePosition, 'status' => 200], 200);
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
        $EmployeePosition = EmployeePosition::findOrFail($id);
        $EmployeePosition->delete();

        return redirect()->route('admin.employee-positions.index')->with('success', 'Galleries successfully uploaded.');
        return response()->json(['message' => 'EmployeePosition deleted successfully']);
    }
}
