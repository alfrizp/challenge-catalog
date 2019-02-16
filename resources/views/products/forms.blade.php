@if (request('action') == 'create')
    @include('products._store_form')
@endif

@if (request('action') == 'edit' && $selectedProduct)
    @include('products._update_form')
@endif

@if (request('action') == 'delete' && $selectedProduct)
    @include('products._delete_form')
@endif
