<!-- Qty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qty', 'Qty:') !!}
    {!! Form::text('qty', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Entered Qty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_entered_qty', 'Total Entered Qty:') !!}
    {!! Form::text('total_entered_qty', null, ['class' => 'form-control']) !!}
</div>

<!-- Added Qty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('added_qty', 'Added Qty:') !!}
    {!! Form::text('added_qty', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('mainStocks.index') !!}" class="btn btn-default">Cancel</a>
</div>
