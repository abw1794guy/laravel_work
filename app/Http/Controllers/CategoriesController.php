<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
        // 讀取分類 ID 關聯的話題，並按每 20 條分頁
        $topics = Topic::where('category_id', $category->id)->paginate(20);
        // 傳參變量話題和分類到模板中
        return view('topics.index', compact('topics', 'category'));
    }
}
