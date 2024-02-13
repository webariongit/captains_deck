<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

# Models
use App\Models\CMS;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = CMS::query();
        $cmsDetails = $query
        ->where('id', 1)
        ->first();

        return view('admin.cms', ['url' => url('/'), 'datas' => $cmsDetails, 'form_route' => route('admin.Privacy-Policy.update')]);
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
    public function update(Request $request)
    {
        try {
             $this->validate($request, [
                'id' => 'required',
                // 'title' => 'required|string',
                'description' => 'required|string',
            ]);

            $cms = CMS::find($request->id);

            if (!$cms) {
                return response()->json(['message' => 'CMS record not found', 'status' => 404], 404);
            }

            $cms->update([
                'description' => $request->description,
            ]);

            return redirect()->route('admin.Privacy-Policy.index')->with('success', 'CMS record updated successfully.');
            return response()->json(['message' => 'CMS record updated successfully', 'data' => $cms, 'status' => 200], 200);
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
