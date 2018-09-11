@extends('layouts.admin')


    @section('content')

@if(Session::has('deleted_user'))

    <p class="bg-warning"> {{session('deleted_user')}}</p>

@endif

        <h1>Users</h1>
        <table class="table">
          <thead>
            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Created</th>
                <th>Updated</th>
              </tr>
          </thead>
            <tbody>
            @if($users)
                @foreach($users as $u)
                  <tr>
                      <td>{{$u->id}}</td>
                      <td><img height="25" src="{{$u->photo ? $u->photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
                      <td><a href="{{route('admin.users.edit',$u->id)}}">{{$u->name}}</a></td>
                      <td>{{$u->email}}</td>
                      <td>{{$u->role == NULL ? 'No Role' : $u->role['name'] }}</td>
                      <td>{{$u->is_active == 1 ? 'Active' : 'Not Active'}}</td>
                      <td>{{$u->created_at->diffForHumans()}}</td>
                      <td>{{$u->updated_at->diffForHumans()}}</td>
                  </tr>
                @endforeach
            @endif
            </tbody>
        </table>


    @stop


