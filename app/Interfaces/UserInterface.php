<?php

namespace App\Interfaces;

interface UserInterface {
    public function findUserById(int $userId);
    public function createUser(array $validatedSignupRequest);
}