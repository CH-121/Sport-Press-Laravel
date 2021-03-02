<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //
    public function front()
    {
        return view(
            'front',
            [
                'categories' => $this->allCategories()
            ]
        );
    }

    public function categoryPage($name)
    {
        $data = $this->getCategoryArticles($name);
        return view(
            'categoryArticles',
            [
                'category' => $data['category'],
                'articles' => $data['articles'],
                'categories' => $this->allCategories()
            ]
        );
    }

    public function getCategoryArticles($name)
    {
        $category = Category::where('name', $name)->first();

        //$articles = $category->articles();

        $articles = DB::table('articles')->where('category_id', $category->id)
            ->orderBy('updated_at')
            ->get();

        return ['articles' => $articles, 'category' => $category];
    }
    public function allCategories()
    {
        return Category::orderBy('name')->get();
    }
}
