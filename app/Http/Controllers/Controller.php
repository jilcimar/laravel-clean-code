<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Nette\Schema\ValidationException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json('Usuário não encontrado', 401);
        }

        return response()->json(['token' => $user->createToken($user->remember_token)->plainTextToken]);
    }
}
