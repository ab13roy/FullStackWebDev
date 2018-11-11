<div class="box-header with-border">

</div>
<br/>
<div class="form-group">
    <label class="col-sm-2 control-label">   {!! Form::label('name', 'First Name:') !!}</label>
    <div class="col-sm-5">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">    {!! Form::label('last_name', 'Last Name:') !!}</label>
    <div class="col-sm-5">
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">   {!! Form::label('email', 'Email:') !!}</label>
    <div class="col-sm-5">
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">   {!! Form::label('password', 'Password:') !!}</label>
    <div class="col-sm-5">
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">  {!! Form::label('conf_password', 'Retype Password:') !!}</label>
    <div class="col-sm-5">
        {!! Form::password('conf_password', ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label">   {!! Form::label('phone', 'Phone:') !!}</label>
    <div class="col-sm-5">
        {!! Form::number('phone', null, ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label">   {!! Form::label('gender', 'Gender:') !!}</label>
    <div class="col-sm-5">
        {!! Form::select('gender', ['Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">      {!! Form::label('language', 'Language:') !!}</label>
    <div class="col-sm-5">
         @if(isset($coach))
            <input name="language[]" type="checkbox" value="English" @if(in_array("English", $languages)) checked @endif > English
            <input name="language[]" type="checkbox" value="Spanish" @if(in_array("Spanish", $languages)) checked @endif> Spanish
         @else
            <input name="language[]" type="checkbox" value="English"> English
            <input name="language[]" type="checkbox" value="Spanish"> Spanish
         @endif

    </div>
</div>

<div class="box-footer">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <input type="hidden" value="2" name="is_admin">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('coaches.index') !!}" class="btn btn-danger">Cancel</a>
    </div>
</div>