@extends('layouts.admin')


    @section('content')

        <h1>Users</h1>



        <table class="table">
          <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Active</th>
                <th>Created</th>
                <th>Updated</th>
              </tr>
          </thead>
            <tbody>
            @if($users)
                @foreach($users as $u)
                  <tr>
                      <td>{{$u->id}}</td>
                      <td>{{$u->name}}</td>
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


