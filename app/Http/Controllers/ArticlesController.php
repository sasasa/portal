<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{

    public function index(Request $req)
    {
        $article_query = \App\Article::query();

        if ($req->article_title) {
            $article_query->where('article_title', 'LIKE', "%".$req->article_title."%");
        }
        if ($req->article_content) {
            $article_query->where('article_content', 'LIKE', "%".$req->article_content."%");
        }

        return view('articles.index', [
            'articles' => $article_query->orderBy('id', 'desc')->paginate(10),
            'article_title' => $req->article_title,
            'article_content' => $req->article_content,
        ]);
    }


    public function create()
    {
        return view('articles.create', [
        ]);
    }


    public function store(Request $req)
    {
        $this->validate($req, \App\Article::$rules);
        $file = $req->upfile;
        $file_name = basename($file->store('public'));
        $article = new \App\Article();
        $article->fill($req->all());
        $article->article_path = $file_name;
        $article->save();

        return redirect('/articles');
    }

    public function show(\App\Article $article)
    {
        return view('articles.show', [
            'article' => $article
        ]);
    }

    public function edit(\App\Article $article)
    {
        return view('articles.edit', [
            'article' => $article
        ]);
    }

    public function update(Request $req, \App\Article $article)
    {
        $this->validate($req, \App\Article::$update_rules);
        $article->fill($req->all());
        $article->save();

        return redirect('/articles');
    }

    public function destroy(\App\Article $article)
    {
        Storage::disk('public')->delete($article->article_path);
        $article->delete();

        return redirect('/articles');
    }
}
