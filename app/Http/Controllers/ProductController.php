<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use App\Models\Supplier;
use App\Http\Requests\Products\CreateRequest;
use App\Http\Requests\Products\UpdateRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('retrieve.product')->only('index');
    }

    public function index()
    {
        $selectedProduct = request()->selectedProduct;
        $products = Product::orderBy('updated_at', 'desc')->paginate(10);
        $suppliers = Supplier::all()->pluck('name', 'id');

        return view('products.index', compact('selectedProduct', 'products', 'suppliers'));
    }

    public function store(CreateRequest $productCreateForm)
    {
        $productCreateForm->save();

        flash(__('product.created'), 'success');

        return redirect()->route('products.index');
    }

    public function update(UpdateRequest $productUpdateForm, Product $product)
    {
        $productUpdateForm->save();

        flash(__('product.updated'), 'success');

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        Storage::delete($product->image_file);
        $product->delete();

        flash(__('product.deleted'), 'success');

        return redirect()->route('products.index');
    }
}
