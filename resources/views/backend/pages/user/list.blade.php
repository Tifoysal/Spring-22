@extends('master')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">User List</h1>

    <a class="btn btn-success" href="">Create New User</a>

            </div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User name</th>
      <th scope="col">Role</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  @foreach($users as $data)
    <tr>
      <th scope="row">1</th>
      <th scope="row">{{$data->name}}</th>
      <th scope="row">{{$data->role}}</th>
      <th scope="row">
          <a href="" class="btn btn-success">View</a>
      </th>

    </tr>
  @endforeach

  </tbody>
</table>
@endsection
