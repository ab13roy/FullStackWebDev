@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Document List
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($coachDocument, ['route' => ['coachDocuments.update', $coachDocument->id], 'method' => 'patch','class'=>'form-horizontal','files'=>true]) !!}

                        @include('coach_documents.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection