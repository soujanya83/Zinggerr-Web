<?php

namespace App\Http\Controllers;

use App\Models\BbbMeeting;
use App\Models\EventModel;
use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;
use App\Notifications\EventCreated;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{


    public function event_store(Request $request)
    {
        // dd($request);
        try {
            $start_datetime = DateTime::createFromFormat('d/m/Y H:i', $request->input('start_datetime'));
            $end_datetime = DateTime::createFromFormat('d/m/Y H:i', $request->input('end_datetime'));

            // Check if conversion was successful
            if (!$start_datetime || !$end_datetime) {
                return back()->withErrors(['start_datetime' => 'Invalid date format. Use dd/mm/yyyy HH:ii.'])->withInput();
            }

            // Replace the request inputs with formatted values
            $request->merge([
                'start_datetime' => $start_datetime->format('d-m-Y\TH:i'),
                'end_datetime' => $end_datetime->format('d-m-Y\TH:i'),
            ]);

            // Validate the request
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:500',
                'start_datetime' => 'required|date_format:d-m-Y\TH:i',
                'end_datetime' => 'required|date_format:d-m-Y\TH:i|after:start_datetime',
                'status' => 'required|boolean',
                'description' => 'required|string',
                'background_color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/', // Optional: Validate hex color
                'text_color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',    // Optional: Validate hex color
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $startDate = Carbon::parse($request->start_datetime)->toDateString();
            $startDateTime = Carbon::parse($request->start_datetime);
            $endDateTime = Carbon::parse($request->end_datetime);
            $event = new EventModel();
            $event->id = (string) Guid::uuid4();
            $event->event_topic = $request->title;
            $event->description = $request->description;
            $event->event_start = $startDateTime;
            $event->event_end = $endDateTime;
            $event->background_color = $request->background_color;
            $event->text_color = $request->text_color;
            $event->status = $request->status;
            $event->created_by = auth::user()->id ?? null;
            $event->save();
            $users = User::all();
            foreach ($users as $user) {
                $user->notify(new EventCreated($event));
            }
            return redirect()->route('event.list')->with('success', 'Event created successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function index(): JsonResponse
    {
        try {
            $events = EventModel::where('status', 1)
                ->whereNotNull('event_start')
                ->whereNotNull('event_end')
                ->get()
                ->map(function ($event) {
                    return [
                        'title' => $event->event_topic ?? 'Event',
                        'start' => $event->event_start,
                        'background_color' => $event->background_color,
                        'text_color' => $event->text_color,
                        'end' => date('Y-m-d', strtotime($event->event_end . ' +1 day')),
                        'description' => $event->description,
                        'type' => 'event'
                    ];
                })->toArray();
            $meetings = BbbMeeting::
            orderByRaw("CASE WHEN status = 'running' THEN 0 ELSE 1 END")->
                latest('scheduled_at')
                ->get()
                ->toArray();
            $combinedData = array_merge($events, $meetings);
            return response()->json($combinedData);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }
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
            $start_datetime = DateTime::createFromFormat('d/m/Y H:i', $request->input('start_datetime'));
            $end_datetime = DateTime::createFromFormat('d/m/Y H:i', $request->input('end_datetime'));

            // Check if conversion was successful
            if (!$start_datetime || !$end_datetime) {
                return back()->withErrors(['start_datetime' => 'Invalid date format. Use dd/mm/yyyy HH:ii.'])->withInput();
            }

            // Replace the request inputs with formatted values
            $request->merge([
                'start_datetime' => $start_datetime->format('d-m-Y\TH:i'),
                'end_datetime' => $end_datetime->format('d-m-Y\TH:i'),
            ]);

            $id = $request->event_id;
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:500',
                'start_datetime' => 'required|date_format:d-m-Y\TH:i',
                'end_datetime' => 'required|date_format:d-m-Y\TH:i|after:start_datetime',
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
            $event->background_color = $request->background_color;
            $event->text_color = $request->text_color;
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
        $events = EventModel::orderBy('created_at', 'DESC')->get();
        return view('events.list', compact('events'));
    }


    // public function event_store(Request $request)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'title' => 'required|string|max:500',
    //             'start_datetime' => 'required|date_format:Y-m-d\TH:i',
    //             'end_datetime' => 'required|date_format:Y-m-d\TH:i|after:start_datetime',
    //             'status' => 'required|boolean',
    //             'description' => 'required|string'
    //         ]);

    //         if ($validator->fails()) {
    //             return back()
    //                 ->withErrors($validator)
    //                 ->withInput();
    //         }

    //         $startDate = Carbon::parse($request->start_datetime)->toDateString();
    //         $startDateTime = Carbon::parse($request->start_datetime);
    //         $endDateTime = Carbon::parse($request->end_datetime);


    //         $event = new EventModel();
    //         $event->id = (string) Guid::uuid4();
    //         $event->event_topic = $request->title;
    //         $event->description = $request->description;
    //         $event->event_start = $startDateTime;
    //         $event->event_end = $endDateTime;
    //         $event->status = $request->status;
    //         $event->created_by = auth::user()->id ?? null;
    //         $event->save();

    //         return redirect()->route('event.list')->with('success', 'Event created successfully');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    //     }
    // }



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
