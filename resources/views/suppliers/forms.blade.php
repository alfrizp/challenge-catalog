@if (request('action') == 'create')
    @include('suppliers._store_form')
@endif

@if (request('action') == 'edit' && $selectedSupplier)
    @include('suppliers._update_form')
@endif

@if (request('action') == 'delete' && $selectedSupplier)
    @include('suppliers._delete_form')
@endif
