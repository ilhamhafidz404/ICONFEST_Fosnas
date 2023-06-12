<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OptionContoller extends Controller
{
    public function mydata()
    {
        dd(Auth::user());
        $me = User::with(['roles', 'school'])->whereId(1)->first();
        return response()->json($me);
    }
}
