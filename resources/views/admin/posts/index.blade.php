@extends('layouts.admin')

@section('content')

    @if(Session::has('deleted_post'))

        <p class="bg-warning"> {{session('deleted_post')}}</p>

    @endif

<h1>Posts</h1>
<?php //var_dump($posts->category['name']); exit; ?>
<table class="table">
  <thead>
      <tr>
        <th>ID</th>
        <th>Photo</th>
        <th>Owner</th>
        <th>Category</th>
        <th>Title</th>
        <th>Body</th>
        <th>Created at</th>
        <th>Updated at</th>
      </tr>
  </thead>
    <tbody>
    @if($posts)
        @foreach($posts as $post)
          <tr>
            <td>{{$post->id}}</td>
            <td><img height="50" src={{$post->photo ? $post->photo->file : 'http://placehold.it/400x400'}} alt=""></td>
            <td>{{$post->user ?$post->user->name : 'No user found'}}</td>
            <td>{{$post->category ? $post->category->name : 'No Category'}}</td>
            <td><a href="{{route('admin.posts.edit',$post->id)}}">{{$post->title}}</a></td>
            <td>{{str_limit($post->body,20)}}</td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>
          </tr>
        @endforeach
    @endif
  </tbody>
</table>


@stop