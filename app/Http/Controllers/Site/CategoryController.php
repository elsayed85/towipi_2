<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request, Category $category)
    {
        abort_unless($category->isMain(), 404);
        $categories = $category->childs()->latest()->with(['media', 'translation'])->paginate(9);
        return view('site.category.list', get_defined_vars());
    }
}
