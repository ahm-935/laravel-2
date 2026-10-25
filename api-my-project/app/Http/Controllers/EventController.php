<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('creator')
            ->latest()
            ->paginate(10);

        $events->getCollection()->transform(function ($event) {
            $event->image_url = $event->image
                ? asset($event->image)
                : null;

            return $event;
        });

        // return view('admin.pages.event.index', compact('events'));
        return response()->json($events);
    }

    public function create()
    {
        return view('admin.pages.event.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
            'venue' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'event_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required|in:active,inactive',
        ], [
            'title.required' => 'Event title is required',
            'title.max' => 'Title should not exceed 255 characters',

            'image.mimes' => 'Image type should be jpg,jpeg,png,webp',
            'image.max' => 'Oops! Too large file. Image size should be less than 2MB',

            'venue.required' => 'Venue is required',
            'event_date.required' => 'Event date is required',
            'start_time.required' => 'Start time is required',
            'end_time.required' => 'End time is required',
            'end_time.after' => 'End time must be after start time',
        ]);


        // Create slug
        $slug = Str::slug($request->title);

        // Make slug unique
        $originalSlug = $slug;
        $counter = 1;

        while (Event::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }


        // If image uploaded
        if ($request->hasFile('image')) {

            // dd('Image uploaded');

            $imgName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/events'), $imgName);


            Event::create([
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'image' => 'uploads/events/' . $imgName,
                'venue' => $request->venue,
                'address' => $request->address,
                'event_date' => $request->event_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'status' => $request->status,
                'created_by' => Auth::id(),
            ]);

            return redirect()
                ->route('events.index')
                ->with('success', 'Event created successfully');
        } else {

            // dd('Image not uploaded');

            Event::create([
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'venue' => $request->venue,
                'address' => $request->address,
                'event_date' => $request->event_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'status' => $request->status,
                'created_by' => Auth::id(),
            ]);

            return redirect()
                ->route('events.index')
                ->with('success', 'Event created successfully');
        }
    }

    public function show(Event $event)
    {
        $event->load('creator', 'ticketTypes');

        // return view('admin.pages.event.show', compact('event'));
         $event->image_url = $event->image
        ? asset($event->image)
        : null;

    return response()->json([
        'data' => $event,
    ]);
    }

    public function edit(Event $event)
    {
        return view('admin.pages.event.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'venue' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $slug = Str::slug($validated['title']);

        $originalSlug = $slug;
        $counter = 1;

        while (
            Event::where('slug', $slug)
                ->where('id', '!=', $event->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $validated['slug'] = $slug;

        if ($request->hasFile('image')) {

            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }

            $validated['image'] = $request->file('image')
                ->store('events', 'public');
        }

        $event->update($validated);

        return redirect()
            ->route('events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('success', 'Event deleted successfully.');
    }

    public function details(string $id)
    {
        $event = Event::with('ticketTypes')
            ->where('status', 'active')
            ->findOrFail($id);

        return view(
            'activities.details',
            compact('event')
        );
    }
}
