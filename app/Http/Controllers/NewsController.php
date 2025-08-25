<?php
// app/Http/Controllers/NewsController.php
namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('status', 'published')
                   ->with('author')
                   ->latest()
                   ->paginate(10);

        return view('news.index', compact('news'));
    }

    public function show($slug)
    {
        $article = News::where('slug', $slug)
                      ->where('status', 'published')
                      ->with('author')
                      ->firstOrFail();

        return view('news.show', compact('article'));
    }
}