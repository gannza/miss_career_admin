<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $employees->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $employees->name !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $employees->email !!}</p>
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', 'Phone:') !!}
    <p>{!! $employees->phone !!}</p>
</div>

<!-- Role Field -->

@if ($employees->role == 0)
<div class="form-group">
{!! Form::label('role', 'Role:') !!}Admin</div>
            @endif
            
            @if ($employees->role == 1)
            <div class="form-group"> {!! Form::label('role', 'Role:') !!}Branch Manager</div>
            @endif

            @if ($employees->role == 2)
            <div class="form-group"> {!! Form::label('role', 'Role:') !!}Tail</div>
            @endif
            

            @if ($employees->activated_user)
            <div class="form-group">{!! Form::label('activated_user', 'Activated:') !!}Yes</div>
            @endif
            @if (!$employees->activated_user)
            <div class="form-group">{!! Form::label('activated_user', 'Activated:') !!}No</div>
            @endif
<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $employees->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $employees->updated_at !!}</p>
</div>

