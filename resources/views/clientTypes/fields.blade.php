<!-- Name Field -->
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('name', 'Name:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Discount Value Field -->
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('discount_value', 'Discount Value:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::number('discount_value', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group float-right">
<div class="col-lg-9 col-lg-offset-3">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('clientTypes.index') !!}" class="btn btn-default pull-right">Cancel</a>
</div>
</div>

