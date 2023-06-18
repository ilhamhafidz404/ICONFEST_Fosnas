<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    public function index()
    {
        // cek jika data get kosong
        if($_GET["school"] == 0){
            return response()->json([
                "message" => "Tidak memenuhi syarat get data"
            ]);
        }


        // $users = User::where("name", "LIKE", "%" . $_GET["search"] . "%")
        //     ->with(['roles' => function ($query) {
        //         $query->select('name');
        //     }, 'school'])
        //     ->latest()
        //     ->paginate($_GET['paginate']);

        $users = User::where("name", "LIKE", "%" . $_GET["search"] . "%")
            ->when($_GET["school"] == 1, function ($query) {
                return $query->with(['roles' => function ($query) {
                    $query->select('name');
                }]);
            }, function ($query) {
                return $query->where("school_id", $_GET['school'])
                    ->with(['roles' => function ($query) {
                        $query->select('name');
                    }]);
            })
            ->with('school')
            ->latest()
            ->paginate($_GET['paginate']);

        return response()->json($users);
    }

    public function store(UserRequest $request)
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

    public function update(Request $request, string $id)
    {
        // cari user dengan id yang dikirimkan
        $user = User::find($id);

        // remove role dulu
        if ($request->role == "pengurus osis") {
            $user->removeRole('anggota');
        } else {
            $user->removeRole('pengurus osis');
        }

        // jika mengirim data profile baru
        if ($request->uploadProfile) {
            // hapus data image dulu
            $image_path = public_path("/images/profiles/" . $user->profile);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            //
            $imageName = time() . '.' . $request->file('profile')->getClientOriginalExtension();
            $request->profile->move(public_path('images/profiles/'), $imageName);
        } else {
            $imageName = $user->profile;
        }

        $user->update([
            "name" => $request->name,
            "email" => $request->email,
            "profile" => $imageName
        ]);
        // kasih role baru
        $user->assignRole($request->role);

        return response()->json([
            "message" => "Berhasil mengedit user"
        ]);
    }

    public function destroy(string $id)
    {
        $user = User::whereId($id)->first();

        // hapus dulu image-nya
        $image_path = public_path("/images/profiles/" . $user->profile);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $user->delete();

        return response()->json(["message" => "Data User Berhasil Dihapus"]);
    }
}
