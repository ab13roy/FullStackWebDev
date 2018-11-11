@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Coach
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($coach, ['route' => ['coaches.update', $coach->id], 'method' => 'patch','class'=>'form-horizontal']) !!}

                        @include('coaches.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection