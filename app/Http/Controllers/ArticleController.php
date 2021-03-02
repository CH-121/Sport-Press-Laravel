<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\Article;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function home(Request $request)
    {
        $sort = $request->get("sort", "id");
        $dir = $request->get("dir", "desc");

        if (!in_array($sort, array("title", "id", "views"))) {
            $sort = "id";
        }

        if ($sort == "views") {
            $all_articles = Article::all()->sort(function ($a, $b) {
                return $b->view_count - $a->view_count;
            })->toQuery()->paginate(2);
        } else {
            $all_articles = Article::orderBy($sort, $dir)->paginate(3);
        }

        $top_articles = Article::get()->sort(function ($a, $b) {
            return $b->view_count - $a->view_count;
        });

        return view('home', [
            'articles' => $all_articles,
            'top_articles' => $top_articles,
            'categories' => app(CategoryController::class)->allCategories(),
            'lastArticles' => $this->getLastArticles()
        ]);
    }


    public function articleDetail(Request $request, $id)
    {
        // Save the view
        View::insert(
            ['ip' => 'X', 'article_id' => $id, 'created_at' => Carbon::now()]
        );
        //details of article
        $article = Article::findOrFail($id);
        //suggestion
        $articles = Article::where('category_id', $article->category_id)->where('id', '!=', $id)->get();

        return view('articleDetail', [
            'article' => $article,
            'articles' => $articles
        ]);
    }

    public function getLastArticles()
    {
        return Article::orderBy('updated_at')->limit(5)->get();
    }
}
