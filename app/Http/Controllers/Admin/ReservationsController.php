<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
                // 'name' => 'required|string|max:255',
                // 'email' => 'required|string|email|max:255',
                // 'phone' => 'required|string|max:255',
                'date' => 'required|date|after:today',
                'time' => 'required|string|max:255',
                'person' => 'required|integer|min:1',
            ]);



            $reservation = Reservation::create($validatedData);

            return response()->json(['message' => 'Reservation created successfully', 'data' => $reservation, 'status' => 201], 201);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Error creating reservation', 'error' => $exception->getMessage(), 'status' => 500], 500);
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
                'date' => 'required|date|after:today',
                'time' => 'required|string|max:255',
                'person' => 'required|integer|min:1',
            ]);
            $id = $request->id;
            $reservation = Reservation::find($id);

            if (!$reservation) {
                return response()->json(['message' => 'Reservation not found', 'status' => 404], 404);
            }

            $reservation->update($validatedData);

            return response()->json(['message' => 'Reservation updated successfully', 'data' => $reservation, 'status' => 200], 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Error updating reservation', 'error' => $exception->getMessage(), 'status' => 500], 500);
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
