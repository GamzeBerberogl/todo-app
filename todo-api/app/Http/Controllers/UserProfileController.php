<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserProfileUpdateRequest;
use App\Http\Resources\UserProfileResource;
use App\Http\Services\UserProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    protected $userProfileService;

    public function __construct(UserProfileService $userProfileService)
    {
        $this->userProfileService = $userProfileService;
    }

    public function show(): JsonResponse
    {
        $user = $this->userProfileService->getUserProfile(Auth::id());
        return response()->json(new UserProfileResource($user));
    }

    public function update(UserProfileUpdateRequest $request): JsonResponse
    {
        $user = $this->userProfileService->updateUserProfile(Auth::id(), $request->validated());
        return response()->json(new UserProfileResource($user));
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = $this->userProfileService->changePassword(Auth::id(), $request->validated());
        return response()->json(['message' => 'Şifre başarıyla değiştirildi.']);
    }
}



