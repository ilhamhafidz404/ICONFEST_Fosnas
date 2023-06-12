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
            $count = User::whereNotIn('name', ['admin'])->whereSchoolId($_GET['schoolId'])
                ->count();
            $anggotaCount = User::whereSchoolId($_GET['schoolId'])->role("anggota")
                ->count();
            $pengurusCount = User::whereSchoolId($_GET['schoolId'])
                ->role("pengurus osis")
                ->count();
        } else {
            $count = User::whereNotIn('name', ['admin'])->count();
            $anggotaCount = User::role("anggota")->count();
            $pengurusCount = User::role("pengurus osis")->count();
        }
        return response()->json([
            "totalCount" => $count,
            "anggotaCount" => $anggotaCount,
            "pengurusCount" => $pengurusCount,
        ]);
    }
    public function schools()
    {
        $count = School::count();
        return response()->json($count);
    }
}
