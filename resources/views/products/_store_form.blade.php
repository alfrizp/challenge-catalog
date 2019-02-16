<div class="modal" id="productModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('product.add_product') }}</h5>
                    {{ link_to_route('products.index', '&times;', [], ['class' => 'close']) }}
                </div>
                {!! Form::open(['route' => 'products.store', 'files' => true]) !!}
                <div class="modal-body">
                    {!! FormField::text('name', [
                        'required' => true,
                        'label' => __('product.name'),
                        'placeholder' => __('product.name_placeholder')
                    ]) !!}
                    {!! FormField::select('supplier_id', $suppliers, [
                        'required' => true,
                        'label' => __('product.supplier_label'),
                        'placeholder' => __('product.supplier_placeholder'),
                        'class' => 'supplier_id-select2'
                    ]) !!}
                    <div class="form-group required ">
                        <label for="price" class="control-label">{{ __('product.price_label') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>
                            <input
                                class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                placeholder="{{ __('product.price_placeholder') }}"
                                name="price" type="number" id="number"
                                value="{{ request()->old('price') }}"
                            />
                        </div>
                        @if ($errors->has('price'))
                            <p class="text-danger">{{ $errors->first('price') }}</p>
                        @endif
                    </div>
                    <div class="form-group mt-4">
                        <input
                            name="is_active"
                            type="checkbox"
                            data-toggle="toggle"
                            data-on="{{__('product.active')}}"
                            data-off="{{__('product.in_active')}}"
                            data-onstyle="success"
                            data-offstyle="danger"
                            {{ request()->old('is_active') ? 'checked' : '' }}
                        />
                    </div>
                    {!! FormField::file('image') !!}
                </div>
                <div class="modal-footer">
                    {!! Form::submit(__('product.save'), ['class' => 'btn btn-primary']) !!}
                    {{ link_to_route('products.index', __('product.cancel'), [], ['class' => 'btn btn-secondary']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
