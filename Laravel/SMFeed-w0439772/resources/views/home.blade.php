@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>

                    @endif

                        <a href="/user/admin/create" class="btn btn-dark">Create New User Admin</a>
                </div>

                </div>
            <div class="card mt-4">
                <div class="card-header">Users</div>
                <div class="card-body">
                    <ul class="list-group">
                @foreach($users as $user)
                    <li class="list-group-item">
                        {{$user->name}}</li>
                        <li class="list-group-item d-flex justify-content-between">
{{--                            <form action="/user/admin/{{$user->id}}"  method="post">--}}

{{--                                @csrf--}}
{{--                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>--}}
{{--                            </form>--}}
                        <a href="user/admin/{{$user->id}}"  class="btn btn-sm btn-outline-success">Show</a>
                        <a href="user/admin/{{$user->id}}/edit"  class="btn btn-sm btn-outline-secondary">Edit</a>
                        <form action="/user/admin/{{$user->id}}"  method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                        </li>
                @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
