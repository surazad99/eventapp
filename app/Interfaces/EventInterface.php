<?php

namespace App\Interfaces;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\User;

interface EventInterface{
    public function findEventById(int $eventId);
    public function getAllEvents(User $user, $eventFilter);
    public function storeEvent(array $validatedEvent, User $user);
    public function updateEvent(array $validatedEvent, Event $event);
    public function deleteEvent(Event $event);
}
