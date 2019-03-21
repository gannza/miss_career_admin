<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $models->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $models->name !!}</p>
</div>
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('cost_price', 'Cost price:') !!}
    <p>{!! $models->cost_price !!}</p>
</div>
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('sale_price', 'Salw price:') !!}
    <p>{!! $models->sale_price !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $models->description !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $models->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $models->updated_at !!}</p>
</div>

