<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $generalSetting->id !!}</p>
</div>

<!-- Search Radius Field -->
<div class="form-group">
    {!! Form::label('search_radius', 'Search Radius:') !!}
    <p>{!! $generalSetting->search_radius !!}</p>
</div>

<!-- Homepage Url Field -->
<div class="form-group">
    {!! Form::label('homepage_url', 'Homepage Url:') !!}
    <p>{!! $generalSetting->homepage_url !!}</p>
</div>

<!-- Homepage Url Type Field -->
<div class="form-group">
    {!! Form::label('homepage_url_type', 'Homepage Url Type:') !!}
    <p>{!! $generalSetting->homepage_url_type !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $generalSetting->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $generalSetting->updated_at !!}</p>
</div>

