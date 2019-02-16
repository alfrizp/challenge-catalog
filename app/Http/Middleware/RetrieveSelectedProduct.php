<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Product;

class RetrieveSelectedProduct
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $selectedProduct = null;
        if (in_array(request('action'), ['edit', 'delete']) && request('id') != null) {
            $selectedProduct = Product::findOrFail(request('id'));
        }

        $request->selectedProduct = $selectedProduct;
        return $next($request);
    }
}
