<?php

namespace App\Http\Controllers;

use App\Http\DTOs\ScrambleIndexDTO;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ScrambleController extends Controller
{
    public function index(): JsonResponse
    {
        $user = User::first();

        return response()->json([
            'data' => ScrambleIndexDTO::fromModel($user)->include('email', 'settings')
        ]);
    }
}