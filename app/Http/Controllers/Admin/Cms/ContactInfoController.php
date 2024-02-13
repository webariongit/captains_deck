<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

#
use App\Models\ContactInfo;


class ContactInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactInfoList = ContactInfo::first();
        return view('admin.contactInfo' , ['url' => url('/'), 'datas' => $contactInfoList]);
        return response()->json(['message' => 'Contact information retrieved successfully', 'contactInfoList' => ContactInfo::get()]);
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
                'phone_code' => 'required|regex:/^\+[0-9]+$/',
                'contact' => 'required|regex:/^\d{10}$/',
                'email' => 'required',
                'address' => 'required',
                'facebook' => 'required',
                'instagram' => 'required',
                'twitter' => 'required',
                'youtube' => 'required',
                'linkedin' => 'required',
                'order_online' => 'required',
                'open_hours' => 'required',
            ]);
    
            $id = 1;
            $contactInfo = ContactInfo::find($id);
    
            if (!$contactInfo) {
                return response()->json(['message' => 'ContactInfo not found', 'status' => 404], 404);
            }
    
            $contactInfo->phone_code = $validatedData['phone_code'];
            $contactInfo->contact = $validatedData['contact'];
            $contactInfo->email = $validatedData['email'];
            $contactInfo->address = $validatedData['address'];
            $contactInfo->facebook = $validatedData['facebook'];
            $contactInfo->instagram = $validatedData['instagram'];
            $contactInfo->twitter = $validatedData['twitter'];
            $contactInfo->youtube = $validatedData['youtube'];
            $contactInfo->linkedin = $validatedData['linkedin'];
            $contactInfo->order_online = $validatedData['order_online'];
            $contactInfo->open_hours = $validatedData['open_hours'];
    
            $contactInfo->save();
            
            return redirect()->route('admin.contactInfo.index')->with('success', 'Galleries successfully uploaded.');
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
                'phone_code' => 'required|regex:/^\+[0-9]+$/',
                'contact' => 'required|regex:/^\d{10}$/',
                'email' => 'required',
                'address' => 'required',
                'facebook' => 'required',
                'instagram' => 'required',
                'twitter' => 'required',
                'youtube' => 'required',
                'linkedin' => 'required',
                'order_online' => 'required',
                'open_hours' => 'required',
            ]);
    
            $id = 1;
            $contactInfo = ContactInfo::find($id);
    
            if (!$contactInfo) {
                return response()->json(['message' => 'ContactInfo not found', 'status' => 404], 404);
            }
    
            $contactInfo->phone_code = $validatedData['phone_code'];
            $contactInfo->contact = $validatedData['contact'];
            $contactInfo->email = $validatedData['email'];
            $contactInfo->address = $validatedData['address'];
            $contactInfo->facebook = $validatedData['facebook'];
            $contactInfo->instagram = $validatedData['instagram'];
            $contactInfo->twitter = $validatedData['twitter'];
            $contactInfo->youtube = $validatedData['youtube'];
            $contactInfo->linkedin = $validatedData['linkedin'];
            $contactInfo->order_online = $validatedData['order_online'];
            $contactInfo->open_hours = $validatedData['open_hours'];
    
            $contactInfo->save();
    
            return response()->json(['message' => 'Contact information updated successfully', 'contactInfo' => $contactInfo]);
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
