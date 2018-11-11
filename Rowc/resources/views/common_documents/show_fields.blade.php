<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $commonDocument->id !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $commonDocument->title !!}</p>
</div>

<!-- Common File Field -->
<div class="form-group">
    {!! Form::label('common_file', 'Common File:') !!}
    <p>{!! $commonDocument->common_file !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $commonDocument->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $commonDocument->updated_at !!}</p>
</div>

