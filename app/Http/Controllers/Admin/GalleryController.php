<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $request->validate([
                'media_type' => 'nullable|string|in:image,videos',
                'order_direction' => 'nullable|in:asc,desc', 
                'page' => 'nullable', 
            ]);
            $page = $request->page ?? 10;
            $orderByColumn = 'created_at';
            $orderByDirection = $request->order_direction ?? 'desc';

            $query = Gallery::query();
            if ($request->media_type) {
                $query->where('media_types', $request->media_type);
            }

            $galleries = $query->orderBy($orderByColumn, $orderByDirection)->paginate($page);

            return response()->json(['url' => url('/'), 'data' => $galleries], 201);
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
            $request->validate([
                'media_type' => 'required|string|in:image,videos',
                'media' => $request->media_type == 'image' ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'nullable|mimes:mp4,avi,mov,wmv',
            ]);
    
            // $mediaPath = $request->file('media')->store('gallery', 'public');
            $media = null;
            if ($request->hasFile('media')) {
                $file = $request->file('media');
                $ext = $file->getClientOriginalExtension();
                $saveFileName = time() . '.' . $ext;
                $destinationPath = public_path('/uploads/media/gallery');
                $file->move($destinationPath, $saveFileName);
                $media = '/uploads/media/gallery/' . $saveFileName;
            }
    
            $gallery = Gallery::create([
                'media_types' => $request->media_type,
                'media' => $media,
            ]);
    
            return response()->json(['url' => url('/'), 'gallery_data' => $gallery], 201);
        }catch(ValidationException $exception){
            $errors = $exception->errors();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors, "status" => 400], 400);
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
            $request->validate([
                'id' => 'required|numeric|not_in:0',
                'media_type' => 'required|string|in:image,videos',
                'media' => $request->media_type == 'image' ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'nullable|mimes:mp4,avi,mov,wmv',
            ]);
            $id = $request->id;
            $gallery = Gallery::findOrFail($id);

            if ($request->hasFile('media')) {
                // Delete the existing media file
                if ($gallery->media) {
                    $this->deleteMediaFile($gallery->media);
                }

                // Upload the new media file
                $file = $request->file('media');
                $ext = $file->getClientOriginalExtension();
                $saveFileName = time() . '.' . $ext;
                $destinationPath = public_path('/uploads/media/gallery');
                $file->move($destinationPath, $saveFileName);
                $gallery->media = '/uploads/media/gallery/' . $saveFileName;
            }

            $gallery->media_types = $request->media_type;
            $gallery->save();

            return response()->json(['url' => url('/'), 'gallery_data' => $gallery], 200);
        } catch (ValidationException $exception) {
            $errors = $exception->errors();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
        }
    }
    /**
     * Update in delete the specified resource in storage(Media).
     */
    private function deleteMediaFile($filePath)
    {
        $fullPath = public_path($filePath);

        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            if (!is_null($gallery)) {
                $gallery->delete();
            }
            return response()->json(null, 204);
        } catch (ValidationException $exception) {
            $errors = $exception->errors();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
        }
    }
}
