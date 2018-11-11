@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            General Settings
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       @include('flash::message')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($generalSetting, ['route' => ['generalSettings.update', $generalSetting->id], 'method' => 'patch','class'=>'form-horizontal','files'=>true]) !!}

                        @include('general_settings.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection