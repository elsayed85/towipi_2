<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\OptionRequest;
use App\Models\Product\Option;
use App\Models\Product\OptionValue;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function create(Product $product)
    {
        return view('admin.products.options.create', get_defined_vars());
    }

    public function store(OptionRequest $request, Product $product)
    {
        $option = $product->options()->create([
            "en" => [
                'name' => $request->option_name
            ]
        ]);
        if (count($request->values)) {
            $option->values()->saveMany(collect($request->values)->map(function ($el) {
                return new OptionValue([
                    'en' => [
                        'value' => $el
                    ]
                ]);
            }));
        }
        return redirect(route('admin.product.show', $product))->withSuccess("option {$request->option_name} addedd succfully");
    }

    public function deleteOption(Product $product, Option $option)
    {
        $option->delete();
        return redirect(route('admin.product.show', $product))->withSuccess("option {$option->name} deleted succfully");
    }

    public function deleteOptionValue(Product $product, OptionValue $value)
    {
        $value->delete();
        return redirect(route('admin.product.show', $product))->withSuccess("option value {$value->value} deleted succfully");
    }
}
