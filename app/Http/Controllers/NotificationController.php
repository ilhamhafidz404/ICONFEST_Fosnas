<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ Notification, User };

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::whereUserId($_GET["user_id"])->latest()->get();
        return response()->json($notifications);
    }

    public function store(Request $request){

        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin sekolah');
        })->where("school_id", $request->id)->first();

        if($user){
            Notification::create([
                "title" => $request->name." Meminta Keanggotaan",
                "type" => "request",
                "body" => "Pastikan ".$request->name." adalah anggota anda sebelum terima keanggotaan.",
                "user_id" => $user->id,
                "status" => "pending"
            ]);
        } 

        return response()->json($user);
    }

    public function update(Request $request, string $id)
    {
        $notifications = Notification::whereUserId($_GET["user_id"])->get();

        foreach($notifications as $notification){
            $notification->update([
                "status" => "read"
            ]);
        }

        return response()->json([
            "message" => "notifikasi telah dibaca"
        ]);
    }

    public function destroy(string $id)
    {
        //
    }
}
