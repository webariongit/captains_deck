<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

# Models
use App\Models\Event;
use App\Models\Gallery;

class EventController extends Controller
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

            $query = Event::query();
            if ($request->media_type) {
                $query->where('media_types', $request->media_type);
            }

            $galleries = $query->orderBy($orderByColumn, $orderByDirection)->paginate($page);

            return view('admin.events' , ['url' => url('/'), 'datas' => $galleries]);

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

    private function getMediaType($mimeType)
    {
        // Add logic to determine media type based on $mimeType
        // You can customize this based on your specific requirements
        if (str_contains($mimeType, 'image')) {
            return 'image';
        } elseif (str_contains($mimeType, 'video')) {
            return 'video';
        }
    
        return 'unknown';
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required|string',
                'date' => 'required|string',
                'media' => 'required|image',
                'links' => 'required|string',
                'description' => 'required|string',
                'galleries_media.*' => 'nullable|mimes:jpeg,png,jpj',
            ]);
    
            $event = new Event();
            $event->title = $request->title;
            $event->date = $request->date;
    
            if ($request->hasFile('media')) {
                $file = $request->file('media');
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
            
                $event->media_types = $media_types;
                $event->media = $images;
                $media_types = null;
            }
            
            
            
    
            $event->links = $request->links;
            $event->description = $request->description;
            $event->save();
    
            // Handle galleries_media
            if ($request->hasFile('galleries_media')) {
                $eventGalleries = [];
    
                foreach ($request->file('galleries_media') as $key => $file) {
                    $ext = $file->getClientOriginalExtension();
                    $saveFileName = time() . '_' . $key . '.' . $ext;
                    $destinationPath = public_path('/uploads/event/gallery');
                    $file->move($destinationPath, $saveFileName);
                     $images = '/uploads/event/gallery/' . $saveFileName;

                     if ($ext == "jpeg" || $ext == "png" || $ext == "jpg") {
                        $media_types = "image";
                    } elseif ($ext == "mp4" || $ext == "avi" || $ext == "mov") {
                        $media_types = "video";
                    } 
    
                    $eventGalleries_id = Gallery::insertGetId([
                        'event_id' => $event->id,
                        'media_types' => $media_types,
                        'media' => $images,
                    ]);
                    $eventGalleries[$key] = Gallery::find($eventGalleries_id);
                }
    
                 $event->eventGalleries = $eventGalleries;
            }
    
            return redirect()->route('admin.events.index')->with('success', 'Galleries successfully uploaded.');
            return response()->json(['message' => 'Event created successfully', 'data' => $event, 'status' => 201], 201);
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
            $this->validate($request, [
                'id' => 'required',
                'title' => 'required|string',
                'date' => 'required|string',
                'media' => 'required|image',
                'links' => 'required|string',
                'description' => 'required|string',
                'galleries_media.*' => 'nullable|mimes:jpeg,png,jpj',
            ]);
    
            $id = $request->id;
            $event = Event::find($id);
            if (is_null($event)) {
                return response()->json(['message' => 'Event not found', 'status' => 404], 404);
            }
    
            $event->title = $request->title;
            $event->date = $request->date;
    
            // Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
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
                $event->media_types = $media_type;
                $event->media = $images;
            }
    
            $event->links = $request->links;
            $event->description = $request->description;
            $event->save();
    
            // Handle galleries_media
            if ($request->hasFile('galleries_media')) {
                $eventGalleries = [];
    
                foreach ($request->file('galleries_media') as $key => $file) {
                    $ext = $file->getClientOriginalExtension();
                    $saveFileName = time() . '_' . $key . '.' . $ext;
                    $destinationPath = public_path('/uploads/event/gallery');
                    $file->move($destinationPath, $saveFileName);
                    $images = '/uploads/event/gallery/' . $saveFileName;
    
                    if ($ext == "jpeg" || $ext == "png" || $ext == "jpg") {
                        $media_types = "image";
                    } elseif ($ext == "mp4" || $ext == "avi" || $ext == "mov") {
                        $media_types = "video";
                    } 

                    $eventGalleries_id = Gallery::insertGetId([
                        'event_id' => $event->id,
                        'media_types' => $media_type,
                        'media' => $images,
                    ]);
                }
                $eventGalleries[] = Gallery::where('event_id', $event->id)->get();
    
                $event->eventGalleries = $eventGalleries;
            }
    
            return redirect()->route('admin.events.index')->with('success', 'Galleries successfully uploaded.');
            return response()->json(['message' => 'Event updated successfully', 'data' => $event, 'status' => 200], 200);
        } catch (ValidationException $exception) {
            $errors = $exception->errors();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
        }
    }
    
    
    // {
    //     try {

    //         $this->validate($request, [
    //             'id' => 'required',
    //             'title' => 'required|string',
    //             'date' => 'required|string',
    //             'image' => 'required|image',
    //             'links' => 'required|string',
    //             'description' => 'required|string',
    //             'galleries_media.*' => 'nullable|mimes:jpeg,png,mp4,avi,mov',
    //         ]);
    
    
    //         $id = $request->id;
    //         $event = Event::find($id);
    
    //         if (!$event) {
    //             return response()->json(['message' => 'Event not found', 'status' => 404], 404);
    //         }
    
    //         $event->title = $request->title;
    //         $event->date = $request->date;
    //         $event->image = $request->image;
    //         $event->links = $request->links;
    //         $event->description = $request->description;
    //         $event->event_id = $request->event_id;
    //         $event->save();
    
    //         if ($request->filled('galleries')) {
    //             Gallery::updateOrCreate(
    //                 ['event_id' => $id],
    //                 [
    //                     'media_types' => $request->galleries[0]['media_types'], // Assuming you have only one gallery in the request
    //                     'media' => $request->galleries[0]['media'],
    //                 ]
    //             );
    //         }
    
    //         return response()->json(['message' => 'Event updated successfully', 'status' => 200], 200);
    //     } catch (ValidationException $exception) {
    //         $errors = $exception->errors();
    //         return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
    //     } catch (\Exception $exception) {
    //         // Handle other exceptions if needed
    //         return response()->json(['message' => 'Error updating event', 'status' => 500], 500);
    //     }
    // }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $event = Event::find($id);
            if (!is_null($event)) {
                $event->delete();

                return redirect()->route('admin.events.index')->with('success', 'Galleries successfully uploaded.');
                return response()->json(['message' => 'event delted', 'status' => 200], 200);
            }
            return response()->json(['message' => 'event not found', 'status' => 404], 404);            

        } catch (ValidationException $exception) {
            $errors = $exception->errors();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
        }
    }
    
}


