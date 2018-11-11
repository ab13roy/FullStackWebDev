@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Track
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'tracks.store','class'=>'form-horizontal']) !!}

                        @include('tracks.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
