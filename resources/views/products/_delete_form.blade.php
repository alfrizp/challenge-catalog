<div class="modal" id="productModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('product.delete_product') }}</h5>
                    {{ link_to_route('products.index', '&times;', [], ['class' => 'close']) }}
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="font-weight-bold">{{ __('app.name') }}</label>
                            <p>{{ $selectedProduct->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="font-weight-bold">{{ __('app.supplier') }}</label>
                            <p>{{ $selectedProduct->supplier->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="font-weight-bold">{{ __('app.price') }}</label>
                            <p>{{ $selectedProduct->format_price }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="font-weight-bold">{{ __('app.status') }}</label>
                            <p>{!! $selectedProduct->status_label !!}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="font-weight-bold">{{ __('app.image') }}</label>
                            <img class="img-thumbnail" src="{{ $selectedProduct->image_url }}">
                        </div>
                    </div>
                </div>
                <hr style="margin:0">
                <div class="modal-body">{{ __('product.delete_confirm') }}</div>
                <div class="modal-footer">
                    {!! FormField::delete(
                    ['route' => ['products.destroy', $selectedProduct], 'class' => ''],
                    __('product.delete_confirm_btn'),
                    ['class'=>'btn btn-danger'],
                    []
                    ) !!}
                    {{ link_to_route('products.index', __('product.cancel'), [], ['class' => 'btn btn-secondary']) }}
                </div>
            </div>
        </div>
    </div>
