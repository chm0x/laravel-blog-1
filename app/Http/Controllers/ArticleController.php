<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        # simplePaginate() method is the best.
        $articles = Article::with(['user', 'tags'])->latest()->simplePaginate(5);

        return view('articles.index', ['articles' => $articles]);
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
        
    }

    /**
     * Display the specified resource.
     */

     /**
      * Route Model Binding.
      * Its a technique used in Laravel to automatically inject a model
      * instance into a controller method based on the Value of a 
      * wildcard and the URI.
      * This allows you to easily retrieve a model from the database
      * without having to manually query the database. 

      * By default, Route Model Binding ONLY WORKS with the ID column.
      * Laravel allows you to Override a Method in the Desired Model
      */
    public function show(Article $article)
    {
        return view('articles.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
