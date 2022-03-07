@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create new User Admin</div>

                    <div class="card-body">
                        <form action="/user/admin" method="post">

                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter name">
                                <small id="nameHelp" class="form-text text-muted">Enter new User admin name</small>
                            </div>
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Email">
                                <small id="emailHelp" class="form-text text-muted">Your Email</small>
                                @error('email')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="Enter Password">
                                <small id="passwordHelp" class="form-text text-muted">Your Password</small>
                                @error('password')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <label for="password">Roles</label>
                            <small id="roleHelp" class="form-text text-muted">Check 1 or more roles</small>
                            <ul class="list-group">

                            @foreach($roles as $role)

                                <li class="list-group-item">
                                <input type="checkbox" id="{{$role->id}}" name="roles[{{$role->id}}]" value="{{$role->id}}">
                                <label for="{{$role->id}}"> {{$role->name}}</label>
                                </li>
                            @endforeach
                                @error('roles')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </ul>
                            <button type="submit" class="btn btn-primary">Create User Admin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
