<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET["school"]) && $_GET["school"] != "") {
            if (isset($_GET["search"]) && $_GET["search"] != "") {
                $users = User::where("school_id", $_GET['school'])
                    ->where("name", "LIKE", "%" . $_GET["search"] . "%")
                    ->with(['roles', 'school'])
                    ->latest()
                    ->paginate(10);
            } else {
                $users = User::where("school_id", $_GET['school'])
                    ->with(['roles', 'school'])
                    ->latest()
                    ->paginate(10);
            }
        } else {
            if (isset($_GET["search"]) && $_GET["search"] != "") {
                $users = User::whereNotIn('name', ['admin'])
                    ->where("name", $_GET['search'])
                    ->orWhere("name", "LIKE", "%" . $_GET["search"] . "%")
                    ->with(['roles', 'school'])
                    ->latest()
                    ->paginate(10);
            } else {
                $users = User::whereNotIn('name', ['admin'])->with(['roles', 'school'])->paginate(10);
            }
        }

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->profile) {
            $imageName = time() . '.' . $request->profile->getClientOriginalExtension();
            $request->profile->move(public_path('images/profiles/'), $imageName);
        } else {
            $imageNames = [
                "avatar-1.png",
                "avatar-2.png",
                "avatar-3.png",
                "avatar-4.png",
                "avatar-5.png",
            ];
            $imageName = $imageNames[array_rand($imageNames)];
        }


        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "school_id" => $request->school_id,
            "profile" => $imageName
        ])->assignRole($request->role);

        return response()->json([
            "message" => "Berhasil menambah user"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if ($request->role == "pengurus osis") {
            $user->removeRole('anggota');
        } else {
            $user->removeRole('pengurus osis');
        }

        $user->update([
            "name" => $request->name,
            "email" => $request->email,
        ]);

        $user->assignRole($request->role);


        return response()->json([
            "message" => "Berhasil mengedit user"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::whereId($id)->delete();
        return response()->json(["message" => "Data User Berhasil Dihapus"]);
    }
}
