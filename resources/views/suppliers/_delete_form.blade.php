<div class="modal" id="supplierModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('supplier.delete_supplier') }}</h5>
                {{ link_to_route('suppliers.index', '&times;', [], ['class' => 'close']) }}
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('supplier.name') }}</label>
                        <p>{!! $selectedSupplier->name !!}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('supplier.email') }}</label>
                        <p>{{ $selectedSupplier->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('supplier.city_label') }}</label>
                        <p>{{ $selectedSupplier->city->title }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">{{ __('app.age') }}</label>
                        <p>{{ $selectedSupplier->age }} tahun</p>
                    </div>
                </div>
            </div>
            <hr style="margin:0">
            <div class="modal-body">{{ __('supplier.delete_confirm') }}</div>
            <div class="modal-footer">
                {!! FormField::delete(
                ['route' => ['suppliers.destroy', $selectedSupplier], 'class' => ''],
                __('supplier.delete_confirm_btn'),
                ['class'=>'btn btn-danger'],
                []
                ) !!}
                {{ link_to_route('suppliers.index', __('supplier.cancel'), [], ['class' => 'btn btn-secondary']) }}
            </div>
        </div>
    </div>
</div>
