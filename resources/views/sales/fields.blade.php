<!-- Invoice Date Field -->
<input type="hidden" value="{{ csrf_token() }}" class="token">
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('invoice_date', 'Invoice Date:') !!}
    </div>
    <div class="col-lg-3">
    {!! Form::text('invoice_date', null, ['class' => 'form-control']) !!}
    </div>

    <div class="col-lg-3">
    {!! Form::label('payment_date', 'Payment Due Date:') !!}
    </div>
    <div class="col-lg-3">
    {!! Form::text('payment_date', null, ['class' => 'form-control']) !!}
    </div>

</div>
<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('tax_rate', 'Tax Rate:') !!} <b class="pull-right">%</b>
    </div>
    <div class="col-lg-3">
    {!! Form::number('tax_rate', null, ['class' => 'form-control']) !!}
    </div>
    

    <div class="col-lg-3">
    {!! Form::label('currency', 'Currency:') !!}
    </div>
    <div class="col-lg-3">
    {!! Form::text('currency', null, ['class' => 'form-control currency']) !!}
    </div>

</div>

<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('branch_id', 'Branch:') !!}
    </div>
    <div class="col-lg-3">
    {!! Form::select('branch_id', $branchs, null, ['class' => 'form-control branch_id']) !!}
    </div>

    <div class="col-lg-3">
    {!! Form::label('customer_id', 'Customer:') !!}
    &nbsp;&nbsp;&nbsp;<a  href="{!! route('clients.create') !!}">Add client</a>
    </div>
    <div class="col-lg-3">
    {!! Form::select('customer_id', $clients, null, ['class' => 'form-control']) !!}
    </div>

</div>

<div class="form-group">
    <div class="col-lg-3">
    {!! Form::label('payment_method', 'Payment Method:') !!}
    </div>
    <div class="col-lg-3">
    {!! Form::select('payment_method', $method, null, ['class' => 'form-control']) !!}
    </div>

    <div class="col-lg-3">
    {!! Form::label('payment_status', 'Payment Status:') !!}
    </div>
    <div class="col-lg-3">
    {!! Form::select('payment_status', $status, null, ['class' => 'form-control']) !!}
    </div>

</div>
@if ($cart)
<div class="form-group">
    <div class="col-lg-12">
    <table class="table table-striped w-100" style="width:100%">
    <thead>
        <tr style="width:100%">
          <th>Model</th>
          <th>Qty</th>
          <th>Price</th>
           
            <th>Amount</th>  
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($cartItems as $c)
    <tr style="width:100%">
          <td>{!! $c->model->name !!}</td>
          <td>{!! $c->qty !!}</td>
          <td><span class="view_currency">{!! $sales->currency !!}</span> {!! $c->price !!}</td>
           
            <td><span class="view_currency">{!! $sales->currency !!}</span> {!! $c->price*$c->qty !!}</td>  
            <td>
            <a href="javascript::;" id="{!! $c->id !!}" class='btn btn-danger btn-xs delete_cart'><i class="glyphicon glyphicon-trash"></i></a>
            </td>
    </tr>
    @endforeach
    <tr style="width:100%">
          <td>
         <select class="form-control select_model">
       
            
         </select>
          </td>
          <td><input type="number" value="0.00" class="form-control cart_qty"></td>
          <td><input type="number" value="0.00"  class="form-control cart_price"></td>
            <td><input type="text" class="form-control cart_total" value="0.00"  disabled>
        </td>  
            <td>
            <a href="javascript::;" style="margin-top:6%" id="{!! $sales->id !!}" class='btn btn-info btn-xs add_cart'><i class="glyphicon glyphicon-plus"></i></a>
            </td>
    </tr>
    </tbody>
    <tfoot>
   <tr>
    <td colspan="4" style="text-align:right;font-size:15px">Total: </td>
    <td style="font-size:15px"> <b><span class="view_currency">{!! $sales->currency !!}</span> {!! $total_amount !!}
        <input type="hidden" id="total_amount" value="{!! $total_amount !!}">
        {!! Form::text('total_amount', $total_amount, ['class' => 'form-control hidden']) !!}
    </b> </td>
    </tr>

    <tr>
        <td colspan="4" style="text-align:right;font-size:15px">Tax(Vat): </td>
        <td style="font-size:15px"><b><span class="view_currency">{!! $sales->currency !!}</span> {!! $taxable_vat !!}</b> </td>
    </tr>
    <tr>
    <td colspan="4" style="text-align:right;font-size:15px">Amount Paid: </td>
    <td style="width:15%">   {!! Form::text('amount_due', null, ['class' => 'form-control amount_due']) !!} </td>
    </tr>
    <tr>
    <td colspan="4" style="text-align:right;font-size:15px">Change:</td>
    <td style="width:15%;color:green;font-size:17px">   <b><span class="view_currency">{!! $sales->currency !!}</span></b>  <b class="balance">{!! $total_amount-$sales->amount_due !!}</b> </td>
    </tr>
    </tfoot>
</table>
    </div>
</div>
@endif


<div class="form-group float-right">
<div class="col-lg-9 col-lg-offset-3">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('sales.index') !!}" class="btn btn-default pull-right">Cancel</a>
</div>
</div>