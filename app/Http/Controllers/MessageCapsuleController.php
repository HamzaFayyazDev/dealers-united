<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreMessageCapsuleRequest, OpenMessageCapsuleRequest};
use App\Http\Resources\MessageCapsuleResource;
use App\Models\{MessageCapsule, User};
use Illuminate\Http\Response;

class MessageCapsuleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(MessageCapsule::class, 'message_capsule', ['except' => ['store', 'index']]);    }

    public function index(User $user)
    {
        return MessageCapsuleResource::collection($user->messageCapsules);
    }

    public function show(User $user, MessageCapsule $messageCapsule)
    {
        return new MessageCapsuleResource($messageCapsule);
    }
    
    /**
     * Store a newly created message capsule in storage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Http\Requests\StoreMessageCapsuleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreMessageCapsuleRequest $request)
    {
        $messageCapsule = $user->messageCapsules()->create($request->validated());

        if ($messageCapsule->wasRecentlyCreated) {
            return response()->json($messageCapsule, Response::HTTP_CREATED);
        } else {
            return response()->json(['error' => 'Failed to create message capsule', 'errors' => $messageCapsule->getErrors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function open(User $user, MessageCapsule $messageCapsule)
    {
        $this->authorize('open', [MessageCapsule::class, $messageCapsule, $user]);

        $messageCapsule->fill((['is_opened' => true]));
        if ($messageCapsule->save()) {
            return response()->json( new MessageCapsuleResource($messageCapsule), Response::HTTP_OK);
        } else {
            return response()->json(['error' => $object->getErrors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }        
    }
}
