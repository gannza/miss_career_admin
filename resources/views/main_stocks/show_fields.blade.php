<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $mainStock->id !!}</p>
</div>

<!-- Qty Field -->
<div class="form-group">
    {!! Form::label('qty', 'Qty:') !!}
    <p>{!! $mainStock->qty !!}</p>
</div>

<!-- Total Entered Qty Field -->
<div class="form-group">
    {!! Form::label('total_entered_qty', 'Total Entered Qty:') !!}
    <p>{!! $mainStock->total_entered_qty !!}</p>
</div>

<!-- Added Qty Field -->
<div class="form-group">
    {!! Form::label('added_qty', 'Added Qty:') !!}
    <p>{!! $mainStock->added_qty !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $mainStock->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $mainStock->updated_at !!}</p>
</div>

