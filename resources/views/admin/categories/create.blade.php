@extends('layouts.admin')


@section('content')

    <h1>Create category</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}

    <div class="form-group">

        {!! Form::label('name','Name') !!}
        {!! Form::text('name',null,['class'=>'form-control'])!!}

    </div>

    <div class="form-group">
        {!! Form::submit('Create Category',['class'=>'bnt, btn-primary']) !!}
    </div>


    {!! Form::close() !!}

<div class="row">
    @include('includes.form_error')
</div>
@stop