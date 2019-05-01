<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $sales->id !!}</p>
</div>

<!-- Invoice Date Field -->
<div class="form-group">
    {!! Form::label('invoice_date', 'Invoice Date:') !!}
    <p>{!! $sales->invoice_date !!}</p>
</div>

<!-- Payment Date Field -->
<div class="form-group">
    {!! Form::label('payment_date', 'Payment Date:') !!}
    <p>{!! $sales->payment_date !!}</p>
</div>

<!-- Total Amount Field -->
<div class="form-group">
    {!! Form::label('total_amount', 'Total Amount:') !!}
    <p>{!! $sales->total_amount !!}</p>
</div>

<!-- Amount Due Field -->
<div class="form-group">
    {!! Form::label('amount_due', 'Amount Due:') !!}
    <p>{!! $sales->amount_due !!}</p>
</div>

<!-- Tax Rate Field -->
<div class="form-group">
    {!! Form::label('tax_rate', 'Tax Rate:') !!}
    <p>{!! $sales->tax_rate !!}</p>
</div>

<!-- Customer Id Field -->
<div class="form-group">
    {!! Form::label('customer_id', 'Customer Id:') !!}
    <p>{!! $sales->customer_id !!}</p>
</div>

<!-- Branch Id Field -->
<div class="form-group">
    {!! Form::label('branch_id', 'Branch Id:') !!}
    <p>{!! $sales->branch_id !!}</p>
</div>

<!-- Operator Id Field -->
<div class="form-group">
    {!! Form::label('operator_id', 'Operator Id:') !!}
    <p>{!! $sales->operator_id !!}</p>
</div>

<!-- Payment Method Field -->
<div class="form-group">
    {!! Form::label('payment_method', 'Payment Method:') !!}
    <p>{!! $sales->payment_method !!}</p>
</div>

<!-- Payment Status Field -->
<div class="form-group">
    {!! Form::label('payment_status', 'Payment Status:') !!}
    <p>{!! $sales->payment_status !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $sales->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $sales->updated_at !!}</p>
</div>

