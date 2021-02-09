<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\CreateProductStep1Request;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Product\Category;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:products-read'])->only(['index', 'show']);
        $this->middleware(['permission:products-create'])->only(['create', 'store']);
        $this->middleware(['permission:products-update'])->only(['update', 'edit']);
        $this->middleware(['permission:products-delete'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = null;
        $categoryIds = [];
        $mainCategories = collect();
        if ($request->has('category')) {
            $category =  Category::whereId(request('category'))->first();
            $categoryIds = $category->ids();
        } else {
            $mainCategories = Category::whereNull("parent_id")->get();
        }

        $products = Product::latest()
            ->when($request->has('category'), function (Builder $query) use ($categoryIds) {
                return $query->whereHas("category", function (Builder $catQuery) use ($categoryIds) {
                    return $catQuery->whereIn("id", $categoryIds);
                });
            })
            ->with(['translations', 'media', 'category.translations'])
            ->withCount(['complaints'])
            ->paginate(10);
        return view('admin.products.crud.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->with(['translations'])->get();
        return view('admin.products.crud.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductStep1Request $request)
    {
        $product = Product::create($request->only(array_merge(locales(), ['price', 'amount', 'video_url', 'category_id'])));
        return redirect(route('admin.product.show', $product))->withSuccess("product {$product->title} created succfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load(['category.translations', 'media', 'options.translations', 'options.values.translations'])->loadCount(['complaints']);
        return view('admin.products.crud.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::latest()->with(['translations'])->get();
        return view('admin.products.crud.edit',  get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->only(array_merge(locales(), ['price', 'amount', 'video_url', 'category_id'])));
        return redirect(route('admin.product.show', $product))->withSuccess("product {$product->title} Updated succfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route('admin.product.index'))->withSuccess("product {$product->title} deleted succfully");
    }

    public function uploadImages(Request $request, Product $product)
    {
        $request->validate(['images' => ['required', 'array', 'min:1'], 'images.*' => ['file', 'image', 'mimes:png,jpg,jpeg']]);
        collect($request->images)->map(function ($image) use ($product) {
            $product->addMedia($image)->toMediaCollection('images');
        });
        return redirect(route('admin.product.show', ['product' => $product]))->withSuccess("product images updated succfully");
    }

    public function deleteImage(Product $product, Media $image)
    {
        $image->delete();
        return redirect(route('admin.product.show', ['product' => $product]))->withSuccess("image deleted succfully");
    }

    public function upload(Product $product)
    {
        return view('admin.products.crud.upload_images', ['product' => $product]);
    }
}
