<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product\Category;
use App\Models\Product\OrderItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $topSellingPartyItems = collect();
        $topSellingCakeItems = collect();
        if($partyCategory = Category::find(2)){
            $topSellingPartyItems = $this->topSellingItems($partyCategory);
        }
        if($cakeCategory = Category::find(1)){
            $topSellingCakeItems = $this->topSellingItems($cakeCategory);
        }
        return view('site.index' , [
            'topSellingPartyItems' => $topSellingPartyItems,
            'topSellingCakeItems' => $topSellingCakeItems
        ]);
    }

    public function topSellingItems($category, $limit = 10)
    {
        return OrderItem::select(\DB::raw('*, COUNT(product_id) as product_amount'))
            ->with([
                'product' => function ($productQuery) {
                    return $productQuery->with(['media', 'translations']);
                },
                'order'
            ])
            ->whereHas('order', function ($orderQuery) {
                return $orderQuery->wherePaymentStatus(true);
            })->whereHas('product', function ($productQuery) use ($category) {
                return $productQuery->whereHas("category", function ($categoryQuery) use ($category) {
                    return $categoryQuery->whereIn("id", $category->ids() ?? []);
                });
            })
            ->limit($limit)
            ->groupBy('product_id')
            ->orderBy('product_amount', 'desc')
            ->get();
    }
}
