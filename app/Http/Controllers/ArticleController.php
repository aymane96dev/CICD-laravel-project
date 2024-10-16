<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        return response()
            ->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $article = new Article;
 
        $article->title = $request->title;
        $article->body = $request->body;
        
        $category = Category::find($request->category_id);
        if($category)
        {
            $article->category_id = $request->category_id;
        }
        else {
            return response()
            ->json(['error' => 'there is no category found']);
        }

        $article->save();
        
        return response('new article added',201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::find($id);

        return response()
            ->json($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::find($id);
 
        $article->title = $request->title;
        $article->body = $request->body;
        
        $category = Category::find($request->category_id);
        if($category)
        {
            $article->category_id = $request->category_id;
        }
        else {
            return response()
            ->json(['error' => 'there is no category found']);
        }

        $article->save();

        return response('article given updated',201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = Article::destroy($id);

        return response()
            ->json(['deleted' => $deleted]);
    }
}
