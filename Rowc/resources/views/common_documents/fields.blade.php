<!-- Title Field -->
<div class="form-group">
    <label  class="col-sm-4 control-label"> {!! Form::label('title', 'Title:') !!}</label>
    <div class="col-sm-5">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- Status Field -->
<div class="form-group">
    <label class="col-sm-4 control-label">  {!! Form::label('document_type', 'Document Type* :') !!} </label>
    <div class="col-sm-5">

        <select class="form-control" id="document_type" name="document_type">
            <option value="">Select Document Type</option>
            @if(!isset($commonDocument))
                <option  value="Parent" @if (old('Parent') == 'Parent') selected="selected" @endif>Parent</option>
                <option value="Coach" @if (old('Coach') == 'Coach') selected="selected" @endif>Coach</option>
            @else
                <option value="Parent" {{ $commonDocument->document_type == 'Parent' ? 'selected="selected"' : '' }}>Parent</option>
                <option value="Coach" {{ $commonDocument->document_type == 'Coach' ? 'selected="selected"' : '' }}>Coach</option>
            @endif
        </select>
    </div>
</div>
<div class="form-group">
    <label  class="col-sm-4 control-label">  {!! Form::label('common_file', 'Common File:') !!}</label>
    <div class="col-sm-5">
        @if(isset($commonDocument))
            <input style="margin-top:7px;" class="form-control"  name="common_file" type="file" id="common_file">
        @else
            <input style="margin-top:7px;" class="form-control"  name="common_file" type="file" id="common_file" required>
        @endif
    </div>
</div>


<div class="clearfix"></div>


<div class="box-footer">
    <div class="col-sm-4"></div>
    <div class="col-sm-8">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('commonDocuments.index') !!}" class="btn btn-danger">Cancel</a>
    </div>
</div>
