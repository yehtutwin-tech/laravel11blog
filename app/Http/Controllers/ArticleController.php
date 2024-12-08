<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        // $articles = [
        //     ['id' => 1, 'title' => 'Article 1'],
        //     ['id' => 2, 'title' => 'Article 2'],
        // ];

        $articles = Article::latest()->paginate(2);

        // return view('articles.index', ['articles' => $articles]);

        // return view('articles.index', compact('articles'));

        return view('articles.index')->with('articles', $articles);
    }

    public function show($id)
    {
        $article = Article::find($id);
        // SELECT * FROM articles WHERE id=$id;

        // dd($article->category);

        // dd($article->tags->pluck('name')->implode(', '));

        // dd($article->comments);
        // SELECT * FROM `comments` WHERE article_id=1;

        return view('articles.show')->with('article', $article);
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $article->tags()->detach();
        $article->delete();

        return redirect('/articles')
            ->with('info', 'An article has been deleted!');
    }

    public function create()
    {
        $categories = Category::all();

        $tags = Tag::all();

        // $cat1 = new \stdClass();
        // $cat1->id = 1;
        // $cat1->name = 'Books';
        // $categories[] = $cat1;

        // $cat2 = new \stdClass();
        // $cat2->id = 2;
        // $cat2->name = 'Electronics';
        // $categories[] = $cat2;

        // dd($categories);

        return view('articles.create')
            ->with('tags', $tags)
            ->with('categories', $categories);
    }

    public function store()
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:1024',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $article = new Article();
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;

        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('articles', $file_name, 'public');
            $article->image = $file_name;
        }
        $article->save();

        $article->tags()->attach(request()->tags);

        return redirect('/articles')
            ->with('info', 'An article has been created!');
    }

    public function edit($id)
    {
        $tags = Tag::all();
        $article = Article::find($id);
        $categories = Category::all();

        return view('articles.edit')
            ->with('article', $article)
            ->with('tags', $tags)
            ->with('categories', $categories);
    }

    public function update($id)
    {
        $validator = validator(request()->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:1024',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $article = Article::find($id);
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;

        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('articles', $file_name, 'public');
            $article->image = $file_name;
        }
        $article->save();
        $article->tags()->sync(request()->tags);

        return redirect('/articles')
            ->with('info', 'An article has been updated!');
    }
}
