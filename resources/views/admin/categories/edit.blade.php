@extends('layouts.admin')


@section('content')

    <h1>Update category</h1>

    {!! Form::model($category,['method'=>'PATCH', 'action'=>['AdminCategoriesController@update',$category->id]]) !!}

    <div class="form-group">

        {!! Form::label('name','Name') !!}
        {!! Form::text('name',null,['class'=>'form-control'])!!}

    </div>

    <div class="form-group">
        {!! Form::submit('Update Category',['class'=>'bnt btn-primary col-sm-6']) !!}
    </div>

    {!! Form::close() !!}

    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy',$category->id]]) !!}

    <div class="form-group">
        {!! Form::submit('Delete Category',['class'=>'bnt btn-danger col-sm-6']) !!}
    </div>


    {!! Form::close() !!}

    <div class="row">
        @include('includes.form_error')
    </div>
@stop