<?php

namespace App\Http\Controllers;

use App\Models\{ School, User };
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = School::where("name", "!=", "FOSNAS ADMIN")
            ->where("name", "LIKE", "%" . $_GET["search"] . "%")
            ->latest()
            ->paginate($_GET['paginate']);

        return response()->json($schools);
    }

    public function store(Request $request)
    {
        School::create([
            "images" => "",
            "name" => $request->name,
            "address" => $request->address,
            "description" => $request->description,
            "map" => $request->map
        ]);

         return response()->json(["message" => "Sekolah berhasil ditambahkan"]);
    }

    public function show(string $id)
    {
        $school = School::find($id);

        return response()->json($school);
    }

    public function update(Request $request, string $id)
    {
        School::find($id)->update([
            "images" => "",
            "name" => $request->name,
            "address" => $request->address,
            "description" => $request->description,
            "map" => $request->map
        ]);

        return response()->json(["message" => "Sekolah berhasil diedit"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        School::whereId($id)->delete();

        // delete semua user dari sekolah tersebut
        $users = User::whereSchoolId($id)->get();
        foreach ($users as $user) {
            $user->delete();
        }

        return response()->json(["message" => "Data Sekolah Berhasil Dihapus"]);
    }
}
