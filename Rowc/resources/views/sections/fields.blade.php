
<div class="form-group">
    <label class="col-sm-2 control-label">   {!! Form::label('name', 'Name* :') !!}</label>
    <div class="col-sm-5">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">    {!! Form::label('start_date', 'Start Date* :') !!}</label>
    <div class="col-sm-5">
        @if(isset($section))
            {!! Form::date('start_date', $section->start_date, ['class' => 'form-control']) !!}
        @else
            {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
        @endif
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">     {!! Form::label('end_date', 'End Date* :') !!}</label>
    <div class="col-sm-5">
        @if(isset($section))
            {!! Form::date('end_date', $section->end_date, ['class' => 'form-control']) !!}
        @else
            {!! Form::date('end_date', null, ['class' => 'form-control']) !!}

        @endif
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">     {!! Form::label('location', 'Location* :') !!}</label>
    <div class="col-sm-5">
        {!! Form::text('location', null, ['class' => 'form-control']) !!}
    </div>
</div>
@if(isset($section))
<div class="form-group">
    <label class="col-sm-2 control-label">     {!! Form::label('track', 'Assign Track :') !!}</label>
    <div class="col-sm-5">
        <select class="form-control select2" name="track[]" multiple="multiple" data-placeholder="Select a Track" style="width: 100%;">
            @foreach($track as $t)
            <option value="{{$t->id}}" @if(in_array($t->id,$track_ids)) selected @endif>{{$t->title}}</option>
            @endforeach
        </select>
    </div>
</div>
@endif
<div class="box-footer">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('sections.index') !!}" class="btn btn-danger">Cancel</a>
    </div>
</div>
