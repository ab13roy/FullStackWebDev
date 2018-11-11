@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Sub Admin
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       @include('flash::message')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($subAdmin, ['route' => ['subAdmins.update', $subAdmin->id], 'method' => 'patch','class'=>'form-horizontal']) !!}

                        @include('sub_admins.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection