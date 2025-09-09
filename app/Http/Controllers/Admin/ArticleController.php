<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Articles;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Articles::all();
        return view('admin.articles.index', compact('articles'));
    }

    public function update(Request $request, $id)
    {
        $article = Articles::findOrFail($id);
        $article->publish = $article->publish === 1 ? 0 : 1;
        $article->save();

        return back()->with('success', 'Article publish status updated.');
    }
}
