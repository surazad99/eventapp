<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventFilterRequest;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Interfaces\EventInterface;
use App\Interfaces\UserInterface;
use App\Models\Event;
use Exception;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{
    protected $eventRepository;
    protected $userRepository;

    function __construct(EventInterface $eventRepository, UserInterface $userRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EventFilterRequest $eventFilterRequest)
    {
        $validatedEventRequest = $eventFilterRequest->validated();
        try{
            $user = $this->userRepository->findUserById(auth()->user()->id);
            $events = $this->eventRepository->getAllEvents($user, isset($validatedEventRequest['filter_by']) ? $validatedEventRequest['filter_by']: null);
            return sendSuccessResponse('Data Found', EventResource::collection($events));
        }catch(Exception $exception){
            return sendErrorResponse($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $eventRequest)
    {
        $validatedEvent = $eventRequest->validated();
        try{
            $user = $this->userRepository->findUserById(auth()->user()->id);
            $this->eventRepository->storeEvent($validatedEvent, $user);
            return sendSuccessResponse('Event Created Sucessfully');

        }catch(Exception $exception){
            return sendErrorResponse($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $eventId)
    {
        try{
            $event = $this->eventRepository->findEventById($eventId);
            $this->checkEventUser($event);
            return sendSuccessResponse('Data Found', new EventResource($event));
        }catch(Exception $exception){
            return sendErrorResponse($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $eventRequest, int $eventId)
    {
        $validatedEvent = $eventRequest->validated();
        try{
            $event = $this->eventRepository->findEventById($eventId);
            $this->checkEventUser($event);
            $this->eventRepository->updateEvent($validatedEvent, $event);
            return sendSuccessResponse('Event Updated Sucessfully');

        }catch(Exception $exception){
            return sendErrorResponse($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $eventId)
    {
        try{
            $event = $this->eventRepository->findEventById($eventId);
            $this->checkEventUser($event);
            $this->eventRepository->deleteEvent($event);
            return sendSuccessResponse('Event Deleted Successfully');
        }catch(Exception $exception){
            return sendErrorResponse($exception->getMessage(), $exception->getCode());
        }
    }

    private function checkEventUser(Event $event)
    {
        if(Gate::denies('event-user', $event)){
            throw new Exception('Sorry You dont own this resource !', 403);
        }
    }
}
