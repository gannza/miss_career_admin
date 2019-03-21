<!-- Name Field -->
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('name', 'Name:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('cost_price', 'Cost price:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::text('cost_price', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('sale_price', 'Sale price:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::text('sale_price', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Description Field -->
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('description', 'Description:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- Submit Field -->
<div class="form-group float-right">
<div class="col-lg-9 col-lg-offset-3">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('models.index') !!}" class="btn btn-default pull-right">Cancel</a>
</div>
</div>
