<table id="transaction" class="table table-striped w-100">
    <thead>
        <tr>
            <th>Name</th>
        <th>Discount Value</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($clientTypes as $clientTypes)
        <tr>
            <td>{!! $clientTypes->name !!}</td>
            <td>{!! $clientTypes->discount_value !!}%</td>
            <td>
                {!! Form::open(['route' => ['clientTypes.destroy', $clientTypes->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('clientTypes.show', [$clientTypes->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('clientTypes.edit', [$clientTypes->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>