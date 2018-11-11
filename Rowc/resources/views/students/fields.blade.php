
<!-- Name Field -->
<div class="box-header with-border">

</div>
<br/>
<div class="form-group">
    <label class="col-sm-2 control-label">    {!! Form::label('first_name', 'First Name:') !!}</label>
    <div class="col-sm-5">
        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">   {!! Form::label('last_name', 'Last Name:') !!}</label>
    <div class="col-sm-5">
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label">    {!! Form::label('email', 'Email:') !!} </label>
    <div class="col-sm-5">
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">    {!! Form::label('phone', 'Phone:') !!}</label>
    <div class="col-sm-5">
        {!! Form::number('phone', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">    {!! Form::label('gender', 'Gender:') !!}</label>
    <div class="col-sm-5">
        {!! Form::select('gender', ['Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="box-footer">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('students.index') !!}" class="btn btn-danger">Cancel</a>
    </div>
</div>
