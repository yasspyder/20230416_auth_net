<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;

class IndexNewsController extends Controller
{
    public function index()
    {
        return view('news.index', ['news' => News::paginate(15)]);
    }

    public function newsCategory(
        $categoryId,
        Category $categories)
    {
        $news = Category::findOrFail($categoryId)
            ->news()
            ->paginate(15);
        $categories = Category::all();
        $categoryName = $categories->where('id', $categoryId)
            ->pluck('category_name')
            ->get(0);
        return view(
            'news.news_category',
            [
                'news' => $news,
                'categories' => $categories
            ]
        )->with('categoryName', $categoryName);
    }

    public function newsItem(News $news)
    {
        return view(
            'news.news_item',
            ['news' => $news]
        );
    }
}
