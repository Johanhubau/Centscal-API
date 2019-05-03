<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        if (!$request->has(['start', 'end'])) {
            return response(["message" => "Invalid request parameters."], 400);
        }

        $start = $request->get("start");
        $end = $request->get("end");

        return EventResource::collection(Event::all())->whereBetween('start', [$start, $end])->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // TODO: Make sure the user can create the event for the specified association

        $validated = $request->validate([
            'title' => 'required|min:2|max:255',
            'asso_id' => 'required|exists:associations,id',
            'all_day' => 'boolean',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'url' => 'url|nullable',
            'source' => 'nullable|exists:events,id'
        ]);

        $validated['start'] = date('Y-m-d H:i:s', strtotime($validated['start']));
        $validated['end'] = date('Y-m-d H:i:s', strtotime($validated['end']));

        Event::create($validated);
        // returns a 200 OK status after successful creation with no body
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event $event
     * @return Event
     */
    public function show(Event $event)
    {
        return $event;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  Event $event
     * @return Response
     */
    public function update(Request $request, Event $event)
    {
        // TODO: Make sure the event is editable

        $validated = $request->validate([
            'title' => 'min:2|max:255',
            'asso_id' => 'exists:associations,id',
            'all_day' => 'boolean',
            'start' => 'date',
            'end' => 'date|after:start',
            'url' => 'url|nullable',
            'source' => 'nullable|exists:events,id'
        ]);

        if ($request->has('start')) {
            $validated['start'] = date('Y-m-d H:i:s', strtotime($validated['start']));
        }
        if ($request->has('end')) {
            $validated['end'] = date('Y-m-d H:i:s', strtotime($validated['end']));
        }

        $event->update($validated);
        // returns a 200 OK status after successful update with no body
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return Response
     * @throws \Exception
     */
    public function destroy(Event $event)
    {
        // TODO: Make sure the event is editable

        $event->delete();
        // returns a 200 OK status after successful destruction with no body
    }
}
