<table id="transaction" class="table table-striped w-100">
    <thead>
        <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Branch</th>
        <th>Role</th>
        <th>Activated</th>
        <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($employees as $employees)
        <tr>
            <td>{!! $employees->name !!}</td>
            <td>{!! $employees->email !!}</td>
            <td>{!! $employees->phone !!}</td>
            <td>{!! $employees->gender !!}</td>
            <td>{!! $employees->branch['name'] !!}</td>

            @if ($employees->role == 0)
            <td>Admin</td>
            @endif
            
            @if ($employees->role == 1)
            <td>Branch Manager</td>
            @endif

            @if ($employees->role == 2)
            <td>Tail</td>
            @endif
           

            @if ($employees->activated_user)
            <td>Yes</td>
            @endif

            @if (!$employees->activated_user)
            <td>No</td>
            @endif
            <td>
            
            @if ($employees->role != 0)
                {!! Form::open(['route' => ['employees.destroy', $employees->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('employees.show', [$employees->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('employees.edit', [$employees->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
