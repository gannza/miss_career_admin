<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $clientTypes->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $clientTypes->name !!}</p>
</div>

<!-- Discount Value Field -->
<div class="form-group">
    {!! Form::label('discount_value', 'Discount Value:') !!}
    <p>{!! $clientTypes->discount_value !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $clientTypes->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $clientTypes->updated_at !!}</p>
</div>

