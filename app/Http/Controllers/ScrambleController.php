<?php

namespace App\Http\Controllers;

use App\Http\DTOs\ScrambleIndexDTO;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ScrambleController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::onlyTrashed()->paginate();

        return response()->json([
            'data' => ScrambleIndexDTO::collect($users)->through(fn(ScrambleIndexDTO $dto) => $dto->include('settings')),
        ]);
    }
}
