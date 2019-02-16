<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Supplier;
use App\Http\Requests\Suppliers\CreateRequest;
use App\Http\Requests\Suppliers\UpdateRequest;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('retrieve.supplier')->only('index');
    }

    public function index()
    {
        $selectedSupplier = request()->selectedSupplier;
        $suppliers = Supplier::orderBy('updated_at', 'desc')->paginate(10);

        $cities = City::all()->pluck('title', 'id');
        $years = get_year_range(1945, 2018);

        return view('suppliers.index', compact('selectedSupplier', 'suppliers', 'cities', 'years'));
    }

    public function store(CreateRequest $supplierCreateForm)
    {
        $supplierCreateForm->save();

        flash(__('supplier.created'), 'success');

        return redirect()->route('suppliers.index');
    }

    public function update(UpdateRequest $supplierUpdateForm, Supplier $supplier)
    {
        $supplierUpdateForm->save();

        flash(__('supplier.updated'), 'success');

        return redirect()->route('suppliers.index');
    }

    public function destroy(Supplier $supplier)
    {
        // Delete associate product
        $supplier->products()->get()->each(function($product) {
            $product->delete();
        });

        $supplier->delete();

        flash(__('supplier.deleted'), 'success');

        return redirect()->route('suppliers.index');
    }
}
