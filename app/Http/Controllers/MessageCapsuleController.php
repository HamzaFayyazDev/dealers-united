<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageCapsuleRequest;
use App\Http\Requests\UpdateMessageCapsuleRequest;
use App\Models\MessageCapsule;

class MessageCapsuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(MessageCapsule::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function open(MessageCapsule $messageCapsule)
    {
        $messageCapsule->update(['is_opened' => 'true']);
        return response()->json($messageCapsule, 201);
    }

    /**
     * Store a newly created message capsule in storage.
     *
     * @param  \App\Http\Requests\StoreMessageCapsuleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageCapsuleRequest $request)
    {
        $messageCapsule = MessageCapsule::create($request->validated());

        return response()->json($messageCapsule, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MessageCapsule $messageCapsule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MessageCapsule $messageCapsule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageCapsuleRequest $request, MessageCapsule $messageCapsule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MessageCapsule $messageCapsule)
    {
        //
    }
}
