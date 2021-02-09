<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\ReturnedItem;
use Illuminate\Http\Request;

class ReturnedItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:products-read'])->only(['index', 'returnedItemAction']);
    }

    public function index()
    {
        $items = ReturnedItem::latest()->with(['product.translations', 'order'])->paginate(10);
        return view('admin.products.items.returned', get_defined_vars());
    }

    public function changeState(Request $request, ReturnedItem $item)
    {
        if ($request->action_name == "accept") {
            $item->update(['accepeted' => true]);
        } elseif ($request->action_name == "reject") {
            $item->update(['accepeted' => false]);
        } elseif ($request->action_name == "waiting") {
            $item->update(['accepeted' => null]);
        }
        return redirect(route('admin.product.returned.index'))->withSuccess('done');
    }

    public function destroy(ReturnedItem $item)
    {
        $item->delete();
        return redirect(route('admin.product.returned.index'))->withSuccess("item {$item->id} deletdd succfully");
    }
}
