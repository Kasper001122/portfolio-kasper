@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$user->name}}</div>


                    <div class="card-body">
                        <form action="/user/admin/{{$user->id}}" method="post">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter name" value="{{$user->name}}">
                                <small id="nameHelp" class="form-text text-muted">Enter new User admin name</small>
                            </div>
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Email" value="{{$user->email}}">
                                <small id="emailHelp" class="form-text text-muted">Your Email</small>
                                @error('email')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <label for="roles">Roles</label>
                            <small id="roleHelp" class="form-text text-muted">Check 1 or more roles</small>
                            <ul class="list-group">
                                @foreach($roles as $role)
                                    <li class="list-group-item">
                                        <input type="checkbox" id="{{$role->id}}" name="roles[]" value="{{$role->id}}"
                                            {{$user->roles()->find($role)==true ? 'checked' : ''}}>
                                        <label for="{{$role->id}}"> {{$role->name}}</label>
                                    </li>
                                @endforeach
                                @error('roles')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </ul>


                            <button type="submit" class="btn btn-primary">Update User Admin</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
