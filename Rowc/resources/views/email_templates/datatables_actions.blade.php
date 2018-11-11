{!! Form::open(['route' => ['emailTemplates.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    {{--<a href="{{ route('emailTemplates.show', $id) }}" class='btn btn-default btn-xs'>--}}
        {{--<i class="glyphicon glyphicon-eye-open"></i>--}}
    {{--</a>--}}
    <?php $email_temp_id = \App\Helpers::EncryptId($id) ?>
    <a href="{{ route('emailTemplates.edit', $email_temp_id) }}" title="Edit" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [--}}
        {{--'type' => 'submit',--}}
        {{--'class' => 'btn btn-danger btn-xs',--}}
        {{--'onclick' => "return confirm('Are you sure?')"--}}
    {{--]) !!}--}}
</div>
{!! Form::close() !!}
