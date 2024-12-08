<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();

        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validator = validator(request()->all(), [
        //     'title' => 'required',
        //     'body' => 'required',
        //     'category_id' => 'required',
        //     'image' => 'image|mimes:jpg,jpeg,png,gif|max:1024',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(
        //         ['errors' => $validator->errors()],
        //     );
        // }

        // $article = new Article();
        // $article->title = request()->title;
        // $article->body = request()->body;
        // $article->category_id = request()->category_id;
        // $article->user_id = $request->user()->id;

        // if (request()->hasFile('image')) {
        //     $file = request()->file('image');
        //     $file_name = time() . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('articles', $file_name, 'public');
        //     $article->image = $file_name;
        // }
        // $article->save();

        // $article->tags()->attach(request()->tags);

        $fields = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        $article = $request->user()->articles()->create($fields);

        return response()->json($article, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(
                ['message' => 'Not found!'],
                404,
            );
        }

        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $validator = validator(request()->all(), [
        //     'title' => 'required|max:255',
        //     'body' => 'required',
        //     'category_id' => 'required',
        //     'image' => 'image|mimes:jpg,jpeg,png,gif|max:1024',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(
        //         ['errors' => $validator->errors()],
        //     );
        // }

        $article = Article::find($id);
        // $article->title = request()->title;
        // $article->body = request()->body;
        // $article->category_id = request()->category_id;

        // if (request()->hasFile('image')) {
        //     $file = request()->file('image');
        //     $file_name = time() . '.' . $file->getClientOriginalExtension();
        //     $file->storeAs('articles', $file_name, 'public');
        //     $article->image = $file_name;
        // }
        // $article->save();
        // $article->tags()->sync(request()->tags);

        $fields = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        $article->update($fields);

        return response()->json($article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(
                ['message' => 'Not found!'],
                404,
            );
        }

        $article->delete();

        return response()->json(
            ['message' => 'Successfully deleted!'],
        );
    }
}
