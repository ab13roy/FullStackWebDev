
<div class="form-group">
    <label  class="col-sm-4 control-label"> {!! Form::label('document_type', 'Document Type:') !!}</label>
    <div class="col-sm-5">
        {!! Form::select('document_type', ['Medical' => 'Medical','Health Insurance' => 'Health Insurance','Others' => 'Others'], null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <label  class="col-sm-4 control-label">    {!! Form::label('document_file', 'Document File:') !!}</label>
    <div class="col-sm-5">
        @if(isset($coachDocument))
            <input style="margin-top:7px;" class="form-control"  name="document_file" type="file" id="document_file">
        @else
            <input style="margin-top:7px;" class="form-control"  name="document_file" type="file" id="document_file" required>
        @endif
    </div>
</div>

<div class="box-footer">
    <div class="col-sm-4"></div>
    <div class="col-sm-8">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('coachDocuments.index') !!}" class="btn btn-danger">Cancel</a>
    </div>
</div>

