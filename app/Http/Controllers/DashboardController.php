<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class DashboardController extends Controller
{
    public function __invoke()
    {
        if ($_GET["school"] == 1) {
            $tasks = Task::selectRaw('MONTH(updated_at) AS month, status, COUNT(*) AS count')
                ->groupBy('month', 'status')
                ->orderBy('month')
                ->whereIn('status', ['progress', 'success', 'cancel'])
                ->get();

            $tasksOnProgress = Task::whereStatus("progress")
                ->limit(7)
                ->with("school")
                ->latest()
                ->get();
        } else {
            $tasks = Task::selectRaw('MONTH(updated_at) AS month, status, COUNT(*) AS count')
                ->groupBy('month', 'status')
                ->orderBy('month')
                ->whereSchoolId($_GET["school"])
                ->whereIn('status', ['progress', 'success', 'cancel'])
                ->get();

            $tasksOnProgress = Task::whereSchoolId($_GET["school"])
                ->whereStatus("progress")
                ->with("users")
                ->limit(7)
                ->latest()
                ->get();
        }

        $taskCounts = [
            'progress' => array_fill(0, 12, 0),
            'success' => array_fill(0, 12, 0),
            'cancel' => array_fill(0, 12, 0)
        ];

        foreach ($tasks as $task) {
            $month = intval($task->month) - 1; // Kurangi 1 karena indeks array dimulai dari 0
            $taskCounts[$task->status][$month] = $task->count;
        }

        return response()->json([
            "taskForChart" => $taskCounts,
            "taskOnProgress" => $tasksOnProgress
        ]);
    }
}
