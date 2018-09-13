@extends('layouts.admin')


@section('content')

    <h1>Edit Users</h1>
<div class="row">

    <div class="col-sm-3">
        <img height="50" src="{{$user->photo? $user->photo->file:'http://placehold.it/400x400'}}" alt="" class="img-responsice img-rounded">
    </div>
    <div class="col-sm-9">

        {!! Form::model($user,['method'=>'PATCH', 'action'=>['AdminUsersController@update',$user->id],'files'=>true]) !!}

            <div class="form-group">

                {!! Form::label('name','Name') !!}
                {!! Form::text('name',null,['class'=>'form-control'])!!}
            </div>

            <div class="form-group">
                {!! Form::label('email','Email:') !!}
                {!! Form::email('email',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('role_id','Role:') !!}
                {!! Form::select('role_id', [''=>'Choose Role']+$roles ,null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('is_active','Status:') !!}
                {!! Form::select('is_active',array(1=>'Active',0=>'Not Active'), null ,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo_id','Upload Photo:') !!}
                {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('pass','Password:') !!}
                {!! Form::password('password',['class'=>'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::submit('Update User',['class'=>'bnt btn-primary col-sm-6']) !!}
            </div>
        {!! Form::close() !!}

        {!! Form::model($user,['method'=>'DELETE', 'action'=>['AdminUsersController@destroy',$user->id]]) !!}

            <div class="form-group">
                {!! Form::submit('Delete User',['class'=>'bnt btn-danger col-sm-6']) !!}
            </div>

        {!! Form::close() !!}




    </div>
</div>
<div class="row">
    @include('includes.form_error')
</div>
@stop