@extends('layouts.app')
@section('title') {{ __('app.app_name') }} - {{ __('product.title') }} @endsection

@section('content')
<div class="row">
    <div class="col-lg-12 mb-4 mt-5">
        <h2>{{ __('product.title_h2') }}</h2>
    </div>
</div>
<div class="row mb-3">
    <div class="col-lg-12">
        {{ link_to_route(
            'products.index',
            __('product.add_product'),
            ['action' => 'create'],
            ['class' => 'btn btn-success float-right']
        ) }}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">{{ __('app.name') }}</th>
                    <th scope="col">{{ __('app.supplier') }}</th>
                    <th scope="col">{{ __('app.price') }}</th>
                    <th scope="col">{{ __('app.status') }}</th>
                    <th scope="col">{{ __('app.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->supplier->name }}</td>
                        <td>{{ $product->format_price }}</td>
                        <td>{!! $product->status_label !!}</td>
                        <td>
                            {{ link_to_route(
                                'products.index',
                                __('app.edit'),
                                ['action' => 'edit', 'id' => $product->id],
                                [
                                    'id' => 'edit-product-'.$product->id,
                                    'class' => 'btn btn-primary',
                                ]
                            ) }}
                            {!! link_to_route(
                                'products.index',
                                __('app.delete'),
                                ['action' => 'delete', 'id' => $product->id],
                                ['id' => 'del-product-'.$product->id, 'class' => 'btn btn-danger']
                            ) !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $products->links('layouts.partials.pagination') }}
        </div>
    </div>
    <div class="col-md-4">
        @if(Request::has('action'))
            @include('products.forms')
        @endif
    </div>
</div>
<hr class="featurette-divider">
@endsection

@push('head')
    {{ Html::style(url('css/plugins/bootstrap4-toggle.min.css')) }}
    {{ Html::style(url('css/plugins/select2.min.css')) }}
@endpush()

@push('end')
    {{ Html::script(url('js/plugins/bootstrap4-toggle.min.js')) }}
    {{ Html::script(url('js/plugins/select2.min.js')) }}
<script>
(function () {
    $('#productModal').modal({
        show: true,
        backdrop: 'static',
    });
    $('.supplier_id-select2').select2();
})();
</script>
@endpush
