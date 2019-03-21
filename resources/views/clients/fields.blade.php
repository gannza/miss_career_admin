<!-- First Name Field -->
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('first_name', 'First Name:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Last Name Field -->
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('last_name', 'Last Name:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Phone Number Field -->
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Email Field -->
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('email', 'Email:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>
    
</div>

<!-- Client type Field -->
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('client_type', 'Client type:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::select('client_type_id', $clientsTypes, null, ['class' => 'form-control']) !!}
</div>
    
</div>

<!-- Submit Field -->
<div class="form-group float-right">
<div class="col-lg-9 col-lg-offset-3">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('clients.index') !!}" class="btn btn-default pull-right">Cancel</a>
</div>
</div>