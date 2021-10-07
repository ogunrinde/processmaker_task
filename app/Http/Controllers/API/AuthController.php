<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\UserRepositoryInterface;
use App\Http\Requests\StoreUser;
use App\Http\Requests\LoginUser;
use App\Http\Resources\AuthResource;
use Illuminate\Http\Resources\Json\JsonResource;


class AuthController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(StoreUser $request)
    {
        try {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
            $user = $this->userRepository->create($input);
            return (new AuthResource($user))->additional(["success" => true]);
        }catch(Exception $ex)
        {
            return (new RecordResource(null))->additional(["success" => false, 'message' => $ex->getMessage()]);
        }
    }

    public function login(LoginUser $request)
    {
        try{
            if (!auth()->attempt($request->all())) {
                return (new JsonResource(null))->additional(["success" => false, 'message' => 'Invalid Credentials']);
            }
    
            $accessToken = auth()->user()->createToken('authToken');

            return (new AuthResource(auth()->user()))->additional(["success" => true, 'token' => $accessToken->plainTextToken ]);
        }catch(Exception $ex)
        {
            return (new RecordResource(null))->additional(["success" => false, 'message' => $ex->getMessage()]);
        }
    }
}
