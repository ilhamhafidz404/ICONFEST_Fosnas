<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET['search']) && $_GET != "") {
            $schools = School::where("name", "!=", "FOSNAS ADMIN")
                ->where("name", $_GET['search'])
                ->orWhere("name", "LIKE", "%" . $_GET["search"] . "%")
                ->latest()
                ->get();
        } else {
            $schools = School::where("name", "!=", "FOSNAS ADMIN")->latest()->get();
        }
        return response()->json($schools);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        School::whereId($id)->delete();

        return response()->json(["message" => "Data Sekolah Berhasil Dihapus"]);
    }
}
