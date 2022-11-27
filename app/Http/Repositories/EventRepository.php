<?php

namespace App\Http\Repositories;

use App\Interfaces\EventInterface;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class EventRepository implements EventInterface
{
    public function findEventById(int $eventId){
        $event = Event::find($eventId);
        if(!$event){
            throw new Exception('No such resource found', 404);
        }
        return $event;
    }

    public function getAllEvents(User $user, $eventFilter){
        switch($eventFilter){
            case 'finished':
                return $user->events()->where('end_date', '<', date('Y-m-d'))->orderBy('start_date', 'ASC')->get();

            case 'finished7':
                
                return $user->events()->where('end_date', '<', date('Y-m-d'))->where('end_date', '>', Carbon::now()->subDays(7))->orderBy('start_date', 'ASC')->get();
            
            case 'upcoming':
                return $user->events()->where('end_date', '>', date('Y-m-d'))->orderBy('start_date', 'ASC')->get();
            
            case 'upcoming7':
                return $user->events()->where('end_date', '>', date('Y-m-d'))->where('end_date', '<', Carbon::now()->addDays(7))->orderBy('start_date', 'ASC')->get();
            
            default:
                return $user->events()->orderBy('start_date', 'ASC')->get();


        }
    }

    public function storeEvent(array $validatedEvent, User $user){
        return $user->events()->create($validatedEvent);
    }

    public function updateEvent(array $validatedEvent, Event $event){
        $event->update($validatedEvent);
        return $event->fresh();
    }

    public function deleteEvent(Event $event){
        $event->delete();
    }


    
}