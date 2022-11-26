<?php 

namespace App\Http\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Exception;

class UserRepository implements UserInterface{

    public function findUserById(int $userId){
        $user = User::find($userId);
        if(!$user){
            throw new Exception('No Such Resource Found', 404);
        }

        return $user;
    }
    
    public function createUser(array $validatedSignupRequest){
        return User::create($validatedSignupRequest);
    }
}