<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Supplier;

class RetrieveSelectedSupplier
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
        $selectedSupplier = null;
        if (in_array(request('action'), ['edit', 'delete']) && request('id') != null) {
            $selectedSupplier = Supplier::findOrFail(request('id'));
        }

        $request->selectedSupplier = $selectedSupplier;
        return $next($request);
    }
}
