<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

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
