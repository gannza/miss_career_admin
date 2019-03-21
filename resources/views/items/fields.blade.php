<!-- Name Field -->
<div class="form-group row">
		                                
    {!! Form::label('name', 'Name:',['class' => 'col-sm-3']) !!}
    {!! Form::text('name', null, ['class' => 'form-control col-sm-9']) !!}
</div>

<!-- Cost Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cost_price', 'Cost Price:') !!}
    {!! Form::number('cost_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Sale Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sale_price', 'Sale Price:') !!}
    {!! Form::number('sale_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Barcode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('barcode', 'Barcode:') !!}
    {!! Form::text('barcode', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('items.index') !!}" class="btn btn-default">Cancel</a>
</div>
