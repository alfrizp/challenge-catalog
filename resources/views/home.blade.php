@extends('layouts.app')
@section('title') {{ __('app.app_name') }} - {{ __('app.home') }} @endsection

@section('content')
<div class="row">
    <div class="col-md-12 mb-4 mt-5">
        <h2>List Produk</h2>
    </div>
</div>
<div class="row mb-3">
    @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img class="img-responsive" style="
                    height: 20rem;
                    background-image: url({{ $product->image_url }});
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position: 50% 50%;">
                <div class="card-body d-flex align-items-center flex-column">
                    <h4 class="card-title font-weight-bold">{{ $product->name }}</h4>
                    <h5 class="card-text font-weight-bold">{{ $product->format_price }}</h5>
                    <p>Supplier: <a href="#">{{ $product->supplier->name }}</a></p>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="row d-flex justify-content-center">
    {{ $products->links('layouts.partials.pagination') }}
</div>
@endsection

@push('head')
<style>
</style>
@endpush()

@push('end')
<script>

</script>
@endpush
