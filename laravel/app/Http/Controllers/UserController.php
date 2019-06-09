<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\NotFoundException;
use App\Contracts\Services\UserService;
use App\Services\DTO\UserData;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUser(string $userName)
    {
        try {
            $user = $this->userService->retrieveUser($userName);
        
            return response()->json([
                'id' => $user->id,
                'name' => $user->name
            ]);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function createUser(Request $request)
    {
        try {
            $data = new UserData(
                $request->input('name')
            );
            $user = $this->userService->createUser($data);
        
            return response()->json([
                'id' => $user->id,
                'name' => $user->name
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
