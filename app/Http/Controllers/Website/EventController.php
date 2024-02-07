<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

# Models
// use Event;
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

            // foreach ($events as $key => $event) {
            //     $events[$key]['gallery'] = [''=> Gallery::where('event_id', $event->id)->get()];
            // }
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
