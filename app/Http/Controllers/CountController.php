<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class CountController extends Controller
{
    public function users()
    {
        if ($_GET["schoolId"] == 1) {
            $count = User::whereNotIn('name', ['admin'])->count();
            $anggotaCount = User::role("anggota")->count();
            $pengurusCount = User::role("pengurus osis")->count();
            $adminCount = User::role("admin sekolah")->count();
        } else {
            $count = User::whereNotIn('name', ['admin'])->whereSchoolId($_GET['schoolId'])
                ->count();
            $anggotaCount = User::whereSchoolId($_GET['schoolId'])->role("anggota")
                ->count();
            $pengurusCount = User::whereSchoolId($_GET['schoolId'])
                ->role("pengurus osis")
                ->count();
            $adminCount = User::whereSchoolId($_GET['schoolId'])
                ->role("admin sekolah")
                ->count();
        }

        return response()->json([
            "totalCount" => $count,
            "anggotaCount" => $anggotaCount,
            "pengurusCount" => $pengurusCount,
            "adminCount" => $adminCount
        ]);
    }
    public function tasks()
    {
        if($_GET['schoolId'] == 1){
            $successCount = Task::whereStatus("success")
                ->count();
            $progressCount = Task::whereStatus("progress")
                ->count();
            $cancelCount = Task::whereStatus("cancel")
                ->count();
            $taskCount = Task::count();
        } else{
            $successCount = Task::whereSchoolId($_GET['schoolId'])
                ->whereStatus("success")
                ->count();
            $progressCount = Task::whereSchoolId($_GET['schoolId'])
                ->whereStatus("progress")
                ->count();
            $cancelCount = Task::whereSchoolId($_GET['schoolId'])
                ->whereStatus("cancel")
                ->count();
            $taskCount = Task::whereSchoolId($_GET['schoolId'])
                ->count();
        }

        return response()->json([
            "taskCount" => $taskCount,
            "successCount" => $successCount,
            "progressCount" => $progressCount,
            "cancelCount" => $cancelCount,
        ]);
    }
    public function generals()
    {
        $anggotaCount =
            User::role("anggota")
            ->count();

        $pengurusCount =
            User::role("pengurus osis")
            ->count();

        $schoolCount = School::count();

        $successTaskCount = Task::whereStatus("success")->count();

        return response()->json([
            "anggotaCount" => $anggotaCount,
            "pengurusCount" => $pengurusCount,
            "schoolCount" => $schoolCount,
            "successTaskCount" => $successTaskCount
        ]);
    }
    public function schools()
    {
        $count = School::count();
        return response()->json($count);
    }
}
