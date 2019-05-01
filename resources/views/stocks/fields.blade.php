<!-- Added Qty Field -->

<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('model', 'Model:') !!}
    </div>
  
    @if ($stocks['add']==1)
    <div class="col-lg-9">
    {!! Form::select('model_id', $models, null, ['class' => 'form-control']) !!}
    </div>
     @endif 
     
    @if ($stocks['transfer']==0 && $stocks['add']==0)
    <div class="col-lg-9">
    {!! Form::select('model_id', $models, null, ['class' => 'form-control','disabled'=>true]) !!}
    {!! Form::hidden('model_id', null, ['class' => 'form-control']) !!}
    {!! Form::hidden('branch_id', null, ['class' => 'form-control']) !!}
    </div>
	 @endif 
	  @if ($stocks['transfer']==1 && $stocks['add']==0)
      <div class="col-lg-9">
        {!! Form::select('model_id', $models, null, ['class' => 'form-control','disabled'=>true]) !!}
        {!! Form::text('model_id', null, ['class' => 'form-control hidden']) !!}
        </div>
		@endif 
    
</div>

@if ($stocks['add']==1)
<!-- Branch Id Field -->
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('branch_id', 'Branch:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::select('branch_id', $branchs, null, ['class' => 'form-control']) !!}
    </div>
</div>
@endif 

@if ($stocks['transfer']==1)
<!-- Branch Id Field -->
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('branch_id', 'Transfer branch:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::select('transfered_branch_id', $branchs, null, ['class' => 'form-control']) !!}
    {!! Form::hidden('branch_id', null, ['class' => 'form-control']) !!}
    </div>
</div>
@endif 

<div class="form-group">
    @if ($stocks)
            <div class="col-lg-3">
            {!! Form::label('action', 'Action:') !!}
            </div>
            @if ($stocks['transfer']==0)
                    @if ($stocks['add']==0 && $stocks['edit']==1)
                    <div class="col-lg-6">
                    {!! Form::radio('action', 'Remove', ['class' => '']) !!} - Remove
                    </div>
                    @endif
                    @if ($stocks['add']==1 || $stocks['edit']==1)
                    <div class="col-lg-6">
                    {!! Form::radio('action', 'Add', ['class' => ''],['checked' => true]) !!} + Add
                    </div>
                    @endif
            
            @endif 
            @if ($stocks['transfer']==1)
            <div class="col-lg-3">
            {!! Form::radio('action', 'Transfering', ['class' => '']) !!} Transfering
            </div>
            @endif 
    @endif

</div>

<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('reason', 'Reason:') !!}
    </div>
    @if ($stocks)
            @if ($stocks['transfer']==0)
                    @if ($stocks['add']==0 && $stocks['edit']==1)
                    <div class="col-lg-2">
                    {!! Form::radio('reason', 'Customer sales', ['class' => '']) !!} Sale Stock
                    </div>

                    <div class="col-lg-2">
                    {!! Form::radio('reason', 'Damaged Stock', ['class' => '']) !!} Damaged Stock
                    </div>
                    @endif
                    @if ($stocks['add']==1 || $stocks['edit']==1)
                    <div class="col-lg-2">
                    {!! Form::radio('reason', 'Returned Stock', ['class' => '']) !!} Return Stock
                    </div>
                
                    <div class="col-lg-2">
                    {!! Form::radio('reason', 'New Stock', ['class' => ''],['checked' => true]) !!} New Stock
                    </div>
                    @endif 
            @endif 
            @if ($stocks['transfer']==1)
            <div class="col-lg-3">
            {!! Form::radio('reason', 'Transfer Stock', ['class' => '']) !!} Transfer Stock
            </div>
            @endif 
     @endif 

</div>
<!-- Qty Field -->
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('added_qty', 'Quantity:') !!}
    </div>
    <div class="col-lg-9">
    {!! Form::text('added_qty', '1', ['class' => 'form-control']) !!}
    </div>
    
    <div class="col-lg-9">
    {!! Form::text('transfer', null, ['class' => 'form-control hidden']) !!}
    </div>

</div>


<!-- Submit Field -->
<div class="form-group float-right">
<div class="col-lg-9 col-lg-offset-3">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('stocks.index') !!}" class="btn btn-default">Cancel</a>
    </div>
</div>
