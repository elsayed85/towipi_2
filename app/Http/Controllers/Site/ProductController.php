<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()->with(['media', 'translations', 'category' => function ($q) {
            return $q->with(['media', 'translations']);
        }]);

        $products->when($request->has('categories') && is_array($request->categories), function (Builder $q) {
            return $q->whereHas('category', function (Builder $categoriesQuery) {
                $categoriesQuery->whereIn("id", request('categories'));
            });
        });

        $products->when($request->has('category'), function (Builder $q) {
            return $q->where('category_id', request('category'));
        });

        $products->when($request->has('product_title'), function ($q) use ($request) {
            return $q->whereTranslationLike('title', "%{$request->product_title}%");
        });

        $products = $products->paginate(30);
        $categories = collect($products->items())
            ->pluck('category')
            ->unique()
            ->when($request->has('categories') && is_array($request->categories), function ($collection) {
                return $collection->filter(function ($el) {
                    return !in_array($el->id, request('categories'));
                });
            })->when($request->has('category'), function ($collection) {
                return $collection->filter(function ($el) {
                    return $el->id != request('category');
                });
            });
        return view('site.products.index', [
            'products' => $products,
            "categories" => $categories
        ]);
    }

    public function show(Product $product)
    {
        $product = $product->load([
            'options' => function ($q) {
                return $q->with(['translations', 'values.translations']);
            },
            'rates' => function ($q) {
                return $q->latest()->limit(4)->with(['user:id,fname,lname']);
            }
        ]);
        $dataCount = collect();
        $dataPercent = collect();
        $ratings = $product->rates;
        if ($ratings && $product->rates->sum("value") > 0) {
            for ($i = 1; $i <= 5; $i++) {
                $count = $ratings->filter(function ($rating) use ($i) {
                    if ($rating->value == $i) {
                        return $rating;
                    }
                })->count();
                $dataCount->put($i, $count);
            }
            $sum = $dataCount->sum();
            for ($i = 1; $i <= 5; $i++) {
                $dataPercent->put($i, ($dataCount[$i] / $sum) * 100);
            }
        }
        $averageRating = $product->rates()->avg('value');
        $related = $product->category->allProducts()->with(['translations', 'media'])->get();
        return view('site.products.show', get_defined_vars());
    }
}
