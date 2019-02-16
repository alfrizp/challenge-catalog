@extends('layouts.app')
@section('title') {{ __('app.app_name') }} - {{ __('supplier.title') }} @endsection

@section('content')
<div class="row">
    <div class="col-md-12 mb-4 mt-5">
        <h2>{{ __('supplier.title_h2') }}</h2>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12">
        {{ link_to_route(
            'suppliers.index',
            __('supplier.add_supplier'),
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
                    <th scope="col">{{ __('app.email') }}</th>
                    <th scope="col">{{ __('app.city') }}</th>
                    <th scope="col">{{ __('app.age') }}</th>
                    <th scope="col">{{ __('app.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>{{ $supplier->city->title }}</td>
                        <td>{{ $supplier->age }} tahun</td>
                        <td>
                            {{ link_to_route(
                                'suppliers.index',
                                __('app.edit'),
                                ['action' => 'edit', 'id' => $supplier->id],
                                [
                                    'id' => 'edit-supplier-'.$supplier->id,
                                    'class' => 'btn btn-primary',
                                ]
                            ) }}
                            {!! link_to_route(
                                'suppliers.index',
                                __('app.delete'),
                                ['action' => 'delete', 'id' => $supplier->id],
                                ['id' => 'del-supplier-'.$supplier->id, 'class' => 'btn btn-danger']
                            ) !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $suppliers->links('layouts.partials.pagination') }}
        </div>
    </div>
    <div class="col-md-4">
        @if(Request::has('action'))
            @include('suppliers.forms')
        @endif
    </div>
</div>
<hr class="featurette-divider">
@endsection

@push('head')
    {{ Html::style(url('css/plugins/select2.min.css')) }}
@endpush()

@push('end')
    {{ Html::script(url('js/plugins/select2.min.js')) }}
<script>
(function () {
    $('#supplierModal').modal({
        show: true,
        backdrop: 'static',
    });
    $('.city_id-select2').select2();
    $('.birth_year-select2').select2();
})();
</script>
@endpush
