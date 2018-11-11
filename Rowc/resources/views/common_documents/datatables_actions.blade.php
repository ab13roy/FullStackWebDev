{!! Form::open(['route' => ['commonDocuments.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @if(Auth::guard('admin')->user()->is_admin != 2)
    <a href="{{ route('commonDocuments.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
    @endif

</div>
{!! Form::close() !!}
