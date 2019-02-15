<div class="modal" id="supplierModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('supplier.edit_supplier') }}</h5>
                {{ link_to_route('suppliers.index', '&times;', [], ['class' => 'close']) }}
            </div>
            {!! Form::model($selectedSupplier, ['route' => ['suppliers.update', $selectedSupplier], 'method' =>
            'patch']) !!}
            <div class="modal-body">
                {!! FormField::text('name', [
                'required' => true,
                'label' => __('supplier.name'),
                'placeholder' => __('supplier.name_placeholder')
                ]) !!}
                {!! FormField::email('email', [
                'label' => __('supplier.email'),
                'placeholder' => __('supplier.email_placeholder'),
                'disabled' => 'disabled',
                ]) !!}
                {!! FormField::select('city_id', $cities, [
                'required' => true,
                'label' => __('supplier.city_label'),
                'placeholder' => __('supplier.city_placeholder'),
                'class' => 'city_id-select2'
                ]) !!}
                {!! FormField::select('birth_year', $years, [
                'required' => true,
                'label' => __('supplier.birth_year_label'),
                'placeholder' => __('supplier.birth_year_placeholder'),
                'class' => 'birth_year-select2'
                ]) !!}
            </div>
            <div class="modal-footer">
                {!! Form::submit(__('supplier.edit'), ['class' => 'btn btn-primary']) !!}
                {{ link_to_route('suppliers.index', __('supplier.cancel'), [], ['class' => 'btn btn-secondary']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
