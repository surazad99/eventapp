<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\UserInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    protected $userRepository;
    function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function login(LoginRequest $loginRequest)
    {
        $validatedLoginCredentials = $loginRequest->validated();
        try{
            // dd($validatedLoginCredentials);
            if (!Auth::attempt(['email' => $validatedLoginCredentials['email'], 'password' => $validatedLoginCredentials['password']])) {
                return response(['message' => 'Invalid login credentials'], 400);
            }

            $accessToken = Auth::user()->createToken('authToken')->accessToken;
            return sendSuccessResponse('Logged In Successfully', ['user' => new UserResource(Auth::user()), 'access_token' => $accessToken]);

        }catch(Exception $exception){
            DB::rollBack();
            return sendErrorResponse($exception->getMessage(), $exception->getCode());

        }
        
    }

    public function signup(SignupRequest $signupRequest){
        $validatedSignupRequest = $signupRequest->validated();
        try{
            DB::beginTransaction();
            $validatedSignupRequest['password'] = bcrypt($validatedSignupRequest['password']);
            $user = $this->userRepository->createUser($validatedSignupRequest);
            $accessToken = $user->createToken('authToken')->accessToken;
            // dd($user);
            DB::commit();
            return sendSuccessResponse('Signup Successfully', ['user' => new UserResource($user), 'access_token' => $accessToken]);
            
        }catch(Exception $exception){
            DB::rollBack();
            return sendErrorResponse($exception->getMessage(), $exception->getCode());
        }
    }
}
