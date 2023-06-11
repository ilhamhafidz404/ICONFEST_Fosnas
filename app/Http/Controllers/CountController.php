<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;

class CountController extends Controller
{
    public function users()
    {
        if (isset($_GET['schoolId'])) {
            $count = User::whereSchoolId($_GET['schoolId'])->count();
        } else {
            $count = User::count();
        }
        return response()->json($count);
    }
    public function schools()
    {
        $count = School::count();
        return response()->json($count);
    }
}
