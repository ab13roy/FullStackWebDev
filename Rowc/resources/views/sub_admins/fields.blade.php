<!-- Name Field -->
<div class="box-header with-border">

</div>
<br/>
<div class="form-group">
    <label class="col-sm-2 control-label">   {!! Form::label('name', 'Name* :') !!}</label>
    <div class="col-sm-5">
        {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Name']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">   {!! Form::label('phone', 'Phone*:') !!}</label>
    <div class="col-sm-5">
        {!! Form::text('phone', null, ['class' => 'form-control','placeholder'=>'Enter Phone Number']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">   {!! Form::label('email', 'Email* :') !!}</label>
    <div class="col-sm-5">
        {!! Form::text('email', null, ['class' => 'form-control','placeholder'=>'Enter Email Address']) !!}
    </div>
</div>
<div class="form-group">
    @if(isset($subAdmin))
    <label class="col-sm-2 control-label">   {!! Form::label('password', 'Password:') !!} </label>
    @else
        <label class="col-sm-2 control-label">   {!! Form::label('password', 'Password* :') !!} </label>
    @endif
    <div class="col-sm-5">
        <input class="form-control" name="password" type="password" id="password" placeholder="Enter Password">
    </div>
</div>
<div class="form-group">
    @if(isset($subAdmin))
    <label class="col-sm-2 control-label">   {!! Form::label('conf_password', 'Confirm Password:') !!} </label>
    @else
        <label class="col-sm-2 control-label">   {!! Form::label('conf_password', 'Confirm Password* :') !!} </label>
    @endif
    <div class="col-sm-5">
        <input class="form-control" name="conf_password" type="password" id="conf_password" placeholder="Enter Confirm Password">
    </div>
</div>

<!-- Status Field -->
<div class="form-group">
    <label class="col-sm-2 control-label">     {!! Form::label('status', 'Status* :') !!} </label>
    <div class="col-sm-5">

        <select class="form-control" id="status" name="status">
            <option value="">Select Status</option>
            @if(!isset($subAdmin))
               <option  value="Active" @if (old('status') == 'Active') selected="selected" @endif>Active</option>
               <option value="Not Active" @if (old('status') == 'Not Active') selected="selected" @endif>In-Active</option>
            @else
                <option value="Active" {{ $subAdmin->status == 'Active' ? 'selected="selected"' : '' }}>Active</option>
                <option value="Not Active" {{ $subAdmin->status == 'Not Active' ? 'selected="selected"' : '' }}>In-Active</option>
            @endif
        </select>
    </div>
</div>
<div class="box-footer">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('subAdmins.index') !!}" class="btn btn-danger">Cancel</a>
    </div>
</div>
