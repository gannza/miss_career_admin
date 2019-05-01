<table id="transaction" class="table table-striped w-100">
    <thead>
        <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Address</th>
        <th>Company</th>
        <th>Client Type</th>
        <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($clients as $clients)
        <tr>
            <td>{!! $clients->first_name !!}</td>
            <td>{!! $clients->last_name !!}</td>
            <td>{!! $clients->phone_number !!}</td>
            <td>{!! $clients->email !!}</td>
            <td>{!! $clients->address !!}</td>
            <td>{!! $clients->company !!}</td>
            <td>{!! $clients->customer_type->name !!}</td>
            <td>
                {!! Form::open(['route' => ['clients.destroy', $clients->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('clients.show', [$clients->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('clients.edit', [$clients->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

