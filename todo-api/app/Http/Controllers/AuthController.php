<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\Auth\UserResponse;
use App\Http\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->validated());
    
        return response()->json([
            'message' => 'Kayıt başarıyla oluşturuldu.',
            'user' => new UserResponse($user),
        ], 201); 
    }
    

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();
    
        if (!$token = $this->authService->login($credentials)) {
            return response()->json(['message' => 'Geçersiz kimlik bilgileri'], 401);
        }
    
        return response()->json(['token' => $token], 200);
    }
    

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->user());
    
        return response()->json(['message' => 'Başarıyla çıkış yapıldı'], 200);
    }
    
}
