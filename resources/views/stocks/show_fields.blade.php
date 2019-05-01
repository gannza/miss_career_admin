<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $stocks->id !!}</p>
</div>

<!-- Total Entered Qty Field -->
<div class="form-group">
    {!! Form::label('total_entered_qty', 'Total Entered Qty:') !!}
    <p>{!! $stocks->total_entered_qty !!}</p>
</div>

<!-- Qty Field -->
<div class="form-group">
    {!! Form::label('qty', 'Qty:') !!}
    <p>{!! $stocks->qty !!}</p>
</div>

<!-- Added Qty Field -->
<div class="form-group">
    {!! Form::label('added_qty', 'Added Qty:') !!}
    <p>{!! $stocks->added_qty !!}</p>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $stocks->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $stocks->updated_at !!}</p>
</div>

