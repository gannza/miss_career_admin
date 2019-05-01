<table id="transaction" class="table table-striped w-100">
    <thead>
        <tr>
          <th>Status</th>
            <th>Invoice Date</th>
            <th>Payment Date</th>
            <th>Total Amount</th>
            <th>Amount Due</th>
            <th>Tax Rate</th>
            <th>Customer</th>
            <th>Branch</th>
            <th>Operator</th>
            <th>Payment Method</th>
            
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sales as $sales)
        <tr>

            <td>
            @if ( $sales->payment_status == 'Unpaid')
            <span class="label label-danger">{!! $sales->payment_status !!}</span>
            @endif
            @if ( $sales->payment_status == 'Paid')
            <span class="label label-success">{!! $sales->payment_status !!}</span>
            @endif
            </td>
            <td>{!! $sales->invoice_date !!}</td>
            <td>{!! $sales->payment_date !!}</td>
            <td style="font-weight:bold;font-size:14px">{!! $sales->currency !!} {!! $sales->total_amount !!}</td>
            <td style="font-weight:bold;font-size:14px">{!! $sales->currency !!} {!! $sales->amount_due !!}</td>
            <td style="font-weight:bold;font-size:14px">{!! $sales->tax_rate !!}%</td>
            <td>{!! $sales->client->name !!} ({!! $sales->client_type->name !!})</td>
            <td>{!! $sales->branch->name !!}</td>
            <td>{!! $sales->operator->name !!}</td>
            <td>{!! $sales->payment_method !!}</td>
            <td>
                {!! Form::open(['route' => ['sales.destroy', $sales->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('sales.show', [$sales->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('sales.edit', [$sales->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>