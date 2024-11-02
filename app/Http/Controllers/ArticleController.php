<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        # simplePaginate() method is the best.
        $articles = Article::with(['user', 'tags'])->latest()->simplePaginate(5);

        return view('articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        return view('articles.create', $this->getFormData());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $article = Article::create([
            'slug' => Str::slug($request->title),
            'status' => $request->status === 'on',
            'user_id' => auth()->id()
        ] + $request->validated() );

        # Storing at pivot table
        $article->tags()->attach($request->tags);

        // return redirect()->route('dashboard');
        return redirect(route('articles.index'))
            ->with('message', 'El artículo ha sido creado con éxito');
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
    public function show(Article $article) : View
    {
        return view('articles.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', array_merge(compact('article'), $this->getFormData()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->update($request->validated() + [
            'slug' => Str::slug($request->title)
        ]);

        $article->tags()->sync($request->tags);

        // return redirect()->route('dashboard');
        return redirect(route('dashboard'))
            ->with('message', '¡El artículo ha sido actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }


    # Crear un método privado para evitar duplicados
    private function getFormData(): array
    {
        $categories = Category::pluck('name', 'id');
        $tags       = Tag::pluck('name', 'id');

        return compact('categories', 'tags');
    }
}
