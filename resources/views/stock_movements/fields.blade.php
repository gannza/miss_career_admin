<!-- Currenty Qty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('currenty_qty', 'Currenty Qty:') !!}
    {!! Form::text('currenty_qty', null, ['class' => 'form-control']) !!}
</div>

<!-- Action Field -->
<div class="form-group col-sm-6">
    {!! Form::label('action', 'Action:') !!}
    {!! Form::text('action', null, ['class' => 'form-control']) !!}
</div>

<!-- Added Qty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('added_qty', 'Added Qty:') !!}
    {!! Form::text('added_qty', null, ['class' => 'form-control']) !!}
</div>

<!-- Messages Field -->
<div class="form-group col-sm-6">
    {!! Form::label('messages', 'Messages:') !!}
    {!! Form::text('messages', null, ['class' => 'form-control']) !!}
</div>

<!-- Model Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model_id', 'Model Id:') !!}
    {!! Form::text('model_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Branch Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('branch_id', 'Branch Id:') !!}
    {!! Form::text('branch_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('stockMovements.index') !!}" class="btn btn-default">Cancel</a>
</div>
