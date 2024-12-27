<?php

namespace App\Http\Controllers\App\API;

use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\TenantRequest;
use App\Models\CentralUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends BaseController
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(TenantRequest $request)
    {
        // Find the central user by email
        $request->identifyUser();
        $centralUser = CentralUser::where('email', $request->email)->first();

        if (!$centralUser) {
            return response()->json(['message' => 'The provided credentials are incorrect.'], 404);
        }

        $tenant = $this->identifyTenant($centralUser);
        if (!$tenant) {
            return response()->json(['message' => 'Tenant could not be identified'], 404);
        }
        return response()->json(['message' => 'Tenant identified', 'tenant' => $tenant->id, 'email' => $request->email], 200);
    }

    /**
     * Identify the tenant for the user.
     */
    public function identifyTenant(CentralUser $centralUser)
    {
        // Fetch the tenant associated with the user
        try {
            if ($centralUser->tenants->count() === 1) {
                return $centralUser->tenants->first();
            }

            // If there are multiple tenants, return the list for user to choose
            if ($centralUser->tenants->count() > 1) {
                return response()->json([
                    'message' => 'Multiple tenants found. Please specify the tenant.',
                    'tenants' => $centralUser->tenants
                ], 200);
            }
        } catch (\Exception $e) {
            return null; // Handle tenant identification errors gracefully
        }

        return null;
    }

    /**
     * Authenticate the user.
     */
    public function authenticateUser(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        $allUsers = User::all();
        return response()->json(['message' => 'User authenticated', 'user' => Auth::user(), 'allUser' => $allUsers], 200);
    }
}
