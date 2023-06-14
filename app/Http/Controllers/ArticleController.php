<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET["search"]) && $_GET["search"] != "") {
            $articles = Article::with("school")
                ->where("title", $_GET['search'])
                ->orWhere("title", "LIKE", "%" . $_GET["search"] . "%")
                ->latest()
                ->get();;
        } else {
            $articles = Article::with("school")->latest()->get();
        }
        return response()->json($articles);
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
        Article::create([
            "title" => $request->title,
            "body" => $request->body,
            "slug" => Str::slug($request->title),
            "image" => "-",
            "school_id" => $request->school_id,
        ]);

        return response()->json([
            "message" => "Berhasil menambah artikel"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $article = Article::whereSlug($slug)->first();

        return response()->json($article);
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
        //
    }
}
