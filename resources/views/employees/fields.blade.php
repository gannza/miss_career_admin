<!-- Name Field -->
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('name', 'Name:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
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

<!-- Phone Field -->
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('phone', 'Phone:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Role Field -->
<div class="form-group">     
    <div class="col-lg-3">
    {!! Form::label('role', 'Role:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::select('role', $roles, null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">    
     <div class="col-lg-3">
    {!! Form::label('gender', 'gender:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::select('gender', $gender, null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Role Field -->
<div class="form-group">    
     <div class="col-lg-3">
    {!! Form::label('branch', 'Choose branch:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::select('branch_id', $branches, null, ['class' => 'form-control']) !!}
    </div>
   
</div>
<div class="form-group">    
     <div class="col-lg-3">
    {!! Form::label('activated_user', 'Activated:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::select('activated_user', $activated, null, ['class' => 'form-control']) !!}
    </div>
   
</div>


<!-- Submit Field -->
<div class="form-group float-right">
<div class="col-lg-9 col-lg-offset-3">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('employees.index') !!}" class="btn btn-default">Cancel</a>
    </div>
</div>
