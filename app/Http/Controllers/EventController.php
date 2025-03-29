<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use Illuminate\Http\Request;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class EventController extends Controller
{


    public function index()
    {
        $events = EventModel::where('status', 1)
            ->whereNotNull('event_start')
            ->whereNotNull('event_end')
            ->get()
            ->groupBy(function ($event) {
                return date('Y-m-d', strtotime($event->event_start)); // Group by event_start date
            })
            ->map(function ($events, $date) {
                return [
                    'title' => count($events) . ' Events',
                    'start' => $date,
                    'events' => $events->toArray(), // Store event details for modal
                ];
            })
            ->values(); // Remove keys for JSON response

        return response()->json($events);
    }



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
                'start_datetime' => 'required|date_format:Y-m-d\TH:i',
                'end_datetime' => 'required|date_format:Y-m-d\TH:i|after:start_datetime',
                'status' => 'required|boolean',
                'description' => 'required|string'
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $event = EventModel::findOrFail($id);

            // Convert date-time values
            $startDateTime = Carbon::parse($request->start_datetime);
            $endDateTime = Carbon::parse($request->end_datetime);

            // Check for conflicting events (excluding the current event)
            // Uncomment if needed
            // $conflictingEvent = EventModel::where('id', '!=', $id)
            //     ->where(function ($query) use ($startDateTime, $endDateTime) {
            //         $query->whereBetween('event_start', [$startDateTime, $endDateTime])
            //             ->orWhereBetween('event_end', [$startDateTime, $endDateTime])
            //             ->orWhere(function ($query) use ($startDateTime, $endDateTime) {
            //                 $query->where('event_start', '<', $startDateTime)
            //                     ->where('event_end', '>', $endDateTime);
            //             });
            //     })
            //     ->exists();

            // if ($conflictingEvent) {
            //     return back()->withErrors(['start_datetime' => 'Another event is already scheduled during this time.'])->withInput();
            // }

            // Update event
            $event->event_topic = $request->title;
            $event->description = $request->description;
            $event->event_start = $startDateTime;
            $event->event_end = $endDateTime;
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
        $events = EventModel::orderBy('event_start', 'asc')->get();
        return view('events.list', compact('events'));
    }


    public function event_store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:500',
                'start_datetime' => 'required|date_format:Y-m-d\TH:i',
                'end_datetime' => 'required|date_format:Y-m-d\TH:i|after:start_datetime',
                'status' => 'required|boolean',
                'description' => 'required|string'
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $startDate = Carbon::parse($request->start_datetime)->toDateString();
            $startDateTime = Carbon::parse($request->start_datetime);
            $endDateTime = Carbon::parse($request->end_datetime);

            // Check for overlapping events on the same date
            // $conflictingEvent = EventModel::whereDate('event_start', $startDate)
            //     ->where(function ($query) use ($startDateTime, $endDateTime) {
            //         $query->whereBetween('event_start', [$startDateTime, $endDateTime])
            //             ->orWhereBetween('event_end', [$startDateTime, $endDateTime])
            //             ->orWhere(function ($query) use ($startDateTime, $endDateTime) {
            //                 $query->where('event_start', '<', $startDateTime)
            //                     ->where('event_end', '>', $endDateTime);
            //             });
            //     })
            //     ->exists();

            // if ($conflictingEvent) {
            //     return back()->withErrors(['start_datetime' => 'Another event is already scheduled during this time.'])->withInput();
            // }

            $event = new EventModel();
            $event->id = (string) Guid::uuid4();
            $event->event_topic = $request->title;
            $event->description = $request->description;
            $event->event_start = $startDateTime;
            $event->event_end = $endDateTime;
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
