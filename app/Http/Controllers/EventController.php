<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use Illuminate\Http\Request;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function event_delete($id)
    {
        $event = EventModel::find($id);

        if ($event) {
            $event->delete();
            return response()->json(['success' => true, 'message' => 'Event deleted successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Event not found.']);
        }
    }

    public function event_update(Request $request)
    {
        try {
            $id = $request->event_id;
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:500',
                'start_date' => 'required|date',
                'start_time' => 'required',
                'end_date' => 'required|date|after_or_equal:start_date',
                'end_time' => [
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        if ($request->start_date === $request->end_date) {
                            if ($request->start_time >= $value) {
                                $fail('The end time must be after the start time when dates are the same.');
                            }
                        }
                    },
                ],
                'status' => 'required|boolean',
                'description' => 'required|string'
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $event = EventModel::findOrFail($id);
            $event->event_topic = $request->title;
            $event->description = $request->description;
            $event->event_start_date = $request->start_date;
            $event->event_start_time = $request->start_time ?? '00:00:00';
            $event->event_end_date = $request->end_date;
            $event->event_end_time = $request->end_time ?? '23:59:59';
            $event->status = $request->status;
            $event->updated_by = auth::user()->id ?? null;
            $event->save();

            return redirect()->route('event.list')->with('success', 'Event updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    public function event_edit($id)
    {

        $event = EventModel::find($id);
        return view('events.edit', compact('event'));
    }
    public function event_create_form(Request $request)
    {
        return view('events.create');
    }

    public function event_list(Request $request)
    {

        $events = EventModel::get();

        return view('events.list', compact('events'));
    }

    public function event_store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:500',
                'start_date' => 'required|date',
                'start_time' => 'required',
                'end_date' => 'required|date|after_or_equal:start_date',
                'end_time' => [
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        if ($request->start_date === $request->end_date) {
                            if ($request->start_time >= $value) {
                                $fail('The end time must be after the start time when dates are the same.');
                            }
                        }
                    },
                ],
                'status' => 'required|boolean',
                'description' => 'required|string'
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $event = new EventModel();
            $event->id = (string) Guid::uuid4();
            $event->event_topic = $request->title;
            $event->description = $request->description;
            $event->event_start_date = $request->start_date;
            $event->event_start_time = $request->start_time . ':00' ?? '00:00:00';
            $event->event_end_date = $request->end_date;
            $event->event_end_time = $request->end_time . ':00' ?? '23:59:00';
            $event->status = $request->status;
            $event->created_by = auth::user()->id ?? null;
            $event->save();

            return redirect()->route('event.list')->with('success', 'Event created successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
    public function updateEventStatus(Request $request)
    {
        $event = EventModel::find($request->id);

        if ($event) {
            $event->status = $request->status;
            $event->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Event not found']);
    }
}
