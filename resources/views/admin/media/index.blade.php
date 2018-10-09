@extends('layouts.admin')

@section('content')
<h1>Media</h1>

@if($photos)

    <table class="table">
      <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Created at</th>
          </tr>
      </thead>
        <tbody>
            @foreach($photos as $photo)
              <tr>
                <td>{{$photo->id}}</td>
                <td><img height="100" src="{{$photo->file}}" alt=""></td>
                <td>{{$photo->file}}</td>
                <td>{{$photo->file ? $photo->created_at->diffForHumans() : 'no date'}}</td>
                <td>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy',$photo->id]]) !!}

                    <div class="form-group">
                        {!! Form::submit('Delete',['class'=>'bnt btn-danger']) !!}
                    </div>


                    {!! Form::close() !!}

                </td>

              </tr>
            @endforeach
      </tbody>
    </table>
@endif
@stop