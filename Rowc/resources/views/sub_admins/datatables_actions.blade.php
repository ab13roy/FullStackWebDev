{{--{!! Form::open(['route' => ['subAdmins.destroy', $id], 'method' => 'delete']) !!}--}}
<div class='btn-group'>
    {{--<a href="{{ route('subAdmins.show', $id) }}" class='btn btn-default btn-xs'>--}}
        {{--<i class="glyphicon glyphicon-eye-open"></i>--}}
    {{--</a>--}}
    <a href="{{ route('subAdmins.edit', $id) }}" title="Edit" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    <a href="javascript:void(0);" onclick="confirmDelete({{$id}});"  title="Delete" class='btn btn-danger btn-xs'>
        <i class="fa fa-trash"></i>
    </a>
    {{--{!! Form::button('<i class="fa fa-trash"></i>', [--}}
        {{--'type' => 'submit',--}}
        {{--'class' => 'btn btn-danger btn-xs',--}}
        {{--'onclick' => "return confirm('Are you sure?')"--}}
    {{--]) !!}--}}
    {{--{!! Form::button('<i class="fa fa-trash"></i>', [--}}
       {{--'type' => 'submit',--}}
       {{--'class' => 'btn btn-danger btn-xs',--}}
       {{--'onclick' => "confirmDelete();"--}}
   {{--]) !!}--}}
</div>
{{--{!! Form::close() !!}--}}

