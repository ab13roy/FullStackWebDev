
<div class="form-group">
    <label class="col-sm-2 control-label">   {!! Form::label('title', 'Title* :') !!}</label>
    <div class="col-sm-5">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">      {!! Form::label('short_title', 'Short Title:') !!}</label>
    <div class="col-sm-5">
        {!! Form::text('short_title', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">   {!! Form::label('description', 'Description* :') !!}</label>
    <div class="col-sm-5">
        {!! Form::text('description', null, ['class' => 'form-control']) !!}
    </div>
</div>
@if(isset($track))
    <div class="form-group">
        <label class="col-sm-2 control-label"> {!! Form::label('coach_id', 'Coach Assign:') !!}</label>
        <div class="col-sm-5">
            <select class="form-control" name="coach_id" data-placeholder="Select a Coach" style="width: 100%;">
                <option value="">Select Coach</option>
                @foreach($coach as $t)
                    <option value="{{$t->id}}" @if($t->is_selected  == 1) selected @endif>{{$t->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif
<div class="box-footer">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('tracks.index') !!}" class="btn btn-danger">Cancel</a>
    </div>
</div>
