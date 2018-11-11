<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $coachDocument->id !!}</p>
</div>

<!-- Coach Id Field -->
<div class="form-group">
    {!! Form::label('coach_id', 'Coach Id:') !!}
    <p>{!! $coachDocument->coach_id !!}</p>
</div>

<!-- Document Type Field -->
<div class="form-group">
    {!! Form::label('document_type', 'Document Type:') !!}
    <p>{!! $coachDocument->document_type !!}</p>
</div>

<!-- Document File Field -->
<div class="form-group">
    {!! Form::label('document_file', 'Document File:') !!}
    <p>{!! $coachDocument->document_file !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $coachDocument->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $coachDocument->updated_at !!}</p>
</div>

