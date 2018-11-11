
<div class="box-header with-border">
    <h3 class="box-title content-ttl"> @if(isset($emailTemplate)) Edit Email Template of {!! $emailTemplate->keyword !!} @endif </h3>
</div>
<br/>
<div class="form-group">
    <label class="col-sm-2 control-label">  {!! Form::label('keyword', 'Keyword (*):') !!}</label>
    <div class="col-sm-5">
        {!! Form::text('keyword', null, ['class' => 'form-control', 'readonly' => 'true']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">  {!! Form::label('subject', 'Subject (*):') !!}</label>
    <div class="col-sm-5">
        {!! Form::text('subject', null, ['class' => 'form-control','placeholder'=>'Enter Subject']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">{!! Form::label('content', 'Content (*):') !!}</label>
    <div class="col-sm-7">
        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-sm-3">
    <div class="field-input field-input-macro-wrap">
        <div class="field-input-macro text-center">
            <p> Macros</p>
            @if($emailTemplate->variables_list != "")
              {{$emailTemplate->variables_list}}
            @endif
        </div>
    </div>
    </div>
</div>
<div class="box-footer">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('emailTemplates.index') !!}" class="btn btn-danger">Cancel</a>
    </div>
</div>


<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('content');
        CKEDITOR.forcePasteAsPlainText = true;
        //bootstrap WYSIHTML5 - text editor
//        $(".textarea").wysihtml5();
    });
</script>