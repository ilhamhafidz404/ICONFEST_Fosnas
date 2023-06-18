<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // cek jika data get kosong
        if($_GET["school"] == 0){
            return response()->json([
                "message" => "Tidak memenuhi syarat get data"
            ]);
        }

        if($_GET["user"]){
            if($_GET["school"] == 1){
                $tasks= Task::with(["users", "school"])
                    ->whereHas('users', function ($query) {
                        $query->where('user_id', $_GET["user"]);
                    })
                    ->where("name", "LIKE", "%" . $_GET["search"] . "%")
                    ->latest()
                    ->paginate($_GET['paginate']);
            } else{
                $tasks= Task::with(["users", "school"])
                    ->whereHas('users', function ($query) {
                        $query->where('user_id', $_GET["user"]);
                    })
                    ->where("name", "LIKE", "%" . $_GET["search"] . "%")
                    ->whereSchoolId($_GET["school"])
                    ->latest()
                    ->paginate($_GET['paginate']);
            }
        } else{
            if($_GET["school"] == 1){
                $tasks= Task::with(["users", "school"])
                    ->where("name", "LIKE", "%" . $_GET["search"] . "%")
                    ->latest()
                    ->paginate($_GET['paginate']);
            } else{
                $tasks= Task::with(["users", "school"])
                    ->where("name", "LIKE", "%" . $_GET["search"] . "%")
                    ->whereSchoolId($_GET["school"])
                    ->latest()
                    ->paginate($_GET['paginate']);
            }
        }

        

        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        foreach($request->users as $userId){
            Notification::create([
                "title" => "Tugas Baru Untuk Anda",
                "body" => $request->name,
                "user_id" => (int)$userId,
                "status" => "pending"
            ]);
        }

        $task = Task::create([
            "name" => $request->name,
            "description" => $request->description,
            "school_id" => $request->school_id,
            "status" => "progress",
        ]);

        $task->users()->attach($request->users);

        return response()->json([
            "message" => "Data proker berhasil ditambah"
        ]);
    }

    public function update(Request $request, $id)
    {
        Task::find($id)->update([
            "name" => $request->name,
            "description" => $request->description,
            "school_id" => $request->school_id,
            "status" => $request->status,
        ]);

        return response()->json([
            "message" => "Data proker berhasil diedit",
        ]);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        $task->users()->detach($id);
        $task->delete();

        return response()->json([
            "message" => "Data proker berhasil dihapus",
        ]);
    }
}
