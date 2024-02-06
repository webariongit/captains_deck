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
            $query = Event::query();

            if ($request->id) {
                $event = $query->find($request->id);

                if (!$event) {
                    return response()->json(['message' => 'Event not found', 'status' => 404], 404);
                }

                $event['gallery'] = Gallery::where('event_id', $event->id)->get();

            } else {
                $events = $query->get();
            }

            return response()->json($event ?? $events);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Event not found', 'status' => 404], 404);
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
                'image' => 'required|image',
                'links' => 'required|string',
                'description' => 'required|string',
                'galleries_media.*' => 'nullable|mimes:jpeg,png,mp4,avi,mov',
            ]);
    
            $event = new Event();
            $event->title = $request->title;
            $event->date = $request->date;
    
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $images = [];
            
                $ext = $file->getClientOriginalExtension();
                $saveFileName = time() . '.' . $ext;
                $destinationPath = public_path('/uploads/image/gallery');
                $file->move($destinationPath, $saveFileName);
                $images = '/uploads/image/gallery/' . $saveFileName;
            
                if (in_array($ext, ['jpeg', 'png'])) {
                    $media_type = "image";
                } elseif (in_array($ext, ['mp4', 'avi', 'mov'])) {
                    $media_type = "video";
                } else {
                    $media_type = "unknown";
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
                    $destinationPath = public_path('/uploads/image/gallery');
                    $file->move($destinationPath, $saveFileName);
                     $images = '/uploads/image/gallery/' . $saveFileName;

                    if ($ext == "jpeg" || $ext == "png") {
                        $media_types = "image";
                    } elseif ($ext == "mp4" || $ext == "avi" || $ext == "mov") {
                        $media_types = "video";
                    }else{
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
                'image' => 'required|image',
                'links' => 'required|string',
                'description' => 'required|string',
                'event_id' => 'required|exists:events,id',
                'galleries' => 'nullable|array',
                'galleries.*.media_types' => 'nullable|string|in:image,video',
                'galleries.*.media' => 'nullable|image,video',
            ]);
    
            $id = $request->id;
            $event = Event::find($id);
    
            if (!$event) {
                return response()->json(['message' => 'Event not found', 'status' => 404], 404);
            }
    
            $event->title = $request->title;
            $event->date = $request->date;
            $event->image = $request->image;
            $event->links = $request->links;
            $event->description = $request->description;
            $event->event_id = $request->event_id;
            $event->save();
    
            if ($request->filled('galleries')) {
                Gallery::updateOrCreate(
                    ['event_id' => $id],
                    [
                        'media_types' => $request->galleries[0]['media_types'], // Assuming you have only one gallery in the request
                        'media' => $request->galleries[0]['media'],
                    ]
                );
            }
    
            return response()->json(['message' => 'Event updated successfully', 'status' => 200], 200);
        } catch (ValidationException $exception) {
            $errors = $exception->errors();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors, 'status' => 400], 400);
        } catch (\Exception $exception) {
            // Handle other exceptions if needed
            return response()->json(['message' => 'Error updating event', 'status' => 500], 500);
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


