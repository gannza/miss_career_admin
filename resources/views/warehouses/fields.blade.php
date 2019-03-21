<!-- Client type Field -->
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('model', 'Model:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::select('model_id', $models, null, ['class' => 'form-control']) !!}
</div>
    
</div>

<!-- Qty Field -->
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('added_qty', 'Quantity:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::text('added_qty', null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-9">
    {!! Form::text('transfer', null, ['class' => 'form-control hidden']) !!}
    </div>

</div>
<!-- Submit Field -->
<div class="form-group float-right">
<div class="col-lg-9 col-lg-offset-3">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('warehouses.index') !!}" class="btn btn-default pull-right">Cancel</a>
</div>
</div>
