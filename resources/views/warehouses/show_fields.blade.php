<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $warehouse->id !!}</p>
</div>

<!-- Qty Field -->
<div class="form-group">
    {!! Form::label('qty', 'Qty:') !!}
    <p>{!! $warehouse->qty !!}</p>
</div>

<!-- Total Entered Qty Field -->
<div class="form-group">
    {!! Form::label('total_entered_qty', 'Total Entered Qty:') !!}
    <p>{!! $warehouse->total_entered_qty !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $warehouse->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $warehouse->updated_at !!}</p>
</div>

