<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

# Models
use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     return view('admin.about');

    //     // try {
    //     //         // return $request->all();
              

    //     //         // return redirect()->url('admin/about');

    //     // } catch (ValidationException $exception) {
    //     //     $errors = $exception->errors();
    //     //     return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
    //     // } 
    // }
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

            return view('admin.gallerys' , ['url' => url('/'), 'datas' => $galleries]);

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
    // use App\Models\Event; // Make sure to import the Event model at the top

    public function store(Request $request)
    {
        try {
            $request->validate([
                'media.*' => 'required|mimes:jpeg,png,mp4,avi,mov',
            ]);
    
            $eventGalleries = [];
    
            foreach ($request->file('media') as $key => $file) {
                $ext = $file->getClientOriginalExtension();
                $saveFileName = time() . '_' . $key . '.' . $ext;
                $destinationPath = public_path('/uploads/gallery');
                $file->move($destinationPath, $saveFileName);
                $images = '/uploads/gallery/' . $saveFileName;

    
                if ($ext == "jpeg" || $ext == "png" || $ext == "jpg") {
                    $media_types = "image";
                } elseif ($ext == "mp4" || $ext == "avi" || $ext == "mov") {
                    $media_types = "video";
                } 
                // else {
                //     $media_types = "video";
                // }
    
                $eventGalleries_id = Gallery::insertGetId([
                    'event_id' => null, 
                    'media_types' => $media_types,
                    'media' => $images,
                ]);
    
                $eventGalleries[$key] = Gallery::find($eventGalleries_id);
            }
            $query = Gallery::query();
            $galleries = $query->paginate();

            return redirect()->route('admin.gallerys.index')->with('success', 'Galleries successfully uploaded.');
            // return response()->json(['url' => url('/'), 'gallery_data' => $eventGalleries], 201);
        } catch (ValidationException $exception) {
            $errors = $exception->errors();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
        } 
    }
    public function youtubeLinkStore(Request $request)
    {
        try {
            $request->validate([
                'video_link' => 'required|url',
            ]);
    
            $link = $request->input('link');
    
            $eventGalleries_id = Gallery::insertGetId([
                'event_id' => null, 
                'media_types' => 'youtube',
                'media' => $request->video_link,
            ]);
    
            $query = Gallery::query();
            $galleries = $query->paginate();
    
            return redirect()->route('admin.gallerys.index')->with('success', 'Gallery successfully uploaded.');
    
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
            $request->validate([
                'id' => 'required|exists:gallerys,id',
                'media' => 'required|mimes:jpeg,png,mp4,avi,mov',
            ]);

            $id = $request->id;
            $gallery = Gallery::find($id);
    
            if ($request->hasFile('media')) {
                $file = $request->file('media');
                $ext = $file->getClientOriginalExtension();
                $saveFileName = time() . '_' . uniqid() . '.' . $ext;
                $destinationPath = public_path('/uploads/gallery');
                $file->move($destinationPath, $saveFileName);
                $images = '/uploads/gallery/' . $saveFileName;
    
                if ($ext == "jpeg" || $ext == "png") {
                    $media_types = "image";
                } elseif ($ext == "mp4" || $ext == "avi" || $ext == "mov") {
                    $media_types = "video";
                } else {
                    $media_types = "video";
                }
    
                $gallery->update([
                    'media_types' => $media_types,
                    'media' => $images,
                ]);
            }
    
            return response()->json(['message' => 'Gallery updated successfully', 'data' => $gallery, 'status' => 200], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Gallery not found', 'status' => 404], 404);
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
            $gallery = Gallery::find($id);
            if (!is_null($gallery)) {
                $gallery->delete();
                return redirect()->route('admin.gallerys.index')->with('success', 'data delted.');
                // return response()->json(['message' => 'Gallery delted', 'status' => 200], 200);
            }

            return redirect()->route('admin.gallerys.index')->with('success', 'data not found');
            // return response()->json(['message' => 'Gallery not found', 'status' => 404], 404);            

        } catch (ValidationException $exception) {
            $errors = $exception->errors();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
        }
    }
}
